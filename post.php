<?php
session_start();
require_once 'includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) die("Message introuvable.");
$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();
if (!$post) die("Message introuvable.");

$pageTitle = $post['title'];
$error = '';
$attachmentPath = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    $author = trim($_POST['author'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $parent_id = isset($_POST['parent_id']) ? (int) $_POST['parent_id'] : null;
    $user_id = $_SESSION['user']['id'] ?? null;

    // 🔧 Upload du fichier si présent
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '/forum-prison/uploads/';
        $serverPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
        if (!is_dir($serverPath)) mkdir($serverPath, 0777, true);
        $filename = basename($_FILES['attachment']['name']);
        $filename = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $filename); // sécurité
        $newFilename = time() . '_' . $filename;
        $targetPath = $serverPath . $newFilename;
        $webPath = $uploadDir . $newFilename;
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $targetPath)) {
            $attachmentPath = $webPath; // ✅ On retient le chemin pour la BDD
        }
    }

    if ($parent_id !== null) {
        $checkParent = $pdo->prepare("SELECT id FROM comments WHERE id = ?");
        $checkParent->execute([$parent_id]);
        if (!$checkParent->fetch()) $parent_id = null;
    }

    if (empty($author) || empty($content)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        $pdo->prepare("INSERT INTO comments (post_id, parent_id, author, content, attachment, user_id)
                       VALUES (?, ?, ?, ?, ?, ?)")
            ->execute([$id, $parent_id, $author, $content, $attachmentPath, $user_id]);

        $_SESSION['comment_posted'] = true;
        header("Location: post.php?id=$id");
        exit;
    }
}

if (isset($_GET['report']) && is_numeric($_GET['report'])) {
    $pdo->prepare("UPDATE comments SET reported = 1 WHERE id = ?")->execute([(int)$_GET['report']]);
    header("Location: post.php?id=$id");
    exit;
}

$sort = $_GET['sort'] ?? 'newest';

switch ($sort) {
    case 'oldest':
        $orderBy = "created_at ASC";
        break;
    case 'popular':
        $orderBy = "(likes - dislikes) DESC, created_at DESC";
        break;
    case 'newest':
    default:
        $orderBy = "created_at DESC";
        break;
}

$comments = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY $orderBy");
$comments->execute([$id]);

$allComments = $comments->fetchAll();

$commentTree = [];
foreach ($allComments as $comment) {
    $commentTree[$comment['parent_id']][] = $comment;
}

function display_comment_block($c, $depth = 0, $children = []) {
    global $id, $sort;
    $userId = $_SESSION['user']['id'] ?? null;
    $alreadyLiked = $alreadyDisliked = false;

    if ($userId) {
        $stmt = $GLOBALS['pdo']->prepare("SELECT type FROM likes WHERE comment_id = ? AND user_id = ?");
        $stmt->execute([$c['id'], $userId]);
        foreach ($stmt->fetchAll() as $vote) {
            if ($vote['type'] === 'like') $alreadyLiked = true;
            if ($vote['type'] === 'dislike') $alreadyDisliked = true;
        }
    }

    $score = ($c['likes'] ?? 0) - ($c['dislikes'] ?? 0);
    $scoreColor = $score > 0 ? 'limegreen' : ($score < 0 ? 'crimson' : '#aaa');
    $scorePrefix = $score > 0 ? '+' : '';

    echo "<div class='comment-block' style='display: flex; border: 1px solid #440000; background: #111; color: white; margin: 10px 0;'>";
    echo "<div style='width: 160px; padding: 10px; background: #222; color: #ff1919; font-weight: bold;'>" .
        htmlspecialchars($c['author']) . "<br><span style='font-size:0.8em; color: #ccc;'>" . $c['created_at'] . "</span><br><span style='font-size:0.8em; color:#666'>#{$c['id']}</span></div>";

    echo "<div style='flex: 1; padding: 10px; border-left: 1px solid #333;'>";
    echo "<strong style='color:white'>Re: " . htmlspecialchars($GLOBALS['post']['title']) . "</strong><br>";
    echo "<p style='color: #eee;'>" . nl2br(htmlspecialchars($c['content'])) . "</p>";

    if (!empty($c['attachment'])) {
        echo "<div style='margin-top: 10px;'><img src='" . htmlspecialchars($c['attachment']) . "' alt='Pièce jointe' style='max-width: 250px; border: 1px solid #ff1919; border-radius: 8px;'></div>";
    }

    echo "<div id='score-{$c['id']}' style='color:$scoreColor;'>Score : {$scorePrefix}{$score}</div>";

    echo "<div class='vote-buttons' data-comment-id='{$c['id']}' style='display: flex; gap: 10px; margin: 10px 0;'>
        <button class='btn-vote upvote " . ($alreadyLiked ? "active" : "") . "' data-action='like'>▲</button>
        <button class='btn-vote downvote " . ($alreadyDisliked ? "active" : "") . "' data-action='dislike'>▼</button>
    </div>";

    echo "<div style='margin-top:8px;'>
        <a href='?id=$id&reply_to={$c['id']}#comment-form' style='color:white;'>💬 Répondre</a> |
        <a href='post.php?id=$id&report={$c['id']}' onclick='return confirm(\"Signaler ?\");' style='color:red;'>🚩 Signaler</a>
    </div>";

    if (!empty($children)) {
        echo "<button class='toggle-btn' data-target='child-{$c['id']}' style='margin-top: 10px; background: none; color: #ff1919; border: none; cursor: pointer;'>▶ Voir les réponses</button>";
        echo "<div id='child-{$c['id']}' style='display:none; margin-top: 10px;'>";
        foreach ($children as $child) {
            display_comment_block($child, $depth + 1, $GLOBALS['commentTree'][$child['id']] ?? []);
        }
        echo "</div>";
    }
    echo "</div></div>";
}
?>

<!-- Le reste du fichier HTML et JS (formulaire, JS pour prévisualisation, AJAX, etc.) reste inchangé -->


<?php include 'includes/head.php'; ?>
<?php include 'includes/navbar.php'; ?>
<style>
#comment-overlay {
  position: fixed;
  inset: 0;
  background: black;
  color: #ff4d4d;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'Orbitron', sans-serif;
  font-size: 2rem;
  z-index: 9999;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.8s ease-in-out;
}
@keyframes overlayZoomGlow {
  0% { transform: scale(1); text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000; }
  50% { transform: scale(1.02); text-shadow: 0 0 10px #ff1a1a, 0 0 20px #ff3300; }
  100% { transform: scale(1); text-shadow: 0 0 5px #ff0000, 0 0 10px #ff0000; }
}
#comment-overlay.show { opacity: 1; pointer-events: auto; animation: overlayZoomGlow 2.5s ease-in-out; }
#comment-overlay.fade-out { opacity: 0; transition: opacity 0.1s ease-in-out; }
</style>
<audio id="comment-sound" src="assets/sounds/post.mp3" preload="auto"></audio>
<div id="comment-overlay"></div>

<div id="app-content">
<div class="post-container" style="background: rgba(10, 10, 10, 0.85); border-radius: 12px; border: 1px solid #ff5500; box-shadow: 0 0 12px rgba(255, 80, 0, 0.4); padding: 25px; margin-bottom: 30px; color: white;">
    <h2 style="color: #ff4c4c; font-size: 1.8em; margin-bottom: 8px;">
        <?= htmlspecialchars($post['title']) ?>
    </h2>
    <hr style="border: none; height: 2px; background: linear-gradient(to right, #ff1919, #ff3300); margin-bottom: 15px;">
    <div style="font-size: 0.95em; color: #ffdddd; margin-bottom: 6px;"><strong style="color: #ff1919;">Auteur :</strong> <?= htmlspecialchars($post['author']) ?></div>
    <p style="font-size: 1.1em; line-height: 1.6; color: #eee; margin-bottom: 10px;">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
    <div style="font-size: 0.85em; color: #aaa;">Posté le <?= $post['created_at'] ?></div>
</div>

<div style="margin-bottom: 25px; display: flex; gap: 10px;">
    <a href="?id=<?= $id ?>&sort=newest" class="btn-neon <?= $sort === 'newest' ? 'active-sort' : '' ?>" style="color: #00acee; background: #111;">🔍 Récents</a>
    <a href="?id=<?= $id ?>&sort=oldest" class="btn-neon <?= $sort === 'oldest' ? 'active-sort' : '' ?>" style="color: #ffcc66; background: #111;">📜 Anciens</a>
    <a href="?id=<?= $id ?>&sort=popular" class="btn-neon <?= $sort === 'popular' ? 'active-sort' : '' ?>" style="color: #ff5e00; background: #111;">🔥 Populaires</a>
</div>


<?php if (!empty($commentTree[null])) {
    foreach ($commentTree[null] as $comment) {
        display_comment_block($comment, 0, $commentTree[$comment['id']] ?? []);
    }
} ?>

<hr>
<h2>Ajouter un commentaire</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" enctype="multipart/form-data" id="comment-form" style="max-width: 600px;">
    <input type="hidden" name="parent_id" value="<?= $_GET['reply_to'] ?? '' ?>">

    <label for="author" style="color: #ff4d4d; margin-top: 10px;">Pseudo :</label>
    <input type="text" name="author" id="author" class="form-input" required>

    <label for="content" style="color: #ff4d4d; margin-top: 10px;">Contenu :</label>
    <textarea name="content" id="content" class="form-input" rows="4" required></textarea>

    <div class="custom-file-upload" style="margin-top: 15px;">
    <label for="comment-file" class="btn-neon" style="display: inline-block; cursor: pointer;">📂 Choisir un fichier</label>
<input id="comment-file" type="file" name="attachment" accept="image/*" style="display: none;">

        <span id="comment-file-name">Aucun fichier choisi</span>
        <div id="preview-container" style="margin-top: 10px;"></div>

    </div>

    <button type="submit" class="btn-neon" style="margin-top: 15px;"> Publier</button>
</form>


</div> <!-- fin app-content -->

<script>
document.querySelectorAll('.toggle-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const target = document.getElementById(btn.dataset.target);
        target.style.display = target.style.display === 'none' ? 'block' : 'none';
        btn.textContent = target.style.display === 'none' ? '▶ Voir les réponses' : '▼ Masquer les réponses';
    });
});

const voteBlocks = document.querySelectorAll('.vote-buttons');
voteBlocks.forEach(block => {
    const commentId = block.dataset.commentId;
    const scoreDiv = document.getElementById('score-' + commentId);
    const upBtn = block.querySelector('.upvote');
    const downBtn = block.querySelector('.downvote');

    [upBtn, downBtn].forEach(btn => {
        btn.addEventListener('click', () => {
            const action = btn.dataset.action;
            fetch('like_comment.php?id=<?= $id ?>&sort=<?= $sort ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `comment_id=${commentId}&action=${action}`
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    scoreDiv.textContent = `Score : ${data.score >= 0 ? '+' : ''}${data.score}`;
                    scoreDiv.style.color = data.score > 0 ? 'limegreen' : (data.score < 0 ? 'crimson' : '#aaa');
                    upBtn.classList.remove('active');
                    downBtn.classList.remove('active');
                    if (data.type === 'like') upBtn.classList.add('active');
                    else if (data.type === 'dislike') downBtn.classList.add('active');
                }
            });
        });
    });
});
</script>

<?php if (!empty($_SESSION['comment_posted'])): ?>
<script>
window.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('comment-overlay');
    const audio = document.getElementById('comment-sound');
    const text = "Message publié...";
    let i = 0;
    overlay.textContent = "";

    const typewriter = setInterval(() => {
        if (i < text.length) {
            overlay.textContent += text[i];
            i++;
        } else {
            clearInterval(typewriter);
overlay.classList.add('fade-out');
setTimeout(() => {
    overlay.style.display = 'none';
}, 500); // attend que le fade-out soit fini
        }
    }, 60);

    overlay.classList.add('show');
    audio.play();
});
</script>

<script>
document.getElementById('comment-file')?.addEventListener('change', function () {
    const file = this.files[0];
    const fileName = file ? file.name : "Aucun fichier choisi";
    document.getElementById('comment-file-name').textContent = fileName;

    const preview = document.getElementById('preview-container');
    preview.innerHTML = "";

    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            img.alt = "Aperçu de l’image";
            img.style.maxWidth = "200px";
            img.style.maxHeight = "150px";
            img.style.border = "1px solid #ff1919";
            img.style.borderRadius = "8px";
            img.style.marginTop = "10px";
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});
</script>


<?php unset($_SESSION['comment_posted']); endif; ?>

<?php include 'includes/footer.php'; ?>

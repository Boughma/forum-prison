<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

require_user_login();

$userId = $_SESSION['user']['id'];

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/avatars/';
    $serverPath = $_SERVER['DOCUMENT_ROOT'] . '/forum-prison/' . $uploadDir;

    if (!is_dir($serverPath)) {
        mkdir($serverPath, 0777, true);
    }

    $filename = time() . '_' . basename($_FILES['avatar']['name']);
    $targetPath = $serverPath . $filename;

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
        // Stocke juste le nom du fichier (ex: 1746_avatar.png)
        $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $stmt->execute([$filename, $userId]);

        // Mets à jour la session
        $_SESSION['user']['avatar'] = $filename;
    }
}

header('Location: profil.php');
exit;

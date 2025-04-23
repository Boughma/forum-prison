<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

require_user_login();

$userId = $_SESSION['user']['id'];

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '/forum-prison/uploads/avatars/';
    $serverPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;

    if (!is_dir($serverPath)) {
        mkdir($serverPath, 0777, true);
    }

    $filename = time() . '_' . basename($_FILES['avatar']['name']);
    $targetPath = $serverPath . $filename;
    $webPath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
        // Update user
        $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $stmt->execute([$webPath, $userId]);

        // Update session
        $_SESSION['user']['avatar'] = $webPath;

    }
}

header('Location: profil.php');
exit;

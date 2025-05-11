<?php
require_once 'includes/functions.php';
require_user_login();
require_once 'includes/db.php';

$bio = trim($_POST['bio'] ?? '');
$userId = $_SESSION['user']['id'];

$stmt = $pdo->prepare("UPDATE users SET bio = ? WHERE id = ?");
$stmt->execute([$bio, $userId]);

header("Location: profil.php");
exit;

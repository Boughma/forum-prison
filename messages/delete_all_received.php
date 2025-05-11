<?php
session_start();
require_once '../includes/functions.php';
require_user_login();
require_once '../includes/db.php';

// Suppression de TOUS les messages reçus par l'utilisateur connecté
$stmt = $pdo->prepare("DELETE FROM private_messages WHERE receiver_id = ?");
$stmt->execute([$_SESSION['user']['id']]);

// Redirection après suppression
header('Location: inbox.php');
exit;

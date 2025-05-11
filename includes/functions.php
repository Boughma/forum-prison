<?php
function is_admin_logged_in(): bool {
    return isset($_SESSION['admin']);
}

function require_admin_login() {
    if (!is_admin_logged_in()) {
        header('Location: ../admin/login.php');
        exit;
    }
}

function is_user_logged_in(): bool {
    return isset($_SESSION['user']);
}

function require_user_login() {
    if (!is_user_logged_in()) {
        header('Location: /forum-prison/login.php');
        exit;
    }
}

function is_admin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

function showOverlayRedirect($message, $redirectUrl, $forceMessage = null, $sound = 'login.mp3') {
    if ($forceMessage !== null) {
        $_SESSION['overlay_force_message'] = $forceMessage;
    }
    $_SESSION['overlay_redirect'] = $redirectUrl;
    $_SESSION['overlay_sound'] = $sound;
    header("Location: overlay_redirect.php");
    exit;
}



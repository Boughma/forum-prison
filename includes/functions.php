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



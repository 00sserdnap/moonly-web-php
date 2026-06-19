<?php
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => true,      // pon false SOLO si pruebas en local sin HTTPS
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function currentUser() {
    if (!isLoggedIn()) return null;
    return [
        'id'       => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'role'     => $_SESSION['role'],
    ];
}

function requireLogin($redirectTo = '/auth/login.php') {
    if (!isLoggedIn()) {
        header('Location: ' . $redirectTo);
        exit;
    }
}

function requireRole($roles, $redirectTo = '/index.php') {
    requireLogin();
    $roles = (array)$roles;
    if (!in_array($_SESSION['role'], $roles, true)) {
        http_response_code(403);
        die('No tienes permiso para acceder a esta sección.');
    }
}
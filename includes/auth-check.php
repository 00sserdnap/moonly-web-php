<?php
if (session_status() === PHP_SESSION_NONE) {

    /* Sesiones guardadas dentro del propio webroot. */
    $sessionPath = dirname(__FILE__) . '/sessions';
    if (!is_dir($sessionPath)) {
        @mkdir($sessionPath, 0755, true);
    }
    ini_set('session.save_path', $sessionPath);

    /* Detecta automáticamente si la conexión actual es HTTPS.
       Así, cuando instales el SSL más adelante, la cookie se
       pondrá "secure" sola, sin que tengas que tocar este archivo. */
    $isHttps = (
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
    );

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $isHttps,
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
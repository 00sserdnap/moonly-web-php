<?php
require_once '../includes/auth-check.php';

$base_path = '../';
$page_title = 'Recuperar Contraseña — Moonly Hosting';
$extra_css = 'css/auth.css';
$body_class = 'auth-body';
include '../includes/header-minimal.php';
?>

<div class="auth-card">
    <div class="auth-form-side">
        <div class="auth-logo">
            <i class="fa-solid fa-moon"></i>
            <span>MOONLY</span>
        </div>

        <h1 class="auth-title">Recuperar contraseña</h1>
        <p class="auth-subtitle">Esta función estará disponible próximamente. Por ahora, contacta a soporte por Discord.</p>

        <a href="https://discord.gg/moonly" target="_blank" class="auth-submit" style="display:flex; align-items:center; justify-content:center; gap:8px; text-decoration:none;">
            <i class="fa-brands fa-discord"></i> Hablar con Soporte
        </a>

        <p class="auth-switch"><a href="login.php">← Volver a Iniciar sesión</a></p>

        <p class="auth-footer-note">Moonly Hosting © 2025 - 2026</p>
    </div>
    <div class="auth-image-side"></div>
</div>

</body>
</html>
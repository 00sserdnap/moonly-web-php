<?php
require_once '../includes/db.php';
require_once '../includes/auth-check.php';
require_once '../includes/csrf.php';

if (isLoggedIn()) {
    header('Location: ../index.php');
    exit;
}

$errors = [];
$success = false;
$old = ['username' => '', 'email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Token de seguridad inválido. Recarga la página e intenta de nuevo.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        $old['username'] = $username;
        $old['email'] = $email;

        if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
            $errors[] = 'El usuario debe tener 3-20 caracteres (letras, números, guion bajo).';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El correo no es válido.';
        }
        if (strlen($password) < 8) {
            $errors[] = 'La contraseña debe tener al menos 8 caracteres.';
        }
        if ($password !== $confirm) {
            $errors[] = 'Las contraseñas no coinciden.';
        }

        $db = getDb();

        if (empty($errors)) {
            $stmt = $db->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                $errors[] = 'Ese usuario o correo ya está registrado.';
            }
        }

        if (empty($errors)) {
            $hash  = password_hash($password, PASSWORD_BCRYPT);
            $token = bin2hex(random_bytes(32));

            /* NOTA: email_verified = 1 por ahora, para que puedas probar
               el login de inmediato. Cuando activemos el envío de correos,
               cambia este 1 por 0 y descomenta el bloque de mail() abajo. */
            $stmt = $db->prepare(
                'INSERT INTO users (username, email, password_hash, verify_token, email_verified) VALUES (?, ?, ?, ?, 1)'
            );
            $stmt->execute([$username, $email, $hash, $token]);

            // mail($email, 'Verifica tu cuenta Moonly', "Haz clic: https://moonly.es/auth/verify-email.php?token=$token");

            $success = true;
        }
    }
}

$base_path = '../';
$page_title = 'Crear Cuenta — Moonly Hosting';
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

        <h1 class="auth-title">Crear cuenta</h1>
        <p class="auth-subtitle">Únete a la comunidad Moonly para participar en el foro.</p>

        <?php if ($success): ?>
            <div class="auth-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>¡Cuenta creada con éxito! Ya puedes iniciar sesión.</span>
            </div>
        <?php else: ?>

            <?php foreach ($errors as $err): ?>
                <div class="auth-error"><i class="fa-solid fa-triangle-exclamation"></i><span><?php echo htmlspecialchars($err); ?></span></div>
            <?php endforeach; ?>

            <form method="POST" novalidate>
                <?php echo csrf_field(); ?>

                <div class="auth-field">
                    <label class="auth-field-label">Nombre de usuario</label>
                    <input type="text" name="username" class="auth-input" placeholder="MoonPlayer" value="<?php echo htmlspecialchars($old['username']); ?>" required>
                </div>

                <div class="auth-field">
                    <label class="auth-field-label">Correo electrónico</label>
                    <input type="email" name="email" class="auth-input" placeholder="tucorreo@ejemplo.com" value="<?php echo htmlspecialchars($old['email']); ?>" required>
                </div>

                <div class="auth-field">
                    <label class="auth-field-label">Contraseña</label>
                    <input type="password" name="password" class="auth-input" placeholder="Mínimo 8 caracteres" required minlength="8">
                </div>

                <div class="auth-field">
                    <label class="auth-field-label">Confirmar contraseña</label>
                    <input type="password" name="confirm_password" class="auth-input" placeholder="Repite tu contraseña" required minlength="8">
                </div>

                <button type="submit" class="auth-submit">Crear cuenta</button>
            </form>

        <?php endif; ?>

        <p class="auth-switch">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>

        <p class="auth-footer-note">Moonly Hosting © 2025 - 2026</p>
    </div>
    <div class="auth-image-side"></div>
</div>

</body>
</html>
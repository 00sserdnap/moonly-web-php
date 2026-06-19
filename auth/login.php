<?php
require_once '../includes/db.php';
require_once '../includes/auth-check.php';
require_once '../includes/csrf.php';

if (isLoggedIn()) {
    header('Location: ../index.php');
    exit;
}

$MAX_ATTEMPTS = 5;
$LOCK_MINUTES = 15;
$errors = [];
$old = ['identifier' => ''];

function tooManyAttempts($db, $ip) {
    global $MAX_ATTEMPTS, $LOCK_MINUTES;
    $stmt = $db->prepare(
        "SELECT COUNT(*) AS c FROM login_attempts
         WHERE ip = ? AND success = 0 AND created_at > (NOW() - INTERVAL ? MINUTE)"
    );
    $stmt->execute([$ip, $LOCK_MINUTES]);
    return $stmt->fetch()['c'] >= $MAX_ATTEMPTS;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDb();
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Token de seguridad inválido. Recarga la página.';
    } elseif (tooManyAttempts($db, $ip)) {
        $errors[] = 'Demasiados intentos fallidos. Intenta de nuevo en ' . $LOCK_MINUTES . ' minutos.';
    } else {
        $identifier = trim($_POST['identifier'] ?? '');
        $password   = $_POST['password'] ?? '';
        $old['identifier'] = $identifier;

        $stmt = $db->prepare('SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1');
        $stmt->execute([$identifier, $identifier]);
        $user = $stmt->fetch();

        $logStmt = $db->prepare('INSERT INTO login_attempts (ip, identifier, success) VALUES (?, ?, ?)');

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $logStmt->execute([$ip, $identifier, 0]);
            $errors[] = 'Usuario/correo o contraseña incorrectos.';
        } elseif ($user['status'] !== 'active') {
            $logStmt->execute([$ip, $identifier, 0]);
            $errors[] = 'Esta cuenta está suspendida o banneada.';
        } elseif (!$user['email_verified']) {
            $logStmt->execute([$ip, $identifier, 0]);
            $errors[] = 'Debes verificar tu correo antes de iniciar sesión.';
        } else {
            $logStmt->execute([$ip, $identifier, 1]);

            session_regenerate_id(true);
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            $upd = $db->prepare('UPDATE users SET last_login = NOW() WHERE id = ?');
            $upd->execute([$user['id']]);

            header('Location: ../index.php');
            exit;
        }
    }
}

$base_path = '../';
$page_title = 'Iniciar Sesión — Moonly Hosting';
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

        <h1 class="auth-title">Iniciar sesión</h1>
        <p class="auth-subtitle">Introduce tus credenciales para continuar.</p>

        <?php foreach ($errors as $err): ?>
            <div class="auth-error"><i class="fa-solid fa-triangle-exclamation"></i><span><?php echo htmlspecialchars($err); ?></span></div>
        <?php endforeach; ?>

        <form method="POST" novalidate>
            <?php echo csrf_field(); ?>

            <div class="auth-field">
                <label class="auth-field-label">Correo o nombre de usuario</label>
                <input type="text" name="identifier" class="auth-input" placeholder="usuario@ejemplo.com" value="<?php echo htmlspecialchars($old['identifier']); ?>" required>
            </div>

            <div class="auth-field">
                <label class="auth-field-label">
                    Contraseña
                    <a href="forgot-password.php">¿Has olvidado la contraseña?</a>
                </label>
                <input type="password" name="password" class="auth-input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="auth-submit">Iniciar sesión</button>
        </form>

        <p class="auth-switch">¿No tienes cuenta? <a href="register.php">Regístrate</a></p>

        <p class="auth-footer-note">Moonly Hosting © 2025 - 2026</p>
    </div>
    <div class="auth-image-side"></div>
</div>

</body>
</html>
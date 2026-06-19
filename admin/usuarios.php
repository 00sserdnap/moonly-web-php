<?php
$base_path = '../';
require_once '../includes/db.php';
require_once '../includes/auth-check.php';
require_once '../includes/csrf.php';

requireRole('admin', '../index.php');
$db = getDb();
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';
    $userId = (int)($_POST['user_id'] ?? 0);

    if ($action === 'set_role') {
        $role = $_POST['role'] ?? 'user';
        if (in_array($role, ['user', 'moderator', 'admin'], true)) {
            $db->prepare('UPDATE users SET role = ? WHERE id = ?')->execute([$role, $userId]);
            $success = 'Rol actualizado.';
        }
    }
    if ($action === 'set_status') {
        $status = $_POST['status'] ?? 'active';
        if (in_array($status, ['active', 'banned', 'suspended'], true)) {
            $db->prepare('UPDATE users SET status = ? WHERE id = ?')->execute([$status, $userId]);
            $success = 'Estado actualizado.';
        }
    }
    if ($action === 'reset_password') {
        $newPass = $_POST['new_password'] ?? '';
        if (strlen($newPass) >= 8) {
            $hash = password_hash($newPass, PASSWORD_BCRYPT);
            $db->prepare('UPDATE users SET password_hash = ? WHERE id = ?')->execute([$hash, $userId]);
            $success = 'Contraseña restablecida con éxito.';
        }
    }
}

$users = $db->query('SELECT id, username, email, role, status, created_at, last_login FROM users ORDER BY created_at DESC')->fetchAll();

$page_title = 'Admin — Usuarios';
$extra_css = 'css/foro.css';
$body_class = 'foro-body';
include '../includes/header.php';
?>

<section class="foro-section">
    <div class="foro-wrap" style="max-width: 1100px;">
        <h1 style="font-size:1.4rem; font-weight:800; margin-bottom:20px;"><i class="fa-solid fa-users" style="color:var(--cyan);"></i> Gestionar Usuarios</h1>

        <?php if ($success): ?><div class="auth-success"><i class="fa-solid fa-circle-check"></i><span><?php echo htmlspecialchars($success); ?></span></div><?php endif; ?>

        <?php foreach ($users as $u): ?>
            <div class="foro-cat-card" style="flex-wrap:wrap; align-items:flex-start;">
                <div style="flex:1; min-width:200px;">
                    <div class="foro-cat-name"><?php echo htmlspecialchars($u['username']); ?></div>
                    <div class="foro-cat-desc"><?php echo htmlspecialchars($u['email']); ?></div>
                    <div class="foro-cat-desc">Registrado: <?php echo $u['created_at']; ?> · Último login: <?php echo $u['last_login'] ?? 'Nunca'; ?></div>
                </div>

                <form method="POST" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="action" value="set_role">
                    <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                    <select name="role" class="foro-input" style="margin-bottom:0; padding:8px 10px; width:auto;">
                        <option value="user" <?php echo $u['role'] === 'user' ? 'selected' : ''; ?>>Usuario</option>
                        <option value="moderator" <?php echo $u['role'] === 'moderator' ? 'selected' : ''; ?>>Moderador</option>
                        <option value="admin" <?php echo $u['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                    <button type="submit" class="foro-mod-btn">Guardar rol</button>
                </form>

                <form method="POST" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="action" value="set_status">
                    <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                    <select name="status" class="foro-input" style="margin-bottom:0; padding:8px 10px; width:auto;">
                        <option value="active" <?php echo $u['status'] === 'active' ? 'selected' : ''; ?>>Activo</option>
                        <option value="suspended" <?php echo $u['status'] === 'suspended' ? 'selected' : ''; ?>>Suspendido</option>
                        <option value="banned" <?php echo $u['status'] === 'banned' ? 'selected' : ''; ?>>Banneado</option>
                    </select>
                    <button type="submit" class="foro-mod-btn">Guardar estado</button>
                </form>

                <form method="POST" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="action" value="reset_password">
                    <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                    <input type="password" name="new_password" class="foro-input" style="margin-bottom:0; width:160px;" placeholder="Nueva clave (8+ car.)" minlength="8">
                    <button type="submit" class="foro-mod-btn">Resetear clave</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
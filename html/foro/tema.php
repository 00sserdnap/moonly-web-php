<?php
$base_path = '../../';
require_once '../../includes/db.php';
require_once '../../includes/auth-check.php';
require_once '../../includes/csrf.php';
require_once '../../includes/helpers.php';

$db = getDb();
$topicId = (int)($_GET['id'] ?? 0);

$stmt = $db->prepare(
    "SELECT t.*, c.name AS cat_name, c.slug AS cat_slug, u.username AS author_username
     FROM forum_topics t
     JOIN forum_categories c ON t.category_id = c.id
     JOIN users u ON t.user_id = u.id
     WHERE t.id = ?"
);
$stmt->execute([$topicId]);
$topic = $stmt->fetch();

if (!$topic) {
    http_response_code(404);
    die('Tema no encontrado.');
}

$user = currentUser();
$isMod = $user && in_array($user['role'], ['moderator', 'admin'], true);

/* ── Acciones de moderación / respuesta (POST) ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $postError = 'Token de seguridad inválido. Recarga la página.';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'reply' && isLoggedIn() && !$topic['is_locked']) {
            $content = trim($_POST['content'] ?? '');
            if (mb_strlen($content) >= 3) {
                $stmt = $db->prepare('INSERT INTO forum_posts (topic_id, user_id, content) VALUES (?, ?, ?)');
                $stmt->execute([$topicId, $user['id'], $content]);
                $upd = $db->prepare('UPDATE forum_topics SET updated_at = NOW() WHERE id = ?');
                $upd->execute([$topicId]);
                header('Location: tema.php?id=' . $topicId . '#post-bottom');
                exit;
            }
        }

        if ($isMod) {
            if ($action === 'pin') {
                $db->prepare('UPDATE forum_topics SET is_pinned = NOT is_pinned WHERE id = ?')->execute([$topicId]);
                header('Location: tema.php?id=' . $topicId); exit;
            }
            if ($action === 'lock') {
                $db->prepare('UPDATE forum_topics SET is_locked = NOT is_locked WHERE id = ?')->execute([$topicId]);
                header('Location: tema.php?id=' . $topicId); exit;
            }
            if ($action === 'delete_topic') {
                $db->prepare('DELETE FROM forum_topics WHERE id = ?')->execute([$topicId]);
                header('Location: ../foro/categoria.php?slug=' . urlencode($topic['cat_slug'])); exit;
            }
            if ($action === 'delete_post') {
                $postId = (int)($_POST['post_id'] ?? 0);
                $db->prepare('DELETE FROM forum_posts WHERE id = ? AND topic_id = ?')->execute([$postId, $topicId]);
                header('Location: tema.php?id=' . $topicId); exit;
            }
            if ($action === 'ban_user') {
                $targetUserId = (int)($_POST['target_user_id'] ?? 0);
                $db->prepare("UPDATE users SET status = 'banned' WHERE id = ?")->execute([$targetUserId]);
                header('Location: tema.php?id=' . $topicId); exit;
            }
        }
    }
}

/* Sumar vista (simple, sin dedupe por IP para mantenerlo simple) */
$db->prepare('UPDATE forum_topics SET views = views + 1 WHERE id = ?')->execute([$topicId]);

$stmt = $db->prepare(
    "SELECT p.*, u.username, u.role, u.id AS author_id
     FROM forum_posts p
     JOIN users u ON p.user_id = u.id
     WHERE p.topic_id = ?
     ORDER BY p.created_at ASC"
);
$stmt->execute([$topicId]);
$posts = $stmt->fetchAll();

$page_title = htmlspecialchars($topic['title']) . ' — Foro Moonly';
$extra_css = 'css/foro.css';
$body_class = 'foro-body';
include '../../includes/header.php';
?>

<nav class="breadcrumb-bar">
    <div class="container">
        <a href="<?php echo $base_path; ?>index.php">Inicio</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="index.php">Foro</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="categoria.php?slug=<?php echo urlencode($topic['cat_slug']); ?>"><?php echo htmlspecialchars($topic['cat_name']); ?></a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current"><?php echo htmlspecialchars($topic['title']); ?></span>
    </div>
</nav>

<section class="foro-section">
    <div class="foro-wrap">

        <?php if (!empty($postError)): ?>
            <div class="auth-error"><i class="fa-solid fa-triangle-exclamation"></i><span><?php echo htmlspecialchars($postError); ?></span></div>
        <?php endif; ?>

        <div class="foro-topic-header">
            <h1>
                <?php if ($topic['is_pinned']): ?><i class="fa-solid fa-thumbtack" style="color:var(--yellow);"></i><?php endif; ?>
                <?php if ($topic['is_locked']): ?><i class="fa-solid fa-lock" style="color:var(--muted);"></i><?php endif; ?>
                <?php echo htmlspecialchars($topic['title']); ?>
            </h1>
            <div class="foro-topic-header-meta">
                Creado por <strong><?php echo htmlspecialchars($topic['author_username']); ?></strong> · <?php echo timeAgo($topic['created_at']); ?> · <?php echo (int)$topic['views']; ?> vistas
            </div>
        </div>

        <?php if ($isMod): ?>
            <div class="foro-mod-bar">
                <form method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="action" value="pin">
                    <button type="submit" class="foro-mod-btn"><i class="fa-solid fa-thumbtack"></i> <?php echo $topic['is_pinned'] ? 'Quitar fijado' : 'Fijar tema'; ?></button>
                </form>
                <form method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="action" value="lock">
                    <button type="submit" class="foro-mod-btn"><i class="fa-solid fa-lock"></i> <?php echo $topic['is_locked'] ? 'Abrir tema' : 'Cerrar tema'; ?></button>
                </form>
                <form method="POST" style="display:inline;" onsubmit="return confirm('¿Borrar este tema completo y todas sus respuestas? Esta acción no se puede deshacer.');">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="action" value="delete_topic">
                    <button type="submit" class="foro-mod-btn danger"><i class="fa-solid fa-trash"></i> Borrar tema</button>
                </form>
            </div>
        <?php endif; ?>

        <?php foreach ($posts as $p): ?>
            <div class="foro-post" id="post-<?php echo $p['id']; ?>">
                <div class="foro-post-author">
                    <div class="foro-post-avatar"><i class="fa-solid fa-user"></i></div>
                    <div class="foro-post-username"><?php echo htmlspecialchars($p['username']); ?></div>
                    <div class="foro-post-role <?php echo htmlspecialchars($p['role']); ?>">
                        <?php echo $p['role'] === 'admin' ? 'Admin' : ($p['role'] === 'moderator' ? 'Moderador' : 'Usuario'); ?>
                    </div>
                </div>
                <div class="foro-post-body">
                    <div class="foro-post-meta">
                        <?php echo timeAgo($p['created_at']); ?>
                        <?php if ($p['edited_at']): ?> · editado <?php echo timeAgo($p['edited_at']); ?><?php endif; ?>
                    </div>
                    <div class="foro-post-content"><?php echo bbToHtml($p['content']); ?></div>

                    <?php if ($isMod): ?>
                        <div class="foro-mod-bar" style="margin-top:14px; margin-bottom:0;">
                            <form method="POST" style="display:inline;" onsubmit="return confirm('¿Borrar esta respuesta?');">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="action" value="delete_post">
                                <input type="hidden" name="post_id" value="<?php echo $p['id']; ?>">
                                <button type="submit" class="foro-mod-btn danger" style="padding:5px 10px; font-size:.72rem;"><i class="fa-solid fa-trash"></i> Borrar</button>
                            </form>
                            <?php if ($p['author_id'] != $user['id']): ?>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('¿Banear a este usuario? No podrá iniciar sesión.');">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="action" value="ban_user">
                                <input type="hidden" name="target_user_id" value="<?php echo $p['author_id']; ?>">
                                <button type="submit" class="foro-mod-btn danger" style="padding:5px 10px; font-size:.72rem;"><i class="fa-solid fa-gavel"></i> Banear autor</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div id="post-bottom"></div>

        <?php if ($topic['is_locked']): ?>
            <div class="foro-locked-note">
                <i class="fa-solid fa-lock"></i>
                <span>Este tema está cerrado. No se pueden agregar más respuestas.</span>
            </div>
        <?php elseif (isLoggedIn()): ?>
            <form method="POST" class="foro-form-card">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="action" value="reply">
                <label>Responder a este tema</label>
                <textarea name="content" class="foro-textarea" placeholder="Escribe tu respuesta..." required minlength="3"></textarea>
                <button type="submit" class="foro-submit-btn"><i class="fa-solid fa-reply"></i> Responder</button>
            </form>
        <?php else: ?>
            <div class="foro-form-card" style="text-align:center;">
                <p style="color:var(--muted); margin-bottom:14px;">Debes iniciar sesión para responder.</p>
                <a href="<?php echo $base_path; ?>auth/login.php" class="foro-submit-btn" style="display:inline-block; text-decoration:none;">Iniciar sesión</a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php include '../../includes/footer.php'; ?>
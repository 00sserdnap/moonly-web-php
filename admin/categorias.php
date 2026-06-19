<?php
$base_path = '../';
require_once '../includes/db.php';
require_once '../includes/auth-check.php';
require_once '../includes/csrf.php';
require_once '../includes/helpers.php';

requireRole('admin', '../index.php');

$db = getDb();
$slug = $_GET['slug'] ?? '';

$stmt = $db->prepare('SELECT * FROM forum_categories WHERE slug = ?');
$stmt->execute([$slug]);
$category = $stmt->fetch();

if (!$category) {
    http_response_code(404);
    die('Categoría no encontrada.');
}

$stmt = $db->prepare(
    "SELECT t.*, u.username,
        (SELECT COUNT(*) FROM forum_posts p WHERE p.topic_id = t.id) AS post_count
     FROM forum_topics t
     JOIN users u ON t.user_id = u.id
     WHERE t.category_id = ?
     ORDER BY t.is_pinned DESC, t.updated_at DESC"
);
$stmt->execute([$category['id']]);
$topics = $stmt->fetchAll();

$page_title = htmlspecialchars($category['name']) . ' — Foro Moonly';
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
        <span class="current"><?php echo htmlspecialchars($category['name']); ?></span>
    </div>
</nav>

<section class="foro-section">
    <div class="foro-wrap">
        <div class="foro-topbar">
            <h1><i class="fa-solid <?php echo htmlspecialchars($category['icon']); ?>" style="color:var(--cyan);"></i> <?php echo htmlspecialchars($category['name']); ?></h1>
            <?php if (isLoggedIn()): ?>
                <a href="nuevo-tema.php?categoria=<?php echo urlencode($category['slug']); ?>" class="foro-new-topic-btn">
                    <i class="fa-solid fa-plus"></i> Nuevo Tema
                </a>
            <?php else: ?>
                <a href="<?php echo $base_path; ?>auth/login.php" class="foro-new-topic-btn">
                    <i class="fa-solid fa-user"></i> Inicia sesión para crear un tema
                </a>
            <?php endif; ?>
        </div>

        <?php if (empty($topics)): ?>
            <div class="foro-empty">
                <i class="fa-solid fa-comment-slash"></i>
                <p>Aún no hay temas en esta categoría. ¡Sé el primero en crear uno!</p>
            </div>
        <?php else: ?>
            <div class="foro-topic-list">
                <?php foreach ($topics as $t): ?>
                    <a href="tema.php?id=<?php echo $t['id']; ?>" class="foro-topic-row<?php echo $t['is_pinned'] ? ' pinned' : ''; ?>">
                        <div class="foro-topic-main">
                            <div class="foro-topic-title">
                                <?php if ($t['is_pinned']): ?><i class="fa-solid fa-thumbtack"></i><?php endif; ?>
                                <?php if ($t['is_locked']): ?><i class="fa-solid fa-lock"></i><?php endif; ?>
                                <?php echo htmlspecialchars($t['title']); ?>
                            </div>
                            <div class="foro-topic-meta">por <strong><?php echo htmlspecialchars($t['username']); ?></strong> · <?php echo timeAgo($t['created_at']); ?></div>
                        </div>
                        <div class="foro-topic-stats">
                            <div><span><?php echo (int)$t['post_count']; ?></span>respuestas</div>
                            <div><span><?php echo (int)$t['views']; ?></span>vistas</div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
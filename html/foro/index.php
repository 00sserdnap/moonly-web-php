<?php
$base_path = '../../';
require_once '../../includes/db.php';
require_once '../../includes/auth-check.php';

$page_title = 'Foro — Moonly Hosting';
$extra_css = 'css/foro.css';
$body_class = 'foro-body';

$db = getDb();
$categories = $db->query(
    "SELECT c.*,
        (SELECT COUNT(*) FROM forum_topics t WHERE t.category_id = c.id) AS topic_count,
        (SELECT COUNT(*) FROM forum_posts p JOIN forum_topics t2 ON p.topic_id = t2.id WHERE t2.category_id = c.id) AS post_count
     FROM forum_categories c
     ORDER BY c.order_index ASC, c.name ASC"
)->fetchAll();

include '../../includes/header.php';
?>

<nav class="breadcrumb-bar">
    <div class="container">
        <a href="<?php echo $base_path; ?>index.php">Inicio</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current">Foro</span>
    </div>
</nav>

<section class="foro-hero">
    <div class="container">
        <h1 class="foro-hero-title">Foro de la Comunidad</h1>
        <p class="foro-hero-desc">Pide ayuda, comparte tu configuración o resuelve dudas con otros usuarios, moderadores y el equipo de Moonly.</p>
    </div>
</section>

<section class="foro-section">
    <div class="foro-wrap">
        <?php if (empty($categories)): ?>
            <div class="foro-empty">
                <i class="fa-solid fa-comments"></i>
                <p>Todavía no hay categorías creadas en el foro.</p>
            </div>
        <?php else: ?>
            <div class="foro-cat-list">
                <?php foreach ($categories as $cat): ?>
                    <a href="categoria.php?slug=<?php echo urlencode($cat['slug']); ?>" class="foro-cat-card">
                        <div class="foro-cat-icon"><i class="fa-solid <?php echo htmlspecialchars($cat['icon']); ?>"></i></div>
                        <div class="foro-cat-info">
                            <div class="foro-cat-name"><?php echo htmlspecialchars($cat['name']); ?></div>
                            <div class="foro-cat-desc"><?php echo htmlspecialchars($cat['description']); ?></div>
                        </div>
                        <div class="foro-cat-stats">
                            <strong><?php echo (int)$cat['topic_count']; ?></strong> temas
                            <br><?php echo (int)$cat['post_count']; ?> respuestas
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
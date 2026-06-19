<?php
$base_path = '../../';
require_once '../../includes/db.php';
require_once '../../includes/auth-check.php';
require_once '../../includes/csrf.php';
require_once '../../includes/helpers.php';

requireLogin('../../auth/login.php');
$user = currentUser();
$db = getDb();

$catSlug = $_GET['categoria'] ?? $_POST['categoria'] ?? '';
$stmt = $db->prepare('SELECT * FROM forum_categories WHERE slug = ?');
$stmt->execute([$catSlug]);
$category = $stmt->fetch();

if (!$category) {
    http_response_code(404);
    die('Categoría no encontrada.');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Token de seguridad inválido. Recarga la página.';
    } else {
        $title   = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if (mb_strlen($title) < 5 || mb_strlen($title) > 150) {
            $errors[] = 'El título debe tener entre 5 y 150 caracteres.';
        }
        if (mb_strlen($content) < 10) {
            $errors[] = 'El mensaje debe tener al menos 10 caracteres.';
        }

        if (empty($errors)) {
            $slug = slugify($title) . '-' . substr(bin2hex(random_bytes(3)), 0, 6);

            $stmt = $db->prepare(
                'INSERT INTO forum_topics (category_id, user_id, title, slug) VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([$category['id'], $user['id'], $title, $slug]);
            $topicId = $db->lastInsertId();

            $stmt = $db->prepare(
                'INSERT INTO forum_posts (topic_id, user_id, content) VALUES (?, ?, ?)'
            );
            $stmt->execute([$topicId, $user['id'], $content]);

            header('Location: tema.php?id=' . $topicId);
            exit;
        }
    }
}

$page_title = 'Nuevo Tema — Foro Moonly';
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
        <a href="categoria.php?slug=<?php echo urlencode($category['slug']); ?>"><?php echo htmlspecialchars($category['name']); ?></a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current">Nuevo Tema</span>
    </div>
</nav>

<section class="foro-section">
    <div class="foro-wrap" style="max-width:700px;">
        <h1 style="font-size:1.4rem; font-weight:800; margin-bottom:20px;">Crear nuevo tema en <?php echo htmlspecialchars($category['name']); ?></h1>

        <?php foreach ($errors as $err): ?>
            <div class="auth-error"><i class="fa-solid fa-triangle-exclamation"></i><span><?php echo htmlspecialchars($err); ?></span></div>
        <?php endforeach; ?>

        <form method="POST" class="foro-form-card">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="categoria" value="<?php echo htmlspecialchars($category['slug']); ?>">

            <label>Título del tema</label>
            <input type="text" name="title" class="foro-input" placeholder="Ej: ¿Cómo configuro un backup automático?" required minlength="5" maxlength="150" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">

            <label>Tu mensaje</label>
            <textarea name="content" class="foro-textarea" placeholder="Explica tu duda o tema con el mayor detalle posible..." required minlength="10"><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>

            <button type="submit" class="foro-submit-btn"><i class="fa-solid fa-paper-plane"></i> Publicar Tema</button>
        </form>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
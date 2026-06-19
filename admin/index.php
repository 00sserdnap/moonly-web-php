<?php
$base_path = '../';
require_once '../includes/auth-check.php';

requireRole(['moderator', 'admin'], '../index.php');
$user = currentUser();

$page_title = 'Panel Admin — Moonly Hosting';
$extra_css = 'css/foro.css';
$body_class = 'foro-body';
include '../includes/header.php';
?>

<section class="foro-section">
    <div class="foro-wrap">
        <h1 style="font-size:1.4rem; font-weight:800; margin-bottom:20px;"><i class="fa-solid fa-gauge" style="color:var(--cyan);"></i> Panel de Administración</h1>

        <div class="foro-cat-list">
            <a href="<?php echo $base_path; ?>html/foro/index.php" class="foro-cat-card">
                <div class="foro-cat-icon"><i class="fa-solid fa-comments"></i></div>
                <div class="foro-cat-info">
                    <div class="foro-cat-name">Ir al Foro</div>
                    <div class="foro-cat-desc">Ver y moderar temas y respuestas.</div>
                </div>
            </a>

            <?php if ($user['role'] === 'admin'): ?>
                <a href="categorias.php" class="foro-cat-card">
                    <div class="foro-cat-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <div class="foro-cat-info">
                        <div class="foro-cat-name">Categorías del Foro</div>
                        <div class="foro-cat-desc">Crear, editar y eliminar categorías.</div>
                    </div>
                </a>

                <a href="usuarios.php" class="foro-cat-card">
                    <div class="foro-cat-icon"><i class="fa-solid fa-users"></i></div>
                    <div class="foro-cat-info">
                        <div class="foro-cat-name">Usuarios</div>
                        <div class="foro-cat-desc">Cambiar roles, banear/suspender, resetear contraseñas.</div>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
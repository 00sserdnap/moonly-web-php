<?php
// Variables para esta página (¡Método Moonly!)
$base_path = '../';
$page_title = 'Discord Bot Hosting — Moonly Hosting';
$extra_css = 'css/planes.css'; // Reutilizamos el CSS de la grilla
$body_class = 'planes-body';
$extra_js = 'js/discordbot.js'; // Llamamos al nuevo JS

include '../includes/header.php';
?>

<nav class="breadcrumb-bar">
    <div class="container">
        <a href="../index.php" data-i18n="plans.breadcrumb_home">Inicio</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current" data-i18n="discord.breadcrumb_current">Hosting Discord Bot</span>
    </div>
</nav>

<section class="plan-hero">
    <div class="container">
        <div class="plan-hero-media">
            <div class="plan-hero-cover" style="border-color: rgba(88,101,242,.3); box-shadow: 0 24px 48px rgba(88,101,242,.15);">
                <img src="../images/services/discordbot.png" alt="Discord Bot Hosting" onerror="this.style.opacity='.15';">
            </div>
            <a href="#planes" class="plan-hero-link" style="color: #5865F2;">
                <i class="fa-solid fa-arrow-down"></i> <span data-i18n="plans.view_website">Ver características</span>
            </a>
        </div>

        <div class="plan-hero-content">
            <h1 class="plan-hero-title" data-i18n="discord.hero_title">Hosting para Bots de Discord</h1>

            <div class="plan-hero-badges">
                <span class="plan-badge"><i class="fa-brands fa-discord" style="color: #5865F2;"></i> <span>Node.js, Python, Java</span></span>
                <span class="plan-badge"><i class="fa-solid fa-bolt" style="color: var(--yellow);"></i> <span>24/7 Online</span></span>
            </div>

            <p class="plan-hero-desc" data-i18n="discord.hero_desc">Mantén tu bot en línea 24/7 sin complicaciones. Soporte para Node.js, Python, Java y más. Precios económicos con el máximo rendimiento y baja latencia garantizada.</p>

            <div class="plan-hero-buttons">
                <a href="#planes" class="btn-cta" style="background: linear-gradient(135deg, rgba(88,101,242,.25) 0%, rgba(88,101,242,.7) 100%); border-color: #5865F2; box-shadow: 0 0 22px rgba(88,101,242,.35);"><i class="fa-solid fa-robot"></i> <span data-i18n="plans.btn_explore">Ver Planes</span></a>
            </div>
        </div>
    </div>
</section>

<section class="duration-section" id="planes">
    <div class="container">
        <p class="section-subtitle" data-i18n="plans.section_subtitle">ELIGE TU PLAN</p>
        <h2 class="section-title" data-i18n="discord.hero_title">Planes Discord Bot</h2>
        <p class="section-desc" style="margin-bottom:36px;" data-i18n="plans.section_desc">Elige cuántos meses pagar por adelantado para obtener descuentos.</p>

        <div class="duration-switch" id="duration-switch">
            <div class="duration-option active" data-months="1">
                <span data-i18n="plans.duration_1">1 mes</span>
            </div>
            <div class="duration-option" data-months="3">
                <span data-i18n="plans.duration_3">3 meses</span>
                <span class="duration-badge" data-i18n="plans.duration_3_badge">Popular</span>
            </div>
            <div class="duration-option" data-months="6">
                <span data-i18n="plans.duration_6">6 meses</span>
                <span class="duration-badge" data-i18n="plans.duration_6_badge">Mejor precio total</span>
            </div>
        </div>
    </div>
</section>

<section class="plans-section">
    <div class="container">
        <div class="plans-grid" id="discord-plans-grid">
            </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
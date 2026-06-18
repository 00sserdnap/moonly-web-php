<?php
// Definimos las variables para esta página específica en la subcarpeta
$base_path = '../';
$page_title = 'Planes Minecraft — Moonly Hosting';
$extra_css = 'css/planes.css';
$body_class = 'planes-body';
$extra_js = 'js/planes.js';

// Llamamos al encabezado
include '../includes/header.php';
?>

<nav class="breadcrumb-bar">
    <div class="container">
        <a href="../index.php" data-i18n="plans.breadcrumb_home">Inicio</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current" data-i18n="plans.breadcrumb_current">Hosting Minecraft</span>
    </div>
</nav>

<section class="plan-hero">
    <div class="container">
        <div class="plan-hero-media">
            <div class="plan-hero-cover">
                <img src="../images/minecraft/minecraft-planes.png" alt="Minecraft Hosting"
                    onerror="this.style.opacity='.15';">
            </div>
            <a href="#planes" class="plan-hero-link">
                <i class="fa-solid fa-arrow-down"></i> <span data-i18n="plans.view_website">Ver características</span>
            </a>
        </div>

        <div class="plan-hero-content">
            <h1 class="plan-hero-title" data-i18n="plans.hero_title">Hosting para Servidores de Minecraft</h1>

            <div class="plan-hero-badges">
                <span class="plan-badge"><i class="fa-solid fa-server"></i> <span data-i18n="plans.badge_servers">Servidores activos en LATAM</span></span>
                <span class="plan-badge"><i class="fa-solid fa-earth-americas"></i> <span data-i18n="plans.badge_locations">Disponible en Chile y EE.UU.</span></span>
            </div>

            <p class="plan-hero-desc" data-i18n="plans.hero_desc">Arma tu servidor en el hardware más rápido, con un precio justo y transparente: pagas exactamente por la RAM que necesitas. ¿Juegas con amigos? ¿Corres mods? ¿Armas una comunidad? Tenemos el plan para ti.</p>

            <div class="plan-hero-buttons">
                <a href="#planes" class="btn-cta"><i class="fa-solid fa-rocket"></i> <span data-i18n="plans.btn_explore">Ver Planes</span></a>
                <a href="https://discord.gg/moonly" target="_blank" class="btn-secondary"><i class="fa-brands fa-discord"></i> <span data-i18n="plans.btn_trial">Habla con Soporte</span></a>
                <span class="trial-note" data-i18n="plans.trial_note">Activación inmediata, sin contratos.</span>
            </div>
        </div>
    </div>
</section>

<section class="duration-section" id="planes">
    <div class="container">
        <p class="section-subtitle" data-i18n="plans.section_subtitle">ELIGE TU PLAN</p>
        <h2 class="section-title" data-i18n="plans.section_title">Planes Minecraft</h2>
        <p class="section-desc" style="margin-bottom:36px;" data-i18n="plans.section_desc">Mismo precio por GB siempre — $1.70 USD por GB al mes. Elige cuántos meses pagar por adelantado.</p>

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
        <div class="plans-grid" id="plans-grid">
            </div>
    </div>
</section>

<?php
// Llamamos al pie de página (el script planes.js ya está configurado en las variables de arriba)
include '../includes/footer.php';
?>
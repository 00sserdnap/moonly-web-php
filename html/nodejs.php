<?php
$base_path = '../';
$page_title = 'Node.js Hosting — Moonly Hosting';
$extra_css = 'css/planes.css';
$body_class = 'planes-body';
$extra_js = 'js/nodejs.js';

include '../includes/header.php';
?>

    <nav class="breadcrumb-bar">
        <div class="container">
            <a href="../index.php" data-i18n="plans.breadcrumb_home">Inicio</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span class="current" data-i18n="nodejs.breadcrumb_current">Hosting Node.js</span>
        </div>
    </nav>

    <section class="plan-hero">
        <div class="container">
            <div class="plan-hero-media">
                <div class="plan-hero-cover" style="border-color: rgba(60,135,58,.3); box-shadow: 0 24px 48px rgba(60,135,58,.15);">
                    <img src="../images/services/nodejs.png" alt="Node.js Hosting" onerror="this.style.opacity='.15';">
                </div>
                <a href="#planes" class="plan-hero-link" style="color: #3c873a;">
                    <i class="fa-solid fa-arrow-down"></i> <span data-i18n="plans.view_website">Ver características</span>
                </a>
            </div>

            <div class="plan-hero-content">
                <h1 class="plan-hero-title" data-i18n="nodejs.hero_title">Hosting para Aplicaciones Node.js</h1>

                <div class="plan-hero-badges">
                    <span class="plan-badge"><i class="fa-brands fa-node-js" style="color: #3c873a;"></i> <span>npm · PM2 · APIs en tiempo real</span></span>
                    <span class="plan-badge"><i class="fa-solid fa-bolt" style="color: var(--yellow);"></i> <span>24/7 Online</span></span>
                </div>

                <p class="plan-hero-desc" data-i18n="nodejs.hero_desc">Despliega tus APIs, bots y apps en tiempo real con Node.js. Gestor de procesos, reinicio automático y baja latencia incluidos en todos los planes.</p>

                <div class="plan-hero-buttons">
                    <a href="#planes" class="btn-cta" style="background: linear-gradient(135deg, rgba(60,135,58,.25) 0%, rgba(60,135,58,.7) 100%); border-color: #3c873a; box-shadow: 0 0 22px rgba(60,135,58,.35);"><i class="fa-brands fa-node-js"></i> <span data-i18n="plans.btn_explore">Ver Planes</span></a>
                </div>
            </div>
        </div>
    </section>

    <section class="duration-section" id="planes">
        <div class="container">
            <p class="section-subtitle" data-i18n="plans.section_subtitle">ELIGE TU PLAN</p>
            <h2 class="section-title" data-i18n="nodejs.hero_title">Planes Node.js</h2>
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
            <div class="plans-grid" id="nodejs-plans-grid">
            </div>
        </div>
    </section>

<?php include '../includes/footer.php'; ?>
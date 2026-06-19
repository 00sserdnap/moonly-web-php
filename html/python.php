<?php
$base_path = '../';
$page_title = 'Python Hosting — Moonly Hosting';
$extra_css = 'css/planes.css';
$body_class = 'planes-body';
$extra_js = 'js/python.js';

include '../includes/header.php';
?>

    <nav class="breadcrumb-bar">
        <div class="container">
            <a href="../index.php" data-i18n="plans.breadcrumb_home">Inicio</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span class="current" data-i18n="python.breadcrumb_current">Hosting Python</span>
        </div>
    </nav>

    <section class="plan-hero">
        <div class="container">
            <div class="plan-hero-media">
                <div class="plan-hero-cover" style="border-color: rgba(55,118,171,.3); box-shadow: 0 24px 48px rgba(55,118,171,.15);">
                    <img src="../images/services/python.png" alt="Python Hosting" onerror="this.style.opacity='.15';">
                </div>
                <a href="#planes" class="plan-hero-link" style="color: #3776ab;">
                    <i class="fa-solid fa-arrow-down"></i> <span data-i18n="plans.view_website">Ver características</span>
                </a>
            </div>

            <div class="plan-hero-content">
                <h1 class="plan-hero-title" data-i18n="python.hero_title">Hosting para Aplicaciones Python</h1>

                <div class="plan-hero-badges">
                    <span class="plan-badge"><i class="fa-brands fa-python" style="color: #3776ab;"></i> <span>pip · venv · systemd</span></span>
                    <span class="plan-badge"><i class="fa-solid fa-bolt" style="color: var(--yellow);"></i> <span>24/7 Online</span></span>
                </div>

                <p class="plan-hero-desc" data-i18n="python.hero_desc">Aloja bots, APIs y scripts en Python sin preocuparte por el servidor. Acceso a consola, gestor de procesos y reinicio automático incluidos.</p>

                <div class="plan-hero-buttons">
                    <a href="#planes" class="btn-cta" style="background: linear-gradient(135deg, rgba(55,118,171,.25) 0%, rgba(55,118,171,.7) 100%); border-color: #3776ab; box-shadow: 0 0 22px rgba(55,118,171,.35);"><i class="fa-brands fa-python"></i> <span data-i18n="plans.btn_explore">Ver Planes</span></a>
                </div>
            </div>
        </div>
    </section>

    <section class="duration-section" id="planes">
        <div class="container">
            <p class="section-subtitle" data-i18n="plans.section_subtitle">ELIGE TU PLAN</p>
            <h2 class="section-title" data-i18n="python.hero_title">Planes Python</h2>
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
            <div class="plans-grid" id="python-plans-grid">
            </div>
        </div>
    </section>

<?php include '../includes/footer.php'; ?>
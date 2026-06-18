<?php
// Definimos las variables para esta página específica en la subcarpeta
$base_path = '../';
$page_title = 'Preguntas Frecuentes — Moonly Hosting';
$extra_css = 'css/faq.css';
$body_class = 'faq-body';
$extra_js = 'js/faq.js';

include '../includes/header.php';
?>

<nav class="breadcrumb-bar">
    <div class="container">
        <a href="../index.php" data-i18n="plans.breadcrumb_home">Inicio</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current" data-i18n="faq.breadcrumb_current">Preguntas Frecuentes</span>
    </div>
</nav>

<section class="faq-hero">
    <div class="container">
        <div class="faq-hero-icon"><i class="fa-solid fa-circle-question"></i></div>
        <h1 class="faq-hero-title" data-i18n="faq.hero_title">¿En qué podemos ayudarte?</h1>
        <p class="faq-hero-desc" data-i18n="faq.hero_desc">Respuestas rápidas sobre nuestros planes de Minecraft, servidores dedicados, Network Packs, bots de Discord, pagos y soporte. Si no encuentras lo que buscas, nuestro equipo está a un mensaje de distancia.</p>

        <div class="faq-search-wrap" id="faq-search-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="faq-search" class="faq-search" autocomplete="off" data-i18n-attr="placeholder:faq.search_placeholder" placeholder="Busca por palabra clave, ej: backups, reembolso, RAM...">
            <span class="faq-search-clear" id="faq-search-clear"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <p class="faq-search-meta" id="faq-search-meta"></p>
    </div>
</section>

<section class="faq-tabs-section">
    <div class="faq-tabs" id="faq-tabs"></div>
</section>

<section class="faq-section">
    <div class="faq-wrap" id="faq-wrap"></div>

    <div class="faq-wrap">
        <div class="faq-cta">
            <div>
                <div class="faq-cta-text-title" data-i18n="faq.cta_title">¿No encontraste tu respuesta?</div>
                <div class="faq-cta-text-desc" data-i18n="faq.cta_desc">Escríbenos por Discord o correo y un miembro de nuestro equipo te ayudará a resolverlo lo antes posible.</div>
            </div>
            <div class="faq-cta-buttons">
                <a href="https://discord.gg/moonly" target="_blank" class="faq-cta-btn primary">
                    <i class="fa-brands fa-discord"></i> <span data-i18n="plans.btn_trial">Habla con Soporte</span>
                </a>
                <a href="mailto:soporte@moonly.es" class="faq-cta-btn secondary">
                    <i class="fa-solid fa-envelope"></i> <span data-i18n="nav.email">Email soporte</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
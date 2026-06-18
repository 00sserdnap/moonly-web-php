<?php
// Definimos las variables para esta página específica en la subcarpeta
$base_path = '../';
$page_title = 'Cloud Dedicated — Moonly Hosting';
$extra_css = 'css/planes.css'; // Reutilizamos el hero/breadcrumb/botones de planes.css
$body_class = 'dedicados-body';

// Llamamos al encabezado
include '../includes/header.php';
?>
<link rel="stylesheet" href="<?php echo $base_path; ?>css/dedicados.css?v=10">

<nav class="breadcrumb-bar">
    <div class="container">
        <a href="../index.php" data-i18n="plans.breadcrumb_home">Inicio</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current" data-i18n="dedi.breadcrumb_current">Cloud Dedicated</span>
    </div>
</nav>

<section class="plan-hero">
    <div class="container">
        <div class="plan-hero-media">
            <div class="plan-hero-cover">
                <img src="../images/services/dedicated.png" alt="Cloud Dedicated"
                    onerror="this.style.opacity='.15';">
            </div>
            <a href="#planes" class="plan-hero-link">
                <i class="fa-solid fa-arrow-down"></i> <span data-i18n="plans.view_website">Ver características</span>
            </a>
        </div>

        <div class="plan-hero-content">
            <h1 class="plan-hero-title" data-i18n="dedi.hero_title">Servidores Dedicados Bare Metal</h1>

            <div class="plan-hero-badges">
                <span class="plan-badge"><i class="fa-solid fa-microchip"></i> <span data-i18n="dedi.badge_hardware">Hardware AMD Ryzen de última gen</span></span>
                <span class="plan-badge"><i class="fa-solid fa-earth-americas"></i> <span data-i18n="dedi.badge_locations">New York · Miami · Los Angeles</span></span>
            </div>

            <p class="plan-hero-desc" data-i18n="dedi.hero_desc">Potencia bare metal sin virtualización: todo el servidor es tuyo. Ideal para hosting de alto tráfico, bases de datos exigentes, redes de Minecraft o cualquier proyecto que necesite rendimiento dedicado real.</p>

            <div class="plan-hero-buttons">
                <a href="#planes" class="btn-cta"><i class="fa-solid fa-server"></i> <span data-i18n="dedi.btn_explore">Ver Servidores</span></a>
                <a href="https://discord.gg/moonly" target="_blank" class="btn-secondary"><i class="fa-brands fa-discord"></i> <span data-i18n="plans.btn_trial">Habla con Soporte</span></a>
                <span class="trial-note" data-i18n="dedi.trial_note">Despliegue en 10 minutos, sin contratos.</span>
            </div>
        </div>
    </div>
</section>

<section class="duration-section" id="planes">
    <div class="container">
        <p class="section-subtitle" data-i18n="dedi.section_subtitle">BARE METAL</p>
        <h2 class="section-title" data-i18n="dedi.section_title">Servidores Dedicados Disponibles</h2>
        <p class="section-desc" style="margin-bottom:36px;" data-i18n="dedi.section_desc">Hardware real, sin compartir recursos con nadie. Bandwidth 1Gbps sin límite incluido en todos los planes.</p>
    </div>
</section>

<section class="plans-section">
    <div class="dedi-wide-container">
        <div class="dedi-results-bar">
            <span data-i18n="dedi.results_count">Mostrando 4 de 4 servidores</span>
        </div>

        <div class="dedi-list">

            <!-- AMD Ryzen 5900X -->
            <div class="dedi-row">
                <div class="dedi-cpu-block">
                    <span class="dedi-cpu-brand"><i class="fa-solid fa-microchip"></i> AMD</span>
                    <span class="dedi-cpu-name">RYZEN 5900X</span>
                    <span class="dedi-rapid-badge"><i class="fa-solid fa-bolt"></i> <span data-i18n="dedi.rapid_deploy">Despliegue Rápido</span></span>
                </div>
                <div class="dedi-specs">
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-microchip"></i></span> <span data-i18n="dedi.spec_cores">Núcleos</span></span>
                        <span class="dedi-spec-value">12 x 3.70 GHz</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-memory"></i></span> <span data-i18n="dedi.spec_ram">RAM</span></span>
                        <span class="dedi-spec-value">128 GB DDR4</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-hard-drive"></i></span> <span data-i18n="dedi.spec_storage">Almacenamiento</span></span>
                        <span class="dedi-spec-value">2 TB NVMe</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-clock"></i></span> <span data-i18n="dedi.spec_setup">Activación</span></span>
                        <span class="dedi-spec-value">10 <span data-i18n="dedi.minutes">Minutos</span></span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-bolt"></i></span> <span data-i18n="dedi.spec_bandwidth">Bandwidth</span></span>
                        <span class="dedi-spec-value">1Gbps <span data-i18n="dedi.unlimited">Sin Límite</span></span>
                    </div>
                </div>
                <div class="dedi-price-block">
                    <div class="dedi-price-row">
                        <span class="dedi-price" data-usd="159.00">$159.00</span>
                        <span class="dedi-price-period" data-i18n="dedi.per_month">por mes</span>
                    </div>
                    <a href="https://billing.moonly.es" target="_blank" class="dedi-order-btn">
                        <i class="fa-solid fa-rocket"></i> <span data-i18n="dedi.order_now">Pedir Ahora</span>
                    </a>
                </div>
            </div>

            <!-- AMD Ryzen 5950X -->
            <div class="dedi-row">
                <div class="dedi-cpu-block">
                    <span class="dedi-cpu-brand"><i class="fa-solid fa-microchip"></i> AMD</span>
                    <span class="dedi-cpu-name">RYZEN 5950X</span>
                    <span class="dedi-rapid-badge"><i class="fa-solid fa-bolt"></i> <span data-i18n="dedi.rapid_deploy">Despliegue Rápido</span></span>
                </div>
                <div class="dedi-specs">
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-microchip"></i></span> <span data-i18n="dedi.spec_cores">Núcleos</span></span>
                        <span class="dedi-spec-value">16 x 3.40 GHz</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-memory"></i></span> <span data-i18n="dedi.spec_ram">RAM</span></span>
                        <span class="dedi-spec-value">128 GB DDR4</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-hard-drive"></i></span> <span data-i18n="dedi.spec_storage">Almacenamiento</span></span>
                        <span class="dedi-spec-value">2 TB NVMe</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-clock"></i></span> <span data-i18n="dedi.spec_setup">Activación</span></span>
                        <span class="dedi-spec-value">10 <span data-i18n="dedi.minutes">Minutos</span></span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-bolt"></i></span> <span data-i18n="dedi.spec_bandwidth">Bandwidth</span></span>
                        <span class="dedi-spec-value">1Gbps <span data-i18n="dedi.unlimited">Sin Límite</span></span>
                    </div>
                </div>
                <div class="dedi-price-block">
                    <div class="dedi-price-row">
                        <span class="dedi-price" data-usd="179.00">$179.00</span>
                        <span class="dedi-price-period" data-i18n="dedi.per_month">por mes</span>
                    </div>
                    <a href="https://billing.moonly.es" target="_blank" class="dedi-order-btn">
                        <i class="fa-solid fa-rocket"></i> <span data-i18n="dedi.order_now">Pedir Ahora</span>
                    </a>
                </div>
            </div>

            <!-- AMD Ryzen 7900 -->
            <div class="dedi-row">
                <div class="dedi-cpu-block">
                    <span class="dedi-cpu-brand"><i class="fa-solid fa-microchip"></i> AMD</span>
                    <span class="dedi-cpu-name">RYZEN 7900</span>
                    <span class="dedi-rapid-badge"><i class="fa-solid fa-bolt"></i> <span data-i18n="dedi.rapid_deploy">Despliegue Rápido</span></span>
                </div>
                <div class="dedi-specs">
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-microchip"></i></span> <span data-i18n="dedi.spec_cores">Núcleos</span></span>
                        <span class="dedi-spec-value">12 x 3.70 GHz</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-memory"></i></span> <span data-i18n="dedi.spec_ram">RAM</span></span>
                        <span class="dedi-spec-value">128 GB DDR5</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-hard-drive"></i></span> <span data-i18n="dedi.spec_storage">Almacenamiento</span></span>
                        <span class="dedi-spec-value">2x 2 TB NVMe</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-clock"></i></span> <span data-i18n="dedi.spec_setup">Activación</span></span>
                        <span class="dedi-spec-value">10 <span data-i18n="dedi.minutes">Minutos</span></span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-bolt"></i></span> <span data-i18n="dedi.spec_bandwidth">Bandwidth</span></span>
                        <span class="dedi-spec-value">1Gbps <span data-i18n="dedi.unlimited">Sin Límite</span></span>
                    </div>
                </div>
                <div class="dedi-price-block">
                    <div class="dedi-price-row">
                        <span class="dedi-price" data-usd="209.00">$209.00</span>
                        <span class="dedi-price-period" data-i18n="dedi.per_month">por mes</span>
                    </div>
                    <a href="https://billing.moonly.es" target="_blank" class="dedi-order-btn">
                        <i class="fa-solid fa-rocket"></i> <span data-i18n="dedi.order_now">Pedir Ahora</span>
                    </a>
                </div>
            </div>

            <!-- AMD Ryzen 9900X - Destacado -->
            <div class="dedi-row featured">
                <div class="dedi-cpu-block">
                    <span class="dedi-cpu-brand"><i class="fa-solid fa-microchip"></i> AMD</span>
                    <span class="dedi-cpu-name">RYZEN 9900X</span>
                    <span class="dedi-rapid-badge"><i class="fa-solid fa-bolt"></i> <span data-i18n="dedi.rapid_deploy">Despliegue Rápido</span></span>
                </div>
                <div class="dedi-specs">
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-microchip"></i></span> <span data-i18n="dedi.spec_cores">Núcleos</span></span>
                        <span class="dedi-spec-value">12 x 4.40 GHz</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-memory"></i></span> <span data-i18n="dedi.spec_ram">RAM</span></span>
                        <span class="dedi-spec-value">192 GB DDR5</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-hard-drive"></i></span> <span data-i18n="dedi.spec_storage">Almacenamiento</span></span>
                        <span class="dedi-spec-value">2x 4 TB NVMe</span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-clock"></i></span> <span data-i18n="dedi.spec_setup">Activación</span></span>
                        <span class="dedi-spec-value">10 <span data-i18n="dedi.minutes">Minutos</span></span>
                    </div>
                    <div class="dedi-spec">
                        <span class="dedi-spec-label"><span class="dedi-spec-icon"><i class="fa-solid fa-bolt"></i></span> <span data-i18n="dedi.spec_bandwidth">Bandwidth</span></span>
                        <span class="dedi-spec-value">1Gbps <span data-i18n="dedi.unlimited">Sin Límite</span></span>
                    </div>
                </div>
                <div class="dedi-price-block">
                    <div class="dedi-price-row">
                        <span class="dedi-price" data-usd="299.00">$299.00</span>
                        <span class="dedi-price-period" data-i18n="dedi.per_month">por mes</span>
                    </div>
                    <a href="https://billing.moonly.es" target="_blank" class="dedi-order-btn">
                        <i class="fa-solid fa-rocket"></i> <span data-i18n="dedi.order_now">Pedir Ahora</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
// Llamamos al pie de página
include '../includes/footer.php';
?>
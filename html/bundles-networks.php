<?php
// Definimos las variables para esta página específica en la subcarpeta
$base_path = '../';
$page_title = 'Network Packs — Moonly Hosting';
$extra_css = 'css/planes.css'; // Reutilizamos el hero/breadcrumb/botones
$body_class = 'bundles-body';
$extra_js = 'js/bundles-networks.js';

include '../includes/header.php';
?>
<link rel="stylesheet" href="<?php echo $base_path; ?>css/bundles-networks.css?v=10">

<nav class="breadcrumb-bar">
    <div class="container">
        <a href="../index.php" data-i18n="plans.breadcrumb_home">Inicio</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current" data-i18n="np.breadcrumb_current">Network Packs</span>
    </div>
</nav>

<section class="plan-hero">
    <div class="container">
        <div class="plan-hero-media">
            <div class="plan-hero-cover" style="border-color: rgba(192,132,252,.3); box-shadow: 0 24px 48px rgba(160,80,255,.15);">
                <img src="../images/bundles/networks.png" alt="Network Packs" onerror="this.style.opacity='.15';">
            </div>
            <a href="#packs" class="plan-hero-link" style="color: #c084fc;">
                <i class="fa-solid fa-arrow-down"></i> <span data-i18n="plans.view_website">Ver características</span>
            </a>
        </div>

        <div class="plan-hero-content">
            <h1 class="plan-hero-title" data-i18n="np.hero_title">Network Packs: Configuraciones Listas para Jugar</h1>

            <div class="plan-hero-badges">
                <span class="plan-badge"><i class="fa-solid fa-puzzle-piece" style="color: #c084fc;"></i> <span data-i18n="np.badge_plugins">Plugins propios Moonly</span></span>
                <span class="plan-badge"><i class="fa-solid fa-unlock" style="color: var(--yellow);"></i> <span data-i18n="np.badge_noip">Sin restricción de IP</span></span>
            </div>

            <p class="plan-hero-desc" data-i18n="np.hero_desc">Configuraciones completas de servidor, entregadas con el nombre que tú elijas. Incluyen plugins propios de Moonly y plugins de terceros (gratis o de pago) que normalmente exigen licencia atada a una IP — al correr en nuestro host, esa restricción no existe: te los entregamos sin costo extra.</p>

            <div class="plan-hero-buttons">
                <a href="#packs" class="btn-cta" style="background: linear-gradient(135deg, rgba(192,132,252,.25) 0%, rgba(160,80,255,.7) 100%); border-color: #c084fc; box-shadow: 0 0 22px rgba(160,80,255,.35);"><i class="fa-solid fa-layer-group"></i> <span data-i18n="np.btn_explore">Ver Packs</span></a>
                <a href="https://discord.gg/moonly" target="_blank" class="btn-secondary"><i class="fa-brands fa-discord"></i> <span data-i18n="plans.btn_trial">Habla con Soporte</span></a>
                <span class="trial-note" data-i18n="np.trial_note">Pago único por la configuración, sin suscripción.</span>
            </div>
        </div>
    </div>
</section>

<section class="duration-section" id="packs">
    <div class="container">
        <p class="section-subtitle" data-i18n="np.section_subtitle">CONFIGURACIONES MOONLY</p>
        <h2 class="section-title" data-i18n="np.section_title">Elige tu Network Pack</h2>
        <p class="section-desc" style="margin-bottom:36px;" data-i18n="np.section_desc">Cada pack se vende solo (la instalas en tu propio servidor) o junto con hosting Moonly incluido.</p>
    </div>
</section>

<section class="plans-section">
    <div class="container">
        <div class="np-grid">

            <!-- ══════════ LOBBY ══════════ -->
            <div class="np-card lobby" data-pack="lobby">
                <div class="np-card-cover">
                    <img class="np-card-cover-img" src="../images/bundles/networks-lobby.png" alt="Lobby" onerror="this.style.display='none';">
                    <span class="np-card-chevron"><i class="fa-solid fa-chevron-down"></i></span>
                    <div class="np-card-cover-content">
                        <span class="np-card-title" data-i18n="np.lobby_title">Lobby</span>
                        <span class="np-card-price-tag">$10.00</span>
                    </div>
                </div>

                <div class="np-panel">
                    <div class="np-panel-inner">
                        <p class="np-desc" data-i18n="np.lobby_desc">El hub de bienvenida para tu red: portales animados, NPCs, menús de selección de servidor y la primera impresión que define si un jugador se queda o se va.</p>

                        <p class="np-section-label" data-i18n="np.features_label">Qué incluye</p>
                        <div class="np-features">
                            <div class="np-feature"><i class="fa-solid fa-check"></i> <span data-i18n="np.lobby_feat_1">Configuración completa lista para usar, con el nombre de tu servidor</span></div>
                            <div class="np-feature"><i class="fa-solid fa-check"></i> <span data-i18n="np.lobby_feat_2">Plugins propios de Moonly (menús, portales, NPCs)</span></div>
                            <div class="np-feature"><i class="fa-solid fa-check"></i> <span data-i18n="np.lobby_feat_3">Plugins premium de terceros incluidos sin costo de licencia</span></div>
                            <div class="np-feature"><i class="fa-solid fa-check"></i> <span data-i18n="np.lobby_feat_4">Sin restricción de IP: corre directo en tu servidor</span></div>
                        </div>

                        <div class="np-mode-switch">
                            <div class="np-mode-option active" data-mode="config" data-i18n="np.mode_config">Solo Configuración</div>
                            <div class="np-mode-option" data-mode="host" data-i18n="np.mode_host">Configuración + Host</div>
                        </div>

                        <div class="np-ram-select">
                            <div class="np-ram-option active" data-gb="2">
                                <span class="np-ram-option-gb">2 GB</span>
                                <span class="np-ram-option-price">$3.40/mes</span>
                            </div>
                            <div class="np-ram-option" data-gb="4">
                                <span class="np-ram-option-gb">4 GB</span>
                                <span class="np-ram-option-price">$6.80/mes</span>
                            </div>
                        </div>

                        <div class="np-price-row">
                            <div class="np-price-block">
                                <span class="np-price-total">$10.00</span>
                                <span class="np-price-sub" data-i18n="np.one_time_payment">Pago único</span>
                            </div>
                            <a href="https://billing.moonly.es" target="_blank" class="np-order-btn">
                                <i class="fa-solid fa-rocket"></i> <span data-i18n="np.order_now">Pedir Ahora</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ══════════ SURVIVAL ══════════ -->
            <div class="np-card survival" data-pack="survival">
                <div class="np-card-cover">
                    <img class="np-card-cover-img" src="../images/bundles/networks-survival.png" alt="Survival" onerror="this.style.display='none';">
                    <span class="np-card-chevron"><i class="fa-solid fa-chevron-down"></i></span>
                    <div class="np-card-cover-content">
                        <span class="np-card-title" data-i18n="np.survival_title">Survival</span>
                        <span class="np-card-price-tag">$30.00</span>
                    </div>
                </div>

                <div class="np-panel">
                    <div class="np-panel-inner">
                        <p class="np-desc" data-i18n="np.survival_desc">Un mundo Survival completo: economía, protección de terrenos, tienda, y todo lo que tu comunidad necesita para construir sin caos desde el primer día.</p>

                        <p class="np-section-label" data-i18n="np.features_label">Qué incluye</p>
                        <div class="np-features">
                            <div class="np-feature"><i class="fa-solid fa-check"></i> <span data-i18n="np.survival_feat_1">Configuración completa lista para usar, con el nombre de tu servidor</span></div>
                            <div class="np-feature"><i class="fa-solid fa-check"></i> <span data-i18n="np.survival_feat_2">Plugins propios de Moonly (economía, tienda, protección de terrenos)</span></div>
                            <div class="np-feature"><i class="fa-solid fa-check"></i> <span data-i18n="np.survival_feat_3">Plugins premium de terceros incluidos sin costo de licencia</span></div>
                            <div class="np-feature"><i class="fa-solid fa-check"></i> <span data-i18n="np.survival_feat_4">Sin restricción de IP: corre directo en tu servidor</span></div>
                        </div>

                        <div class="np-mode-switch">
                            <div class="np-mode-option active" data-mode="config" data-i18n="np.mode_config">Solo Configuración</div>
                            <div class="np-mode-option" data-mode="host" data-i18n="np.mode_host">Configuración + Host</div>
                        </div>

                        <div class="np-ram-select">
                            <div class="np-ram-option active" data-gb="2">
                                <span class="np-ram-option-gb">2 GB</span>
                                <span class="np-ram-option-price">$3.40/mes</span>
                            </div>
                            <div class="np-ram-option" data-gb="4">
                                <span class="np-ram-option-gb">4 GB</span>
                                <span class="np-ram-option-price">$6.80/mes</span>
                            </div>
                        </div>

                        <div class="np-price-row">
                            <div class="np-price-block">
                                <span class="np-price-total">$30.00</span>
                                <span class="np-price-sub" data-i18n="np.one_time_payment">Pago único</span>
                            </div>
                            <a href="https://billing.moonly.es" target="_blank" class="np-order-btn">
                                <i class="fa-solid fa-rocket"></i> <span data-i18n="np.order_now">Pedir Ahora</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
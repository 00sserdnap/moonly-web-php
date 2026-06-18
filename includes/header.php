<?php
// Previene errores si olvidamos definir las variables en alguna página
if (!isset($base_path))   $base_path   = '';
if (!isset($page_title))  $page_title  = 'Moonly Hosting';
if (!isset($extra_css))   $extra_css   = '';
if (!isset($body_class))  $body_class  = '';
if (!isset($is_home))     $is_home     = false;   // ← nueva bandera: solo index.php la pone en true
?>
<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#080b12">
    <title><?php echo htmlspecialchars($page_title); ?></title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS base (siempre) -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/theme.css?v=11">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/global.css?v=11">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/breadcrumb.css?v=11">

    <!-- index.css SOLO en el home -->
    <?php if ($is_home): ?>
        <link rel="stylesheet" href="<?php echo $base_path; ?>css/index.css?v=11">
    <?php endif; ?>

    <!-- CSS específico de la página (planes.css, faq.css, etc.) -->
    <?php if ($extra_css): ?>
        <link rel="stylesheet" href="<?php echo $base_path; ?><?php echo $extra_css; ?>?v=11">
    <?php endif; ?>

    <!-- Aplicar tema guardado ANTES del primer paint (evita flash) -->
    <script>
        (function () {
            try {
                var t = localStorage.getItem('moonly_theme');
                if (!t) {
                    t = (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches)
                        ? 'light' : 'dark';
                }
                document.documentElement.setAttribute('data-theme', t);

                var l = localStorage.getItem('moonly_lang');
                if (!l) {
                    var nav = (navigator.language || 'es').toLowerCase();
                    l = (nav.indexOf('en') === 0) ? 'en' : 'es';  /* ← bug corregido: paréntesis extra eliminado */
                }
                document.documentElement.setAttribute('lang', l);
            } catch (e) {}
        })();
    </script>
</head>
<body class="<?php echo htmlspecialchars($body_class); ?>">

<div class="page-transition"></div>

<header class="navbar">
    <div class="nav-container">
        <a href="<?php echo $base_path; ?>index.php" class="logo">
            <i class="fa-solid fa-moon" style="color:var(--cyan);font-size:1.7rem;"></i>
            <div class="logo-text">
                <span class="moonly">MOONLY</span>
                <span class="hosting">HOSTING</span>
            </div>
        </a>

        <!-- Botón menú móvil -->
        <button class="mobile-menu-btn" aria-label="Abrir menú">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="nav-right">
            <!-- Fila superior: quick links + controles -->
            <div class="nav-top-row">
                <a href="<?php echo $base_path; ?>html/about.php" class="quick-link">
                    <i class="fa-solid fa-circle-info"></i>
                    <span data-i18n="nav.about">About</span>
                </a>
                <a href="<?php echo $base_path; ?>html/faq.php" class="quick-link">
                    <i class="fa-solid fa-circle-question"></i>
                    <span data-i18n="nav.faq">Preguntas frecuentes</span>
                </a>
                <a href="https://control.moonly.es" class="quick-link" target="_blank" rel="noopener">
                    <i class="fa-solid fa-terminal"></i>
                    <span data-i18n="nav.panel">Game Panel</span>
                </a>
                <a href="https://billing.moonly.es" class="quick-link" target="_blank" rel="noopener">
                    <i class="fa-solid fa-credit-card"></i>
                    <span data-i18n="nav.client">Client Area</span>
                </a>
                <a href="<?php echo $base_path; ?>html/terminos.php" class="quick-link">
                    <i class="fa-solid fa-file-contract"></i>
                    <span data-i18n="nav.terms">Términos de servicio</span>
                </a>

                <div class="utility-controls">
                    <!-- Toggle tema -->
                    <button type="button" class="theme-toggle"
                            aria-label="Cambiar tema"
                            data-i18n-attr="aria-label:theme.toggle_label"
                            aria-pressed="false">
                        <i class="fa-solid fa-moon"></i>
                        <i class="fa-solid fa-sun"></i>
                    </button>

                    <!-- Selector idioma -->
                    <div class="lang-selector">
                        <button type="button" class="lang-toggle"
                                aria-label="Idioma"
                                data-i18n-attr="aria-label:lang.label"
                                aria-haspopup="listbox">
                            <span class="flag current-flag">🇪🇸</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="lang-menu" role="listbox"></div>
                    </div>

                    <!-- Selector moneda -->
                    <div class="currency-selector-ctrl">
                        <button type="button" class="currency-toggle"
                                aria-label="Moneda"
                                data-i18n-attr="aria-label:currency.label"
                                aria-haspopup="listbox">
                            <span class="current-currency">USD</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="currency-menu" role="listbox"></div>
                    </div>
                </div>
            </div>

            <!-- Fila inferior: navegación principal -->
            <div class="nav-bottom-row">
                <ul class="nav-links">

                    <!-- Minecraft (mega menú) -->
                    <li class="dropdown-container has-mega">
                        <a href="#" class="dropdown-toggle">
                            <span data-i18n="nav.minecraft">Minecraft</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <div class="mega-menu">
                            <a href="<?php echo $base_path; ?>html/planes.php" class="mega-card java">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.java.title">Edición Java</span>
                                    <small data-i18n="mega.java.sub">Última versión · Plugins</small>
                                </span>
                            </a>
                            <a href="<?php echo $base_path; ?>html/planes.php" class="mega-card bedrock">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.bedrock.title">Edición Bedrock</span>
                                    <small data-i18n="mega.bedrock.sub">PC · Consola · Móvil</small>
                                </span>
                            </a>
                            <a href="<?php echo $base_path; ?>html/planes.php" class="mega-card modded">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.modded.title">Alojamiento Modded</span>
                                    <small data-i18n="mega.modded.sub">Forge · Fabric · ModPacks</small>
                                </span>
                            </a>
                            <a href="<?php echo $base_path; ?>html/planes.php" class="mega-card budget">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.budget.title">Alojamiento Económico</span>
                                    <small data-i18n="mega.budget.sub">Desde $2.99/mes</small>
                                </span>
                            </a>
                        </div>
                    </li>

                    <!-- Bundles (mega menú) -->
                    <li class="dropdown-container has-mega">
                        <a href="#" class="dropdown-toggle">
                            <span data-i18n="nav.bundles">Bundles</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <div class="mega-menu">
                            <a href="<?php echo $base_path; ?>html/bundles-networks.php" class="mega-card bundle-networks">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.bundle_networks.title">Network Packs</span>
                                    <small data-i18n="mega.bundle_networks.sub">Hub · Survival · SkyBlock</small>
                                </span>
                            </a>
                            <a href="<?php echo $base_path; ?>html/bundles-plugins.php" class="mega-card bundle-plugins">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.bundle_plugins.title">Plugins Moonly</span>
                                    <small data-i18n="mega.bundle_plugins.sub">Desarrollo propio</small>
                                </span>
                            </a>
                            <a href="<?php echo $base_path; ?>html/bundles-configs.php" class="mega-card bundle-configs">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.bundle_configs.title">Configs Optimizadas</span>
                                    <small data-i18n="mega.bundle_configs.sub">server.properties · Paper · Spigot</small>
                                </span>
                            </a>
                        </div>
                    </li>

                    <!-- Cloud Dedicated (link directo) -->
                    <li class="dropdown-container">
                        <a href="<?php echo $base_path; ?>html/dedicados.php" class="dropdown-toggle"
                           data-i18n="nav.dedicated">Cloud Dedicated</a>
                    </li>

                    <!-- Otros Hosting (mega menú) -->
                    <li class="dropdown-container has-mega">
                        <a href="#" class="dropdown-toggle">
                            <span data-i18n="nav.other_hosting">Otros Hosting</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <div class="mega-menu">
                            <a href="<?php echo $base_path; ?>html/discordbot.php" class="mega-card discordbot">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.discordbot.title">Discord Bot</span>
                                    <small data-i18n="mega.discordbot.sub">Node.js · Python · Java</small>
                                </span>
                            </a>
                            <a href="<?php echo $base_path; ?>html/vps.php" class="mega-card vps">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.vps.title">Budget VPS</span>
                                    <small data-i18n="mega.vps.sub">Desde precios económicos</small>
                                </span>
                            </a>
                            <a href="<?php echo $base_path; ?>html/python.php" class="mega-card python">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.python.title">Python</span>
                                    <small data-i18n="mega.python.sub">Apps · Bots · Scripts</small>
                                </span>
                            </a>
                            <a href="<?php echo $base_path; ?>html/nodejs.php" class="mega-card nodejs">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.nodejs.title">Node.js</span>
                                    <small data-i18n="mega.nodejs.sub">APIs · Apps en tiempo real</small>
                                </span>
                            </a>
                        </div>
                    </li>

                    <!-- Soporte (mega menú 3 columnas) -->
                    <li class="dropdown-container has-mega">
                        <a href="#" class="dropdown-toggle">
                            <span data-i18n="nav.support">Soporte</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <div class="mega-menu">
                            <div class="support-mega-wrapper">
                                <div class="support-col">
                                    <h4 class="support-col-title" data-i18n="nav.support_assistance">Asistencia</h4>
                                    <div class="support-col-buttons">
                                        <a href="https://discord.gg/moonly" target="_blank" rel="noopener" class="support-btn">
                                            <i class="fa-brands fa-discord"></i>
                                            <span data-i18n="nav.discord">Discord</span>
                                        </a>
                                        <a href="https://wa.me/56900000000" target="_blank" rel="noopener" class="support-btn">
                                            <i class="fa-brands fa-whatsapp"></i>
                                            <span data-i18n="nav.whatsapp">WhatsApp</span>
                                        </a>
                                        <a href="mailto:soporte@moonlyhosting.com" class="support-btn">
                                            <i class="fa-solid fa-envelope"></i>
                                            <span data-i18n="nav.email">Email</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="support-col">
                                    <h4 class="support-col-title" data-i18n="nav.support_information">Información</h4>
                                    <div class="support-col-buttons">
                                        <a href="<?php echo $base_path; ?>html/faq.php" class="support-btn">
                                            <i class="fa-solid fa-circle-question"></i>
                                            <span data-i18n="nav.faq">Preguntas frecuentes</span>
                                        </a>
                                        <a href="<?php echo $base_path; ?>html/terminos.php" class="support-btn">
                                            <i class="fa-solid fa-file-contract"></i>
                                            <span data-i18n="nav.terms">Términos de servicio</span>
                                        </a>
                                        <a href="#" class="support-btn">
                                            <i class="fa-solid fa-signal"></i>
                                            <span data-i18n="nav.status">Estado del Sistema</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="support-col">
                                    <h4 class="support-col-title" data-i18n="nav.support_resources">Recursos</h4>
                                    <div class="support-col-buttons">
                                        <a href="https://billing.moonly.es" target="_blank" rel="noopener" class="support-btn">
                                            <i class="fa-solid fa-credit-card"></i>
                                            <span data-i18n="nav.client">Client Area</span>
                                        </a>
                                        <a href="#" class="support-btn">
                                            <i class="fa-solid fa-book"></i>
                                            <span data-i18n="nav.knowledgebase">Base de Conocimientos</span>
                                        </a>
                                        <a href="#" class="support-btn">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            <span data-i18n="nav.report_abuse">Reportar Abuso</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Calcula --navbar-h inmediatamente después de renderizar el navbar,
     antes de que cualquier sección lo necesite para su padding-top.
     Esto evita el salto visual mientras main.js no ha cargado. -->
<script>
    (function () {
        var nav = document.querySelector('.navbar');
        if (nav) {
            document.documentElement.style.setProperty('--navbar-h', nav.offsetHeight + 'px');
        }
    })();
</script>
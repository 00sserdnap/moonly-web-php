<?php
// Previene errores si olvidamos definir las variables en alguna página
if (!isset($base_path))   $base_path   = '';
if (!isset($page_title))  $page_title  = 'Moonly Hosting';
if (!isset($extra_css))   $extra_css   = '';
if (!isset($body_class))  $body_class  = '';
if (!isset($is_home))     $is_home     = false;

// Configuración centralizada (URLs, emails, versión de assets)
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/auth-check.php';
$loggedUser = currentUser();
?>
<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#080b12">
    <title><?php echo htmlspecialchars($page_title); ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?php echo $base_path; ?>css/theme.css?v=<?php echo ASSET_VERSION; ?>">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/global.css?v=<?php echo ASSET_VERSION; ?>">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/breadcrumb.css?v=<?php echo ASSET_VERSION; ?>">

    <?php if ($is_home): ?>
        <link rel="stylesheet" href="<?php echo $base_path; ?>css/index.css?v=<?php echo ASSET_VERSION; ?>">
    <?php endif; ?>

    <?php if ($extra_css): ?>
        <link rel="stylesheet" href="<?php echo $base_path; ?><?php echo $extra_css; ?>?v=<?php echo ASSET_VERSION; ?>">
    <?php endif; ?>

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
                    l = (nav.indexOf('en') === 0) ? 'en' : 'es';
                }
                document.documentElement.setAttribute('lang', l);
            } catch (e) {}
        })();
    </script>

    <script type="text/javascript">
        window.$crisp=[];
        window.CRISP_WEBSITE_ID="16b304fe-c5b8-4659-b37f-3adafeeaa0f7";
        (function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();

        $crisp.push(["do", "chat:hide"]);

        $crisp.push(["on", "chat:opened", function() {
            var btn = document.getElementById("moonly-chat-btn");
            if(btn) btn.style.display = "none";
        }]);

        $crisp.push(["on", "chat:closed", function() {
            $crisp.push(["do", "chat:hide"]);
            var btn = document.getElementById("moonly-chat-btn");
            if(btn) btn.style.display = "flex";
        }]);
    </script>

    <style>
        .header-chat-btn {
            background: rgba(0, 229, 255, 0.1);
            color: var(--cyan);
            border: 1px solid var(--cyan);
            border-radius: 6px;
            padding: 5px 12px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: 8px;
            transition: all 0.3s ease;
            height: 32px;
        }
        .header-chat-btn:hover {
            background: var(--cyan);
            color: #080b12;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 229, 255, 0.3);
        }
        @media (max-width: 768px) {
            .header-chat-btn span { display: none; }
            .header-chat-btn { padding: 5px 8px; }
        }

        .header-login-btn {
            background: var(--cyan);
            color: #04101a;
            border: 1px solid var(--cyan);
            border-radius: 6px;
            padding: 5px 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: 8px;
            transition: all 0.3s ease;
            height: 32px;
            text-decoration: none;
        }
        .header-login-btn:hover {
            filter: brightness(1.08);
            box-shadow: 0 0 14px var(--cyan-glow);
        }
        @media (max-width: 768px) {
            .header-login-btn span { display: none; }
            .header-login-btn { padding: 5px 8px; }
        }
    </style>

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

        <button class="mobile-menu-btn" aria-label="Abrir menú">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="nav-right">
            <div class="nav-top-row">
                <a href="<?php echo $base_path; ?>html/about.php" class="quick-link">
                    <i class="fa-solid fa-circle-info"></i>
                    <span data-i18n="nav.about">About</span>
                </a>
                <a href="<?php echo $base_path; ?>html/faq.php" class="quick-link">
                    <i class="fa-solid fa-circle-question"></i>
                    <span data-i18n="nav.faq">Preguntas frecuentes</span>
                </a>
                <a href="<?php echo PANEL_URL; ?>" class="quick-link" target="_blank" rel="noopener">
                    <i class="fa-solid fa-terminal"></i>
                    <span data-i18n="nav.panel">Game Panel</span>
                </a>
                <a href="<?php echo BILLING_URL; ?>" class="quick-link" target="_blank" rel="noopener">
                    <i class="fa-solid fa-credit-card"></i>
                    <span data-i18n="nav.client">Client Area</span>
                </a>
                <a href="<?php echo $base_path; ?>html/terminos.php" class="quick-link">
                    <i class="fa-solid fa-file-contract"></i>
                    <span data-i18n="nav.terms">Términos de servicio</span>
                </a>

                <div class="utility-controls">
                    <button type="button" class="theme-toggle"
                            aria-label="Cambiar tema"
                            data-i18n-attr="aria-label:theme.toggle_label"
                            aria-pressed="false">
                        <i class="fa-solid fa-moon"></i>
                        <i class="fa-solid fa-sun"></i>
                    </button>

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

                    <?php if ($loggedUser): ?>
                        <div class="user-menu-selector">
                            <button type="button" class="user-menu-toggle" aria-haspopup="listbox">
                                <i class="fa-solid fa-circle-user" style="color: var(--cyan);"></i>
                                <span style="font-size:.8rem; font-weight:600; max-width:90px; overflow:hidden; text-overflow:ellipsis;"><?php echo htmlspecialchars($loggedUser['username']); ?></span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <div class="lang-menu user-menu">
                                <a href="<?php echo $base_path; ?>html/foro/index.php" class="lang-option">
                                    <i class="fa-solid fa-comments" style="color:var(--cyan); width:16px;"></i>
                                    <span>Foro</span>
                                </a>
                                <?php if (in_array($loggedUser['role'], ['moderator', 'admin'])): ?>
                                <a href="<?php echo $base_path; ?>admin/index.php" class="lang-option">
                                    <i class="fa-solid fa-gauge" style="color:var(--cyan); width:16px;"></i>
                                    <span>Panel Admin</span>
                                </a>
                                <?php endif; ?>
                                <a href="<?php echo $base_path; ?>auth/logout.php" class="lang-option">
                                    <i class="fa-solid fa-right-from-bracket" style="color:var(--cyan); width:16px;"></i>
                                    <span>Cerrar sesión</span>
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo $base_path; ?>auth/login.php" class="header-login-btn">
                            <i class="fa-solid fa-user"></i>
                            <span>Iniciar sesión</span>
                        </a>
                    <?php endif; ?>

                    <button type="button" class="header-chat-btn" onclick="$crisp.push(['do', 'chat:show']); $crisp.push(['do', 'chat:open']);" aria-label="Soporte en vivo">
                        <i class="fa-solid fa-headset"></i>
                        <span>Soporte</span>
                    </button>
                </div>
            </div>

            <div class="nav-bottom-row">
                <ul class="nav-links">

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

                    <li class="dropdown-container">
                        <a href="<?php echo $base_path; ?>html/dedicados.php" class="dropdown-toggle"
                           data-i18n="nav.dedicated">Cloud Dedicated</a>
                    </li>

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
                            <a href="<?php echo $base_path; ?>html/teamspeak.php" class="mega-card teamspeak">
                                <span class="mega-card-label">
                                    <span data-i18n="mega.teamspeak.title">TeamSpeak</span>
                                    <small data-i18n="mega.teamspeak.sub">Voz estable y de baja latencia</small>
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
                                        <a href="<?php echo DISCORD_URL; ?>" target="_blank" rel="noopener" class="support-btn">
                                            <i class="fa-brands fa-discord"></i>
                                            <span data-i18n="nav.discord">Discord</span>
                                        </a>
                                        <a href="<?php echo WHATSAPP_URL; ?>" target="_blank" rel="noopener" class="support-btn">
                                            <i class="fa-brands fa-whatsapp"></i>
                                            <span data-i18n="nav.whatsapp">WhatsApp</span>
                                        </a>
                                        <a href="mailto:<?php echo EMAIL_SUPPORT; ?>" class="support-btn">
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
                                        <a href="<?php echo BILLING_URL; ?>" target="_blank" rel="noopener" class="support-btn">
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

<script>
    (function () {
        var nav = document.querySelector('.navbar');
        if (nav) {
            document.documentElement.style.setProperty('--navbar-h', nav.offsetHeight + 'px');
        }
    })();
</script>
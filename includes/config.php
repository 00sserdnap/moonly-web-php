<?php
/* =============================================
   MOONLY HOSTING — CONFIG.PHP
   Fuente única de verdad para URLs, emails,
   versiones de assets y constantes globales.

   CÓMO USAR:
   Incluir al inicio de header.php (ya está hecho).
   En cualquier PHP: BILLING_URL, DISCORD_URL, etc.
   En vistas: <?php echo BILLING_URL; ?>
   ============================================= */

/* ── URLs externas ───────────────────────────── */
define('BILLING_URL',   'https://billing.moonly.es');
define('PANEL_URL',     'https://control.moonly.es');
define('DISCORD_URL',   'https://discord.gg/moonly');
define('WHATSAPP_URL',  'https://wa.me/56995500283');

/* ── Emails ──────────────────────────────────── */
define('EMAIL_SUPPORT',  'soporte@moonly.es');
define('EMAIL_PARTNERS', 'partners@moonly.es');

/* ── Versión de assets (CSS/JS) ──────────────── */
/* Cambia este número cada vez que hagas un deploy
   para forzar que el navegador descarte el caché. */
define('ASSET_VERSION', '11');

/* ── Configuración del sitio ─────────────────── */
define('SITE_NAME',  'Moonly Hosting');
define('SITE_TAGLINE', 'Minecraft & Cloud Premium');
define('SITE_DOMAIN', 'moonly.es');
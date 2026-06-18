<?php
$base_path = '';
$page_title = 'Moonly Hosting — Minecraft & Cloud Premium';
// Llamamos al encabezado
include 'includes/header.php';
?>

<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">
            <span data-i18n="hero.title.pre">Ilumina el futuro de tu</span> <span class="highlight" data-i18n="hero.title.highlight">Mundo</span> <span data-i18n="hero.title.post">con Hosting Moonly</span>
        </h1>
        <p class="hero-subtitle" data-i18n="hero.subtitle">
            Hosting Minecraft premium y soluciones Cloud de alto rendimiento. Activación inmediata, soporte real y precios que no te rompen el bolsillo.
        </p>

        <div class="service-carousel" id="service-carousel">
            <div class="service-card active" data-target="html/planes.php">
                <img src="images/services/minecraft.png" alt="Minecraft Hosting"
                    data-fallbacks="images/services/minecraft.jpg,images/services/minecraft.webp,images/services/minecraft.jpeg"
                    onerror="window.tryNextImg(this)">
                <div class="service-card-overlay">
                    <span class="service-card-title" data-i18n="service.minecraft.title">Minecraft</span>
                    <span class="service-card-sub" data-i18n="service.minecraft.sub">Hosting</span>
                </div>
            </div>
            <div class="service-card" data-target="html/dedicados.php">
                <img src="images/services/dedicated.png" alt="Cloud Dedicated"
                    data-fallbacks="images/services/dedicated.jpg,images/services/dedicated.webp,images/services/dedicated.jpeg"
                    onerror="window.tryNextImg(this)">
                <div class="service-card-overlay">
                    <span class="service-card-title" data-i18n="service.dedicated.title">Cloud Dedicated</span>
                    <span class="service-card-sub" data-i18n="service.dedicated.sub">Hosting</span>
                </div>
            </div>
            <div class="service-card" data-target="html/discordbot.php">
                <img src="images/services/discordbot.png" alt="Discord Bot Hosting"
                    data-fallbacks="images/services/discordbot.jpg,images/services/discordbot.webp,images/services/discordbot.jpeg"
                    onerror="window.tryNextImg(this)">
                <div class="service-card-overlay">
                    <span class="service-card-title" data-i18n="service.discordbot.title">Discord Bot</span>
                    <span class="service-card-sub" data-i18n="service.discordbot.sub">Hosting</span>
                </div>
            </div>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-value" data-i18n="stat.uptime.value">99.9%</span>
                <span class="hero-stat-label" data-i18n="stat.uptime.label">Uptime Garantizado</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-value" data-i18n="stat.activation.value">&lt;5 min</span>
                <span class="hero-stat-label" data-i18n="stat.activation.label">Activación Inmediata</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-value" data-i18n="stat.support.value">24/7</span>
                <span class="hero-stat-label" data-i18n="stat.support.label">Soporte Humano Real</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-value" data-i18n="stat.ddos.value">1 Tbps</span>
                <span class="hero-stat-label" data-i18n="stat.ddos.label">Protección DDoS</span>
            </div>
        </div>

        <div class="hero-checks">
            <span><i class="fa-solid fa-circle-check"></i> <span data-i18n="check.performance">Alto Rendimiento</span></span>
            <span><i class="fa-solid fa-circle-check"></i> <span data-i18n="check.network">Red Global Baja Latencia</span></span>
            <span><i class="fa-solid fa-circle-check"></i> <span data-i18n="check.ddos">Protección DDoS</span></span>
            <span><i class="fa-solid fa-circle-check"></i> <span data-i18n="check.panel">Panel Moonly Incluido</span></span>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <p class="section-subtitle" data-i18n="features.subtitle">POR QUÉ ELEGIRNOS</p>
        <h2 class="section-title" data-i18n="features.title">Características que marcan la diferencia</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-rocket"></i></div>
                <div class="feature-text">
                    <h3 data-i18n="feature.hardware.title">Hardware de Última Gen</h3>
                    <p data-i18n="feature.hardware.desc">Ryzen 9 y SSDs NVMe para un rendimiento sin lag incluso bajo carga máxima.</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-dollar-sign"></i></div>
                <div class="feature-text">
                    <h3 data-i18n="feature.price.title">Precios Imbatibles</h3>
                    <p data-i18n="feature.price.desc">Planes desde $2.99/mes. Máximo rendimiento, mínimo costo, sin contratos ocultos.</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-bolt"></i></div>
                <div class="feature-text">
                    <h3 data-i18n="feature.uptime.title">99.9% Uptime Garantizado</h3>
                    <p data-i18n="feature.uptime.desc">Infraestructura enterprise redundante. Tu comunidad en línea, siempre.</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-headset"></i></div>
                <div class="feature-text">
                    <h3 data-i18n="feature.support.title">Soporte Humano 24/7</h3>
                    <p data-i18n="feature.support.desc">Discord, WhatsApp y email. Sin bots, respuestas reales de personas que saben de servidores.</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-play"></i></div>
                <div class="feature-text">
                    <h3 data-i18n="feature.activation.title">Activación Inmediata</h3>
                    <p data-i18n="feature.activation.desc">Paga y juega en minutos. Tu servidor listo al instante, automáticamente.</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="feature-text">
                    <h3 data-i18n="feature.ddos.title">Protección DDoS 1 Tbps</h3>
                    <p data-i18n="feature.ddos.desc">Anti-Shield empresarial de capa 7. Los ataques no te preocupan más.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="panel-section">
    <div class="container">
        <div style="text-align:center; margin-bottom:40px;">
            <p class="section-subtitle" data-i18n="panel.subtitle">GESTIÓN INTUITIVA</p>
            <h2 class="section-title" data-i18n="panel.title">Un panel que hace todo simple</h2>
            <p class="section-desc" data-i18n="panel.desc">Administra tus servidores con herramientas pro: consola en vivo, gestión de archivos, backups automáticos y más, desde un solo lugar.</p>
        </div>
        <div class="panel-container">
            <div class="panel-tabs">
                <div class="tab-item active" data-img="images/console/console.png">
                    <i class="fa-solid fa-terminal"></i><span data-i18n="panel.tab.console">Consola del Servidor</span>
                </div>
                <div class="tab-item" data-img="images/console/files.png">
                    <i class="fa-solid fa-folder-open"></i><span data-i18n="panel.tab.files">Gestor de Archivos</span>
                </div>
                <div class="tab-item" data-img="images/console/plugins.png">
                    <i class="fa-solid fa-puzzle-piece"></i><span data-i18n="panel.tab.plugins">Plugins</span>
                </div>
                <div class="tab-item" data-img="images/console/versions.png">
                    <i class="fa-solid fa-server"></i><span data-i18n="panel.tab.versions">Versiones</span>
                </div>
                <div class="tab-item" data-img="images/console/splitter.png">
                    <i class="fa-solid fa-network-wired"></i><span data-i18n="panel.tab.splitter">Splitter</span>
                </div>
                <div class="tab-item" data-img="images/console/modpack.png">
                    <i class="fa-solid fa-box-archive"></i><span data-i18n="panel.tab.modpack">Modpack</span>
                </div>
                <div class="tab-item" data-img="images/console/mods.png">
                    <i class="fa-solid fa-cubes"></i><span data-i18n="panel.tab.mods">Mods</span>
                </div>
            </div>
            <div class="panel-image-wrapper">
                <img id="panel-img" src="images/console/console.png"
                    alt="Panel de Control Moonly"
                    onerror="this.style.opacity='.15';this.src='https://i.imgur.com/Tuqj3Gz.png';"
                    style="transition:opacity .2s ease;">
            </div>
        </div>
    </div>
</section>

<section class="dashboard-section">
    <div class="container">
        <p class="section-subtitle" style="color: var(--cyan); font-weight: 700; font-size: 0.9rem; letter-spacing: 1px; margin-bottom: 8px;" data-i18n="map.subtitle">PRESENCIA GLOBAL</p>
        <h2 class="section-title" style="margin-bottom:10px; font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800;" data-i18n="map.title">Infraestructura de Baja Latencia</h2>
        <p class="section-desc" style="color: var(--muted); margin-bottom: 40px;" data-i18n="map.desc">Pasa el cursor sobre cada punto para ver el ping estimado hacia nuestra comunidad global.</p>
    </div>

    <div class="map-fullwidth">
        <img src="https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg" alt="Mapa" class="world-map-img">

        <div class="location-marker" style="top: 36%; left: 22%;">
            <div class="tooltip">
                <div class="tooltip-header">
                    <img src="https://flagcdn.com/w40/us.png" alt="USA">
                    <span>Dallas, TX</span>
                    <span class="status-badge" data-i18n="map.status.online">ONLINE</span>
                </div>
                <div class="tooltip-body-extended">
                    <div class="ping-row"><span>🇺🇸 Estados Unidos</span> <strong>~20-50ms</strong></div>
                    <div class="ping-row"><span>🇲🇽 México</span> <strong>~30-60ms</strong></div>
                    <div class="ping-row"><span>🇧🇷 Brasil</span> <strong>~60-90ms</strong></div>
                    <div class="ping-row"><span>🇵🇪 Perú</span> <strong>~70-110ms</strong></div>
                    <div class="ping-row"><span>🇨🇱 Chile</span> <strong>~80-120ms</strong></div>
                </div>
            </div>
            <div class="pulse"></div>
            <div class="dot"></div>
        </div>

        <div class="location-marker" style="top: 32%; left: 29%;">
            <div class="tooltip">
                <div class="tooltip-header">
                    <img src="https://flagcdn.com/w40/us.png" alt="USA">
                    <span>New York, NY</span>
                    <span class="status-badge" data-i18n="map.status.online">ONLINE</span>
                </div>
                <div class="tooltip-body-extended">
                    <div class="ping-row"><span>🇺🇸 Estados Unidos</span> <strong>~20-50ms</strong></div>
                    <div class="ping-row"><span>🇲🇽 México</span> <strong>~30-60ms</strong></div>
                    <div class="ping-row"><span>🇧🇷 Brasil</span> <strong>~60-90ms</strong></div>
                    <div class="ping-row"><span>🇵🇪 Perú</span> <strong>~70-110ms</strong></div>
                    <div class="ping-row"><span>🇨🇱 Chile</span> <strong>~80-120ms</strong></div>
                </div>
            </div>
            <div class="pulse"></div>
            <div class="dot"></div>
        </div>

        <div class="location-marker" style="top: 41%; left: 27%;">
            <div class="tooltip">
                <div class="tooltip-header">
                    <img src="https://flagcdn.com/w40/us.png" alt="USA">
                    <span>Miami, FL</span>
                    <span class="status-badge" data-i18n="map.status.online">ONLINE</span>
                </div>
                <div class="tooltip-body-extended">
                    <div class="ping-row"><span>🇺🇸 Estados Unidos</span> <strong>~20-50ms</strong></div>
                    <div class="ping-row"><span>🇲🇽 México</span> <strong>~30-60ms</strong></div>
                    <div class="ping-row"><span>🇧🇷 Brasil</span> <strong>~60-90ms</strong></div>
                    <div class="ping-row"><span>🇵🇪 Perú</span> <strong>~70-110ms</strong></div>
                    <div class="ping-row"><span>🇨🇱 Chile</span> <strong>~80-120ms</strong></div>
                </div>
            </div>
            <div class="pulse"></div>
            <div class="dot"></div>
        </div>

    </div>
</section>


<section class="ram-section">
    <div class="container">
        <p class="section-subtitle" data-i18n="ram.subtitle">CALCULADORA DE RAM</p>
        <h2 class="section-title" data-i18n="ram.title">¿Cuánta RAM necesitas?</h2>
        <p class="section-desc" style="margin-bottom:48px;" data-i18n="ram.desc">Mueve el slider para ver el precio de cada configuración. Máximo 128 GB.</p>
        <div class="ram-calculator">
            <div class="ram-display" id="ram-display">2 GB</div>
            <span class="ram-slider-label" data-i18n="ram.slider_label">Arrastra para ajustar la RAM</span>
            <div class="ram-track">
                <input type="range" id="ram-slider" min="0" max="11" value="0" step="1">
                <div class="ram-steps">
                    <span>2</span><span>4</span><span>6</span><span>8</span>
                    <span>12</span><span>16</span><span>24</span><span>32</span>
                    <span>48</span><span>64</span><span>96</span><span>128 GB</span>
                </div>
            </div>
            <div class="ram-price-block">
                <div class="ram-price-monthly">
                    <span class="cur">$</span><span id="ram-price">2.99</span>
                </div>
                <span class="ram-price-label" data-i18n="ram.price_label">USD / mes — activación inmediata</span>
                <br>
                <a href="html/planes.php" id="ram-plan-btn" class="ram-btn">
                    <i class="fa-solid fa-rocket"></i> <span data-i18n="ram.btn">Ver este plan</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="testimonials-section">
    <div class="container">
        <p class="section-subtitle" data-i18n="testimonials.subtitle">COMUNIDAD MOONLY</p>
        <h2 class="section-title" data-i18n="testimonials.title">Respaldado por administradores reales</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <i class="fa-solid fa-quote-right quote-watermark"></i>
                <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                <p class="review-text" data-i18n="testimonial.1.text">"El rendimiento es brutal. Migré mi servidor de 150 usuarios simultáneos y los TPS no bajan de 20. El mejor hosting que he probado."</p>
                <div class="reviewer">
                    <img src="" alt="Avatar">
                    <div class="reviewer-info"><h4>CarlosServer</h4><span data-i18n="testimonial.1.role">Cliente Minecraft</span></div>
                </div>
            </div>
            <div class="testimonial-card">
                <i class="fa-solid fa-quote-right quote-watermark"></i>
                <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                <p class="review-text" data-i18n="testimonial.2.text">"El soporte me ayudó a configurar Pterodactyl a las 3 AM un fin de semana. Respuesta en minutos. 10/10 sin dudas."</p>
                <div class="reviewer">
                    <img src="" alt="Avatar">
                    <div class="reviewer-info"><h4>MoonPlayer</h4><span data-i18n="testimonial.2.role">Cliente Cloud & Dedicated</span></div>
                </div>
            </div>
            <div class="testimonial-card">
                <i class="fa-solid fa-quote-right quote-watermark"></i>
                <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                <p class="review-text" data-i18n="testimonial.3.text">"Mis jugadores de Latam tienen 40ms estables y los ataques DDoS ya no son un problema. Increíble relación calidad-precio."</p>
                <div class="reviewer">
                    <img src="" alt="Avatar">
                    <div class="reviewer-info"><h4>NetworkAdmin</h4><span data-i18n="testimonial.3.role">Cliente Minecraft Network</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Llamamos al pie de página (que incluye los scripts comunes)
include 'includes/footer.php';
?>

<script>
/* ── Carrusel de servicios (rotación tipo carrusel) ── */
(function () {
    var carousel = document.getElementById('service-carousel');
    if (!carousel) return;
    var cards = Array.prototype.slice.call(carousel.querySelectorAll('.service-card'));
    var n = cards.length;
    var activeIndex = cards.findIndex(function (c) { return c.classList.contains('active'); });
    if (activeIndex < 0) activeIndex = 0;

    function spacingForWidth() {
        return window.innerWidth <= 700 ? 262 : 343;
    }
    var SPACING = spacingForWidth();

    function layout() {
        cards.forEach(function (card, i) {
            var isActive = i === activeIndex;
            card.classList.toggle('active', isActive);

            var diff = i - activeIndex;
            if (diff > n / 2) diff -= n;
            if (diff < -n / 2) diff += n;

            var x = diff * SPACING;
            var scale = isActive ? 1 : 0.82;

            card.style.transform = 'translateX(' + x + 'px) scale(' + scale + ')';
            card.style.zIndex = isActive ? 5 : (5 - Math.abs(diff));
        });
    }

    cards.forEach(function (card, index) {
        card.addEventListener('click', function () {
            if (index === activeIndex) {
                window.location.href = card.getAttribute('data-target');
                return;
            }
            activeIndex = index;
            layout();
        });
    });

    layout();
    window.addEventListener('resize', function () {
        SPACING = spacingForWidth();
        layout();
    });
})();
</script>
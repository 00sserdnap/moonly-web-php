/* =============================================
   MOONLY — MAIN.JS
   Responsabilidades:
     1. CSS var --navbar-h (altura real del navbar)
     2. Transiciones de página
     3. Tabs del panel (index)
     4. Acordeón de servidores dedicados
     5. Calculadora de RAM (index)
     6. Ping simulado en el mapa (index)
     7. Fallback en cascada para imágenes (tryNextImg)
     8. Scroll-hide del navbar
     9. Mega menús (abrir/cerrar con clic)
    10. Menú móvil (hamburguesa)
    11. Menú de usuario (logueado)
   ============================================= */

/* ─────────────────────────────────────────────
   UTILIDAD GLOBAL — fallback de imagen en cascada
───────────────────────────────────────────── */
window.tryNextImg = function (img) {
    var list = (img.getAttribute('data-fallbacks') || '').split(',').filter(Boolean);
    if (!list.length) {
        img.onerror = null;
        img.style.display = 'none';
        if (img.parentElement) {
            img.parentElement.style.background =
                'linear-gradient(160deg, rgba(20,20,28,.9), rgba(40,40,55,.9))';
        }
        return;
    }
    var next = list.shift();
    img.setAttribute('data-fallbacks', list.join(','));
    img.src = next;
};

/* ─────────────────────────────────────────────
   --navbar-h: se calcula lo antes posible,
   ANTES del DOMContentLoaded para evitar
   el salto visual en el primer render.
───────────────────────────────────────────── */
(function setNavbarHeight() {
    var nav = document.querySelector('.navbar');
    if (!nav) return;
    function setH() {
        document.documentElement.style.setProperty('--navbar-h', nav.offsetHeight + 'px');
    }
    setH();
    window.addEventListener('resize', setH, { passive: true });
    document.addEventListener('moonly:langchange', function () { setTimeout(setH, 50); });
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(setH);
    }
})();

document.addEventListener('DOMContentLoaded', function () {

    /* ══════════════════════════════════════════
       2. TRANSICIONES DE PÁGINA
    ══════════════════════════════════════════ */
    (function () {
        var overlay = document.querySelector('.page-transition');
        if (overlay) setTimeout(function () { overlay.classList.add('fade-out'); }, 50);

        document.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function (e) {
                var target = this.getAttribute('href');
                if (
                    target &&
                    target !== '#' &&
                    !target.startsWith('#') &&
                    !target.startsWith('http') &&
                    !target.startsWith('mailto') &&
                    !this.classList.contains('dropdown-toggle') &&
                    !this.classList.contains('toggle-details')
                ) {
                    e.preventDefault();
                    if (overlay) {
                        overlay.classList.remove('fade-out');
                        overlay.classList.add('fade-in');
                        setTimeout(function () { window.location.href = target; }, 360);
                    } else {
                        window.location.href = target;
                    }
                }
            });
        });
    })();

    /* ══════════════════════════════════════════
       3. TABS DEL PANEL (solo index.php)
    ══════════════════════════════════════════ */
    (function () {
        var tabs     = document.querySelectorAll('.tab-item');
        var panelImg = document.getElementById('panel-img');
        if (!tabs.length || !panelImg) return;

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) { t.classList.remove('active'); });
                this.classList.add('active');
                var src = this.getAttribute('data-img');
                if (src) {
                    panelImg.style.opacity = '0';
                    setTimeout(function () {
                        panelImg.src = src;
                        panelImg.style.opacity = '1';
                    }, 200);
                }
            });
        });
    })();

    /* ══════════════════════════════════════════
       4. ACORDEÓN DEDICATED SERVERS
    ══════════════════════════════════════════ */
    (function () {
        document.querySelectorAll('.toggle-details').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var item  = this.closest('.server-item');
                var panel = item.querySelector('.server-details-panel');
                var open  = item.classList.contains('details-open');

                document.querySelectorAll('.server-item').forEach(function (i) {
                    i.classList.remove('details-open');
                    var p = i.querySelector('.server-details-panel');
                    if (p) p.style.maxHeight = null;
                });

                if (!open) {
                    item.classList.add('details-open');
                    panel.style.maxHeight = panel.scrollHeight + 'px';
                }
            });
        });
    })();

    /* ══════════════════════════════════════════
       5. CALCULADORA DE RAM (solo index.php)
    ══════════════════════════════════════════ */
    (function () {
        var slider   = document.getElementById('ram-slider');
        var display  = document.getElementById('ram-display');
        var priceEl  = document.getElementById('ram-price');
        var planBtn  = document.getElementById('ram-plan-btn');
        if (!slider) return;

        var ramPricing = {
            2: 2.99,  4: 5.99,   6: 8.99,   8: 11.99,
            12: 16.99, 16: 21.99, 24: 30.99, 32: 39.99,
            48: 55.99, 64: 69.99, 96: 99.99, 128: 129.99
        };
        var ramValues = Object.keys(ramPricing).map(Number);
        slider.max = ramValues.length - 1;

        function updateRam() {
            var gb  = ramValues[parseInt(slider.value)];
            var usd = ramPricing[gb];
            var curSymbol = document.querySelector('.ram-price-monthly .cur');

            if (display) display.textContent = gb + ' GB';
            if (priceEl) {
                priceEl.setAttribute('data-usd', usd.toFixed(2));
                if (window.MoonlyCurrency) {
                    var code = window.MoonlyCurrency.getCurrency();
                    var conv = window.MoonlyCurrency.convert(usd, code);
                    var dec  = window.MoonlyCurrency.decimalsFor(code);
                    priceEl.textContent = conv.toLocaleString('es-CL', {
                        minimumFractionDigits: dec, maximumFractionDigits: dec
                    }) + (code !== 'USD' ? ' ' + code : '');
                    if (curSymbol) curSymbol.textContent = window.MoonlyCurrency.symbolFor(code);
                } else {
                    priceEl.textContent = usd.toFixed(2);
                    if (curSymbol) curSymbol.textContent = '$';
                }
            }
            if (planBtn) planBtn.href = 'html/planes.php?ram=' + gb;
        }

        slider.addEventListener('input', updateRam);
        document.addEventListener('moonly:currencychange', updateRam);
        updateRam();
    })();

    /* ══════════════════════════════════════════
       6. PING SIMULADO EN MAPA (solo index.php)
    ══════════════════════════════════════════ */
    (function () {
        document.querySelectorAll('.ping-live').forEach(function (el) {
            var base = parseInt(el.getAttribute('data-base') || el.textContent);
            el.setAttribute('data-base', base);
            setInterval(function () {
                var jitter = Math.floor(Math.random() * 11) - 5;
                var val    = base + jitter;
                var color  = val < 60 ? '#00e676' : val < 120 ? '#facc15' : '#ff5252';
                el.textContent  = val + 'ms';
                el.style.color  = color;
            }, 3000);
        });
    })();

    /* ══════════════════════════════════════════
       7. SCROLL-HIDE NAVBAR
    ══════════════════════════════════════════ */
    (function () {
        var nav = document.querySelector('.navbar');
        if (!nav) return;

        function onScroll() {
            var y    = window.scrollY || window.pageYOffset || 0;
            var h    = nav.offsetHeight || 120;
            var shift = Math.min(y, h);
            nav.style.transform    = 'translateY(-' + shift + 'px)';
            nav.style.pointerEvents = shift >= h - 2 ? 'none' : 'auto';
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll, { passive: true });
        onScroll();
    })();

    /* ══════════════════════════════════════════
       8. MEGA MENÚS — abrir/cerrar con clic
          (hover solo en desktop, clic en móvil)
    ══════════════════════════════════════════ */
    (function () {
        var megaToggles = document.querySelectorAll('.has-mega > .dropdown-toggle');

        megaToggles.forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                if (window.innerWidth > 980) {
                    e.preventDefault();
                    var container = this.parentElement;

                    document.querySelectorAll('.has-mega.open').forEach(function (other) {
                        if (other !== container) other.classList.remove('open');
                    });

                    container.classList.toggle('open');
                }
            });
        });

        document.addEventListener('click', function (e) {
            document.querySelectorAll('.has-mega.open').forEach(function (c) {
                if (!c.contains(e.target)) c.classList.remove('open');
            });
        });
    })();

    /* ══════════════════════════════════════════
       9. MENÚ MÓVIL — hamburguesa
    ══════════════════════════════════════════ */
    (function () {
        var btn    = document.querySelector('.mobile-menu-btn');
        var navbar = document.querySelector('.navbar');
        if (!btn || !navbar) return;

        btn.addEventListener('click', function () {
            navbar.classList.toggle('menu-open');
            var icon = btn.querySelector('i');
            if (navbar.classList.contains('menu-open')) {
                icon.classList.replace('fa-bars', 'fa-xmark');
            } else {
                icon.classList.replace('fa-xmark', 'fa-bars');
            }
        });

        document.querySelectorAll('.dropdown-container > .dropdown-toggle').forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                if (window.innerWidth <= 980) {
                    e.preventDefault();
                    this.parentElement.classList.toggle('open');
                }
            });
        });
    })();

    /* ══════════════════════════════════════════
       10. MENÚ DE USUARIO (logueado)
    ══════════════════════════════════════════ */
    (function () {
        var selector = document.querySelector('.user-menu-selector');
        if (!selector) return;
        var toggle = selector.querySelector('.user-menu-toggle');

        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            var willOpen = !selector.classList.contains('open');
            document.querySelectorAll('.lang-selector.open, .currency-selector-ctrl.open').forEach(function (s) {
                s.classList.remove('open');
            });
            if (willOpen) selector.classList.add('open');
        });

        document.addEventListener('click', function () {
            selector.classList.remove('open');
        });
    })();

});
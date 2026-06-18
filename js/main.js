document.addEventListener("DOMContentLoaded", () => {

    // ══════════════════════════════════════════
    // 0. NAVBAR HEIGHT → CSS VAR (--navbar-h)
    //    Permite que cualquier página calcule paddings
    //    relativos a la altura REAL del navbar (que varía
    //    según idioma, cantidad de quick-links, y breakpoint).
    // ══════════════════════════════════════════
    (function () {
        const nav = document.querySelector('.navbar');
        if (!nav) return;
        function setNavbarHeightVar() {
            document.documentElement.style.setProperty('--navbar-h', nav.offsetHeight + 'px');
        }
        setNavbarHeightVar();
        window.addEventListener('resize', setNavbarHeightVar, { passive: true });
        // Recalcular tras cambios de idioma (el texto puede hacer wrap distinto)
        document.addEventListener('moonly:langchange', () => setTimeout(setNavbarHeightVar, 50));
        // Recalcular cuando las fuentes web terminan de cargar (pueden mover el layout)
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(setNavbarHeightVar);
        }
    })();

    // ══════════════════════════════════════════
    // 1. PAGE TRANSITIONS
    // ══════════════════════════════════════════
    const overlay = document.querySelector('.page-transition');
    if (overlay) {
        setTimeout(() => overlay.classList.add('fade-out'), 50);
    }

    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            const target = this.getAttribute('href');
            if (
                target && target !== '#' &&
                !target.startsWith('#') &&
                !target.startsWith('http') &&
                !target.startsWith('mailto') &&
                !target.startsWith('_') &&
                !this.classList.contains('dropdown-toggle') &&
                !this.classList.contains('toggle-details')
            ) {
                e.preventDefault();
                if (overlay) {
                    overlay.classList.remove('fade-out');
                    overlay.classList.add('fade-in');
                    setTimeout(() => { window.location.href = target; }, 360);
                } else {
                    window.location.href = target;
                }
            }
        });
    });

    // ══════════════════════════════════════════
    // 2. PANEL TABS (index.html)
    //    Each tab switches the image displayed
    // ══════════════════════════════════════════
    const tabs = document.querySelectorAll('.tab-item');
    const panelImg = document.getElementById('panel-img');

    if (tabs.length && panelImg) {
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                // Remove active from all
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Get image path from data attribute and swap with fade
                const imgSrc = this.getAttribute('data-img');
                if (imgSrc) {
                    panelImg.style.opacity = '0';
                    setTimeout(() => {
                        panelImg.src = imgSrc;
                        panelImg.style.opacity = '1';
                    }, 200);
                }
            });
        });
    }

    // ══════════════════════════════════════════
    // 3. DEDICATED SERVERS ACCORDION
    // ══════════════════════════════════════════
    document.querySelectorAll('.toggle-details').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const currentItem = this.closest('.server-item');
            const currentPanel = currentItem.querySelector('.server-details-panel');
            const isOpen = currentItem.classList.contains('details-open');

            // Close all others
            document.querySelectorAll('.server-item').forEach(item => {
                if (item !== currentItem) {
                    item.classList.remove('details-open');
                    const p = item.querySelector('.server-details-panel');
                    if (p) p.style.maxHeight = null;
                }
            });

            // Toggle current
            if (isOpen) {
                currentItem.classList.remove('details-open');
                currentPanel.style.maxHeight = null;
            } else {
                currentItem.classList.add('details-open');
                currentPanel.style.maxHeight = currentPanel.scrollHeight + 'px';
            }
        });
    });

    // ══════════════════════════════════════════
    // 4. RAM CALCULATOR (index.html)
    // ══════════════════════════════════════════
    const ramSlider   = document.getElementById('ram-slider');
    const ramDisplay  = document.getElementById('ram-display');
    const ramPrice    = document.getElementById('ram-price');
    const ramPlanBtn  = document.getElementById('ram-plan-btn');

    // Price table: GB → monthly USD
    const ramPricing = {
        2: 2.99, 4: 5.99, 6: 8.99, 8: 11.99,
        12: 16.99, 16: 21.99, 24: 30.99, 32: 39.99,
        48: 55.99, 64: 69.99, 96: 99.99, 128: 129.99
    };
    const ramValues = Object.keys(ramPricing).map(Number);

    function updateRam() {
        if (!ramSlider) return;
        const idx = parseInt(ramSlider.value);
        const gb  = ramValues[idx];
        const usdPrice = ramPricing[gb];
        const curSymbol = document.querySelector('.ram-price-monthly .cur');

        if (ramDisplay) ramDisplay.textContent = gb + ' GB';

        if (ramPrice) {
            ramPrice.setAttribute('data-usd', usdPrice.toFixed(2));
            if (window.MoonlyCurrency) {
                const code = window.MoonlyCurrency.getCurrency();
                const converted = window.MoonlyCurrency.convert(usdPrice, code);
                const decimals = window.MoonlyCurrency.decimalsFor(code);
                ramPrice.textContent = converted.toLocaleString('es-CL', {
                    minimumFractionDigits: decimals,
                    maximumFractionDigits: decimals
                }) + (code !== 'USD' ? ' ' + code : '');
                if (curSymbol) curSymbol.textContent = window.MoonlyCurrency.symbolFor(code);
            } else {
                ramPrice.textContent = usdPrice.toFixed(2);
                if (curSymbol) curSymbol.textContent = '$';
            }
        }
        if (ramPlanBtn) ramPlanBtn.href = 'html/planes.html?ram=' + gb;
    }

    if (ramSlider) {
        ramSlider.max = ramValues.length - 1;
        ramSlider.addEventListener('input', updateRam);
        updateRam();
    }

    document.addEventListener('moonly:currencychange', updateRam);

    // ══════════════════════════════════════════
    // 5. LIVE PING SIMULATION (map markers)
    //    Randomise ±5ms every 3s to feel alive
    // ══════════════════════════════════════════
    document.querySelectorAll('.ping-live').forEach(el => {
        const base = parseInt(el.getAttribute('data-base') || el.textContent);
        el.setAttribute('data-base', base);
        setInterval(() => {
            const jitter = Math.floor(Math.random() * 11) - 5;
            const val = base + jitter;
            const color = val < 60 ? '#00e676' : val < 120 ? '#facc15' : '#ff5252';
            el.textContent = val + 'ms';
            el.style.color = color;
        }, 3000);
    });

});
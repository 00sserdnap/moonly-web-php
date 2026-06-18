/* =============================================
   MOONLY — CURRENCY.JS
   Maneja: selector de moneda, conversión, detección
   por timezone / browser locale / GeoIP.
   ============================================= */
(function () {
    'use strict';

    var STORAGE_KEY  = 'moonly_currency';
    var GEOIP_KEY    = 'moonly_geoip_country';
    var DEFAULT      = 'USD';

    var META = {
        USD: { rate: 1,      symbol: '$',   name: 'Dólar estadounidense', country: 'Estados Unidos',      decimals: 2, popular: true },
        CAD: { rate: 1.26,   symbol: '$',   name: 'Dólar canadiense',     country: 'Canadá',              decimals: 2 },
        MXN: { rate: 18.5,   symbol: '$',   name: 'Peso mexicano',        country: 'México',              decimals: 2, popular: true },
        CLP: { rate: 890,    symbol: '$',   name: 'Peso chileno',         country: 'Chile',               decimals: 0, popular: true },
        ARS: { rate: 1420,   symbol: '$',   name: 'Peso argentino',       country: 'Argentina',           decimals: 0, popular: true },
        COP: { rate: 3600,   symbol: '$',   name: 'Peso colombiano',      country: 'Colombia',            decimals: 0, popular: true },
        PEN: { rate: 3.6,    symbol: 'S/',  name: 'Sol peruano',          country: 'Perú',                decimals: 2, popular: true },
        BRL: { rate: 5.2,    symbol: 'R$',  name: 'Real brasileño',       country: 'Brasil',              decimals: 2, popular: true },
        UYU: { rate: 39.75,  symbol: '$',   name: 'Peso uruguayo',        country: 'Uruguay',             decimals: 2 },
        BOB: { rate: 6.75,   symbol: 'Bs',  name: 'Boliviano',            country: 'Bolivia',             decimals: 2 },
        PYG: { rate: 6010,   symbol: '₲',   name: 'Guaraní paraguayo',    country: 'Paraguay',            decimals: 0 },
        GTQ: { rate: 7.6,    symbol: 'Q',   name: 'Quetzal guatemalteco', country: 'Guatemala',           decimals: 2 },
        HNL: { rate: 26.73,  symbol: 'L',   name: 'Lempira hondureña',    country: 'Honduras',            decimals: 2 },
        NIO: { rate: 36.62,  symbol: 'C$',  name: 'Córdoba nicaragüense', country: 'Nicaragua',           decimals: 2 },
        CRC: { rate: 510,    symbol: '₡',   name: 'Colón costarricense',  country: 'Costa Rica',          decimals: 0 },
        DOP: { rate: 57.73,  symbol: 'RD$', name: 'Peso dominicano',      country: 'República Dominicana',decimals: 2 },
        PAB: { rate: 1,      symbol: 'B/.', name: 'Balboa panameño',      country: 'Panamá',              decimals: 2 },
        VES: { rate: 593,    symbol: 'Bs',  name: 'Bolívar venezolano',   country: 'Venezuela',           decimals: 2, popular: true },
        EUR: { rate: 0.867,  symbol: '€',   name: 'Euro',                 country: 'España / Eurozona',   decimals: 2, popular: true },
        GBP: { rate: 0.72,   symbol: '£',   name: 'Libra esterlina',      country: 'Reino Unido',         decimals: 2 },
        CHF: { rate: 0.91,   symbol: 'CHF', name: 'Franco suizo',         country: 'Suiza',               decimals: 2 },
        SEK: { rate: 10.5,   symbol: 'kr',  name: 'Corona sueca',         country: 'Suecia',              decimals: 2 },
        NOK: { rate: 10.8,   symbol: 'kr',  name: 'Corona noruega',       country: 'Noruega',             decimals: 2 },
        DKK: { rate: 6.85,   symbol: 'kr',  name: 'Corona danesa',        country: 'Dinamarca',           decimals: 2 },
        PLN: { rate: 4.0,    symbol: 'zł',  name: 'Złoty polaco',         country: 'Polonia',             decimals: 2 }
    };

    var ALL     = Object.keys(META);
    var POPULAR = ALL.filter(function (c) { return META[c].popular; });

    var COUNTRY_MAP = {
        US:'USD', PR:'USD', CA:'CAD', MX:'MXN',
        CL:'CLP', AR:'ARS', CO:'COP', PE:'PEN', BR:'BRL',
        UY:'UYU', BO:'BOB', PY:'PYG', GT:'GTQ', HN:'HNL',
        NI:'NIO', CR:'CRC', DO:'DOP', PA:'PAB', VE:'VES',
        EC:'USD', SV:'USD',
        ES:'EUR', DE:'EUR', FR:'EUR', IT:'EUR', PT:'EUR',
        NL:'EUR', BE:'EUR', AT:'EUR', IE:'EUR', FI:'EUR',
        GR:'EUR', LU:'EUR', SI:'EUR', SK:'EUR', LT:'EUR',
        LV:'EUR', EE:'EUR', CY:'EUR', MT:'EUR', HR:'EUR',
        GB:'GBP', CH:'CHF', SE:'SEK', NO:'NOK', DK:'DKK', PL:'PLN'
    };

    var TIMEZONE_MAP = {
        'America/Santiago':'CLP',
        'America/Buenos_Aires':'ARS','America/Argentina/Buenos_Aires':'ARS','America/Cordoba':'ARS',
        'America/Bogota':'COP', 'America/Lima':'PEN',
        'America/Sao_Paulo':'BRL','America/Manaus':'BRL','America/Recife':'BRL','America/Fortaleza':'BRL',
        'America/Mexico_City':'MXN','America/Tijuana':'MXN','America/Monterrey':'MXN','America/Cancun':'MXN',
        'America/Montevideo':'UYU','America/La_Paz':'BOB','America/Asuncion':'PYG',
        'America/Guatemala':'GTQ','America/Tegucigalpa':'HNL','America/Managua':'NIO',
        'America/Costa_Rica':'CRC','America/Santo_Domingo':'DOP','America/Panama':'PAB','America/Caracas':'VES',
        'America/Guayaquil':'USD','America/El_Salvador':'USD',
        'America/New_York':'USD','America/Chicago':'USD','America/Denver':'USD',
        'America/Los_Angeles':'USD','America/Phoenix':'USD','America/Anchorage':'USD',
        'America/Toronto':'CAD','America/Vancouver':'CAD','America/Edmonton':'CAD','America/Winnipeg':'CAD',
        'Europe/Madrid':'EUR','Europe/Berlin':'EUR','Europe/Paris':'EUR','Europe/Rome':'EUR',
        'Europe/Lisbon':'EUR','Europe/Amsterdam':'EUR','Europe/Brussels':'EUR','Europe/Vienna':'EUR',
        'Europe/Dublin':'EUR','Europe/Helsinki':'EUR','Europe/Athens':'EUR',
        'Europe/London':'GBP','Europe/Zurich':'CHF','Europe/Stockholm':'SEK',
        'Europe/Oslo':'NOK','Europe/Copenhagen':'DKK','Europe/Warsaw':'PLN'
    };

    /* ── Detección local (sin red) ── */
    function detectFromLocale() {
        try {
            var tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
            if (tz && TIMEZONE_MAP[tz]) return TIMEZONE_MAP[tz];
        } catch (e) {}

        var locales = navigator.languages && navigator.languages.length
            ? navigator.languages : [navigator.language || ''];

        for (var i = 0; i < locales.length; i++) {
            var parts  = (locales[i] || '').split(/[-_]/);
            var region = parts.length > 1 ? parts[1].toUpperCase() : '';
            if (region && COUNTRY_MAP[region]) return COUNTRY_MAP[region];
        }
        return DEFAULT;
    }

    /* ── Detección vía GeoIP (asíncrona) ── */
    function detectFromGeoIP(callback) {
        var cached = sessionStorage.getItem(GEOIP_KEY);
        if (cached) { callback(COUNTRY_MAP[cached] || null); return; }
        if (!window.fetch) { callback(null); return; }

        var done  = false;
        var timer = setTimeout(function () { done = true; callback(null); }, 3000);

        fetch('https://ipapi.co/json/')
            .then(function (r) { return r.json(); })
            .then(function (d) {
                if (done) return;
                clearTimeout(timer);
                var c = d && d.country ? d.country : null;
                if (c) sessionStorage.setItem(GEOIP_KEY, c);
                callback(c ? (COUNTRY_MAP[c] || null) : null);
            })
            .catch(function () { if (!done) { clearTimeout(timer); callback(null); } });
    }

    /* ── Estado actual ── */
    var _current = null;

    function getCurrent() {
        if (_current) return _current;
        var session = sessionStorage.getItem(STORAGE_KEY);
        if (session && ALL.indexOf(session) !== -1) return session;
        return detectFromLocale();
    }

    /* ── Formatear ── */
    function format(usd, code) {
        var m = META[code] || META[DEFAULT];
        var v = (usd * m.rate).toLocaleString('es-CL', {
            minimumFractionDigits: m.decimals,
            maximumFractionDigits: m.decimals
        });
        return m.symbol + v + (code !== 'USD' ? ' ' + code : '');
    }

    /* ── Refrescar todos los [data-usd] ── */
    function refreshAll(code) {
        document.querySelectorAll('[data-usd]').forEach(function (el) {
            var usd = parseFloat(el.getAttribute('data-usd'));
            if (!isNaN(usd)) el.textContent = format(usd, code);
        });
    }

    /* ── Aplicar moneda ── */
    function apply(code, animate, isManual) {
        if (ALL.indexOf(code) === -1) code = DEFAULT;
        if (animate) {
            document.documentElement.classList.add('theme-transition');
            setTimeout(function () { document.documentElement.classList.remove('theme-transition'); }, 300);
        }
        _current = code;
        if (isManual) sessionStorage.setItem(STORAGE_KEY, code);

        document.querySelectorAll('.currency-toggle .current-currency').forEach(function (el) {
            el.textContent = code;
        });
        document.querySelectorAll('.currency-option').forEach(function (opt) {
            opt.classList.toggle('active', opt.getAttribute('data-currency') === code);
        });

        refreshAll(code);
        document.dispatchEvent(new CustomEvent('moonly:currencychange', { detail: { currency: code } }));
    }

    /* ── Construir opción del menú ── */
    function makeOption(code) {
        var opt = document.createElement('div');
        opt.className = 'currency-option';
        opt.setAttribute('data-currency', code);
        opt.setAttribute('role', 'option');
        opt.innerHTML =
            '<span class="code">' + code + '</span>' +
            '<span class="name">' + META[code].name +
                '<small class="currency-country">' + META[code].country + '</small></span>' +
            '<i class="fa-solid fa-check check"></i>';
        return opt;
    }

    /* ── Construir menú de monedas ── */
    function buildMenu() {
        document.querySelectorAll('.currency-selector-ctrl').forEach(function (selector) {
            var menu = selector.querySelector('.currency-menu');
            if (!menu || menu.getAttribute('data-built') === '1') return;
            menu.setAttribute('data-built', '1');

            /* Buscador */
            var searchWrap = document.createElement('div');
            searchWrap.className = 'currency-search-wrap';
            searchWrap.innerHTML = '<i class="fa-solid fa-magnifying-glass"></i>' +
                '<input type="text" class="currency-search" placeholder="Buscar país o moneda…">';
            menu.appendChild(searchWrap);

            /* Lista */
            var listEl = document.createElement('div');
            listEl.className = 'currency-list';
            menu.appendChild(listEl);

            /* Vacío */
            var emptyEl = document.createElement('div');
            emptyEl.className = 'currency-empty';
            emptyEl.textContent = 'Sin resultados';
            emptyEl.style.display = 'none';
            menu.appendChild(emptyEl);

            POPULAR.forEach(function (code) { listEl.appendChild(makeOption(code)); });

            var input = searchWrap.querySelector('.currency-search');

            input.addEventListener('input', function () {
                var q = input.value.trim().toLowerCase();
                listEl.innerHTML = '';
                var matches = q
                    ? ALL.filter(function (c) {
                        var m = META[c];
                        return c.toLowerCase().indexOf(q) !== -1 ||
                               m.name.toLowerCase().indexOf(q) !== -1 ||
                               m.country.toLowerCase().indexOf(q) !== -1;
                    })
                    : POPULAR;

                emptyEl.style.display = matches.length ? 'none' : 'block';
                var cur = getCurrent();
                matches.forEach(function (code) {
                    var el = makeOption(code);
                    el.classList.toggle('active', code === cur);
                    listEl.appendChild(el);
                });
            });

            input.addEventListener('click',   function (e) { e.stopPropagation(); });
            input.addEventListener('keydown',  function (e) { e.stopPropagation(); });
        });
    }

    /* ── Inicializar ── */
    function init() {
        /* Limpiar residuos de versiones anteriores */
        try { localStorage.removeItem(STORAGE_KEY); } catch (e) {}

        buildMenu();

        var hasManual = !!sessionStorage.getItem(STORAGE_KEY);
        apply(getCurrent(), false, false);

        /* Refinar con GeoIP solo si el usuario no eligió manualmente */
        if (!hasManual) {
            detectFromGeoIP(function (geo) {
                if (geo && !sessionStorage.getItem(STORAGE_KEY)) {
                    apply(geo, true, false);
                }
            });
        }

        /* Eventos del selector */
        document.querySelectorAll('.currency-selector-ctrl').forEach(function (selector) {
            var toggle = selector.querySelector('.currency-toggle');
            if (toggle) {
                toggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var willOpen = !selector.classList.contains('open');
                    document.querySelectorAll('.currency-selector-ctrl.open').forEach(function (s) {
                        s.classList.remove('open');
                    });
                    if (willOpen) {
                        selector.classList.add('open');
                        var input = selector.querySelector('.currency-search');
                        if (input) {
                            input.value = '';
                            input.dispatchEvent(new Event('input'));
                            setTimeout(function () { input.focus(); }, 50);
                        }
                    }
                });
            }

            selector.addEventListener('click', function (e) {
                var opt = e.target.closest('.currency-option');
                if (!opt) return;
                apply(opt.getAttribute('data-currency'), true, true);
                selector.classList.remove('open');
            });
        });

        document.addEventListener('click', function () {
            document.querySelectorAll('.currency-selector-ctrl.open').forEach(function (s) {
                s.classList.remove('open');
            });
        });
    }

    /* ── API pública ── */
    window.MoonlyCurrency = {
        format:      format,
        getCurrency: getCurrent,
        apply:       apply,
        refresh:     refreshAll,
        symbolFor:   function (code) { return (META[code] || META[DEFAULT]).symbol; },
        convert:     function (usd, code) { return usd * ((META[code] || META[DEFAULT]).rate); },
        decimalsFor: function (code) { return (META[code] || META[DEFAULT]).decimals; }
    };

    document.addEventListener('DOMContentLoaded', init);

})();

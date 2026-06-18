/* =============================================
   MOONLY HOSTING — THEME + i18n ENGINE
   Reutilizable en todas las páginas.
   Requiere: i18n-dict.js cargado ANTES de este archivo.
   ============================================= */
(function () {
    "use strict";

    var STORAGE_THEME = "moonly_theme";
    var STORAGE_LANG   = "moonly_lang";
    var SUPPORTED_LANGS = ["es", "en"];
    var DEFAULT_LANG = "es";

    var LANG_META = {
        es: { flag: "🇪🇸", label: "Español" },
        en: { flag: "🇺🇸", label: "English" }
    };

    /* ────────────────────────────────
       THEME
    ──────────────────────────────── */
    function getPreferredTheme() {
        var saved = localStorage.getItem(STORAGE_THEME);
        if (saved === "dark" || saved === "light") return saved;
        return window.matchMedia && window.matchMedia("(prefers-color-scheme: light)").matches ? "light" : "dark";
    }

    function applyTheme(theme, animate) {
        var root = document.documentElement;
        if (animate) {
            root.classList.add("theme-transition");
            window.setTimeout(function () { root.classList.remove("theme-transition"); }, 300);
        }
        root.setAttribute("data-theme", theme);
        localStorage.setItem(STORAGE_THEME, theme);

        var meta = document.querySelector('meta[name="theme-color"]');
        if (meta) meta.setAttribute("content", theme === "light" ? "#f4f7fb" : "#080b12");

        document.querySelectorAll(".theme-toggle").forEach(function (btn) {
            btn.setAttribute("aria-pressed", theme === "light" ? "true" : "false");
        });
    }

    function initTheme() {
        applyTheme(getPreferredTheme(), false);

        document.querySelectorAll(".theme-toggle").forEach(function (btn) {
            btn.addEventListener("click", function () {
                var current = document.documentElement.getAttribute("data-theme") || "dark";
                applyTheme(current === "dark" ? "light" : "dark", true);
            });
        });
    }

    /* ────────────────────────────────
       i18n
    ──────────────────────────────── */
    function detectBrowserLang() {
        var nav = (navigator.language || navigator.userLanguage || "es").toLowerCase();
        if (nav.indexOf("en") === 0) return "en";
        if (nav.indexOf("es") === 0) return "es";
        return DEFAULT_LANG;
    }

    function getPreferredLang() {
        var saved = localStorage.getItem(STORAGE_LANG);
        if (saved && SUPPORTED_LANGS.indexOf(saved) !== -1) return saved;
        return detectBrowserLang();
    }

    function t(key, lang) {
        var dict = window.MOONLY_I18N || {};
        var table = dict[lang] || dict[DEFAULT_LANG] || {};
        return table[key] !== undefined ? table[key] : (dict[DEFAULT_LANG] && dict[DEFAULT_LANG][key]);
    }

    function applyLang(lang, animate) {
        if (SUPPORTED_LANGS.indexOf(lang) === -1) lang = DEFAULT_LANG;

        if (animate) {
            document.documentElement.classList.add("theme-transition");
            window.setTimeout(function () { document.documentElement.classList.remove("theme-transition"); }, 300);
        }

        document.documentElement.setAttribute("lang", lang);
        localStorage.setItem(STORAGE_LANG, lang);

        document.querySelectorAll("[data-i18n]").forEach(function (el) {
            var key = el.getAttribute("data-i18n");
            var val = t(key, lang);
            if (val !== undefined) el.textContent = val;
        });

        document.querySelectorAll("[data-i18n-html]").forEach(function (el) {
            var key = el.getAttribute("data-i18n-html");
            var val = t(key, lang);
            if (val !== undefined) el.innerHTML = val;
        });

        document.querySelectorAll("[data-i18n-attr]").forEach(function (el) {
            var pairs = el.getAttribute("data-i18n-attr").split(";");
            pairs.forEach(function (pair) {
                var parts = pair.split(":");
                if (parts.length !== 2) return;
                var attr = parts[0].trim();
                var key = parts[1].trim();
                var val = t(key, lang);
                if (val !== undefined) el.setAttribute(attr, val);
            });
        });

        document.querySelectorAll(".lang-toggle .current-flag").forEach(function (el) {
            el.textContent = LANG_META[lang].flag;
        });
        document.querySelectorAll(".lang-toggle .current-code").forEach(function (el) {
            el.textContent = lang.toUpperCase();
        });
        document.querySelectorAll(".lang-option").forEach(function (opt) {
            opt.classList.toggle("active", opt.getAttribute("data-lang") === lang);
        });

        document.dispatchEvent(new CustomEvent("moonly:langchange", { detail: { lang: lang } }));
    }

    function buildLangMenuIfNeeded() {
        document.querySelectorAll(".lang-selector").forEach(function (selector) {
            var menu = selector.querySelector(".lang-menu");
            if (!menu || menu.children.length > 0) return;
            SUPPORTED_LANGS.forEach(function (code) {
                var opt = document.createElement("div");
                opt.className = "lang-option";
                opt.setAttribute("data-lang", code);
                opt.setAttribute("role", "option");
                opt.innerHTML =
                    '<span class="flag">' + LANG_META[code].flag + "</span>" +
                    "<span>" + LANG_META[code].label + "</span>" +
                    '<i class="fa-solid fa-check check"></i>';
                menu.appendChild(opt);
            });
        });
    }

    function initLang() {
        buildLangMenuIfNeeded();
        applyLang(getPreferredLang(), false);

        document.querySelectorAll(".lang-selector").forEach(function (selector) {
            var toggle = selector.querySelector(".lang-toggle");
            if (toggle) {
                toggle.addEventListener("click", function (e) {
                    e.stopPropagation();
                    var willOpen = !selector.classList.contains("open");
                    document.querySelectorAll(".lang-selector.open").forEach(function (s) { s.classList.remove("open"); });
                    if (willOpen) selector.classList.add("open");
                });
            }
            selector.addEventListener("click", function (e) {
                var opt = e.target.closest(".lang-option");
                if (!opt) return;
                applyLang(opt.getAttribute("data-lang"), true);
                selector.classList.remove("open");
            });
        });

        document.addEventListener("click", function () {
            document.querySelectorAll(".lang-selector.open").forEach(function (s) { s.classList.remove("open"); });
        });
    }

    /* ────────────────────────────────
       CURRENCY
    ──────────────────────────────── */
    var STORAGE_CURRENCY = "moonly_currency";
    var DEFAULT_CURRENCY = "USD";

    var CURRENCY_META = {
        // ── Norteamérica ──
        USD: { rate: 1,      symbol: "$",   name: "Dólar estadounidense", country: "Estados Unidos", decimals: 2, popular: true },
        CAD: { rate: 1.26,   symbol: "$",   name: "Dólar canadiense",     country: "Canadá",          decimals: 2 },
        MXN: { rate: 18.5,   symbol: "$",   name: "Peso mexicano",        country: "México",          decimals: 2, popular: true },

        // ── LATAM ──
        CLP: { rate: 890,    symbol: "$",   name: "Peso chileno",         country: "Chile",           decimals: 0, popular: true },
        ARS: { rate: 1420,   symbol: "$",   name: "Peso argentino",       country: "Argentina",       decimals: 0, popular: true },
        COP: { rate: 3600,   symbol: "$",   name: "Peso colombiano",      country: "Colombia",        decimals: 0, popular: true },
        PEN: { rate: 3.6,    symbol: "S/",  name: "Sol peruano",          country: "Perú",            decimals: 2, popular: true },
        BRL: { rate: 5.2,    symbol: "R$",  name: "Real brasileño",       country: "Brasil",          decimals: 2, popular: true },
        UYU: { rate: 39.75,  symbol: "$",   name: "Peso uruguayo",        country: "Uruguay",         decimals: 2 },
        BOB: { rate: 6.75,   symbol: "Bs",  name: "Boliviano",            country: "Bolivia",         decimals: 2 },
        PYG: { rate: 6010,   symbol: "₲",   name: "Guaraní paraguayo",    country: "Paraguay",        decimals: 0 },
        GTQ: { rate: 7.6,    symbol: "Q",   name: "Quetzal guatemalteco", country: "Guatemala",       decimals: 2 },
        HNL: { rate: 26.73,  symbol: "L",   name: "Lempira hondureña",    country: "Honduras",        decimals: 2 },
        NIO: { rate: 36.62,  symbol: "C$",  name: "Córdoba nicaragüense", country: "Nicaragua",       decimals: 2 },
        CRC: { rate: 510,    symbol: "₡",   name: "Colón costarricense",  country: "Costa Rica",      decimals: 0 },
        DOP: { rate: 57.73,  symbol: "RD$", name: "Peso dominicano",      country: "República Dominicana", decimals: 2 },
        PAB: { rate: 1,      symbol: "B/.", name: "Balboa panameño",      country: "Panamá",          decimals: 2 },
        VES: { rate: 593,    symbol: "Bs",  name: "Bolívar venezolano",   country: "Venezuela",       decimals: 2, popular: true },

        // ── Europa ──
        EUR: { rate: 0.867,  symbol: "€",   name: "Euro",                 country: "España / Eurozona", decimals: 2, popular: true },
        GBP: { rate: 0.72,   symbol: "£",   name: "Libra esterlina",      country: "Reino Unido",     decimals: 2 },
        CHF: { rate: 0.91,   symbol: "CHF", name: "Franco suizo",         country: "Suiza",           decimals: 2 },
        SEK: { rate: 10.5,   symbol: "kr",  name: "Corona sueca",         country: "Suecia",          decimals: 2 },
        NOK: { rate: 10.8,   symbol: "kr",  name: "Corona noruega",       country: "Noruega",         decimals: 2 },
        DKK: { rate: 6.85,   symbol: "kr",  name: "Corona danesa",        country: "Dinamarca",       decimals: 2 },
        PLN: { rate: 4.0,    symbol: "zł",  name: "Złoty polaco",         country: "Polonia",         decimals: 2 }
    };

    var SUPPORTED_CURRENCIES = Object.keys(CURRENCY_META);
    var POPULAR_CURRENCIES = SUPPORTED_CURRENCIES.filter(function (c) { return CURRENCY_META[c].popular; });

    var COUNTRY_TO_CURRENCY = {
        US: "USD", PR: "USD", CA: "CAD", MX: "MXN",
        CL: "CLP", AR: "ARS", CO: "COP", PE: "PEN", BR: "BRL",
        UY: "UYU", BO: "BOB", PY: "PYG", GT: "GTQ", HN: "HNL",
        NI: "NIO", CR: "CRC", DO: "DOP", PA: "PAB", VE: "VES",
        EC: "USD", SV: "USD",
        ES: "EUR", DE: "EUR", FR: "EUR", IT: "EUR", PT: "EUR",
        NL: "EUR", BE: "EUR", AT: "EUR", IE: "EUR", FI: "EUR",
        GR: "EUR", LU: "EUR", SI: "EUR", SK: "EUR", LT: "EUR",
        LV: "EUR", EE: "EUR", CY: "EUR", MT: "EUR", HR: "EUR",
        GB: "GBP", CH: "CHF", SE: "SEK", NO: "NOK", DK: "DKK", PL: "PLN"
    };

    var TIMEZONE_TO_CURRENCY = {
        "America/Santiago": "CLP",
        "America/Buenos_Aires": "ARS", "America/Argentina/Buenos_Aires": "ARS", "America/Cordoba": "ARS",
        "America/Bogota": "COP",
        "America/Lima": "PEN",
        "America/Sao_Paulo": "BRL", "America/Manaus": "BRL", "America/Recife": "BRL", "America/Fortaleza": "BRL",
        "America/Mexico_City": "MXN", "America/Tijuana": "MXN", "America/Monterrey": "MXN", "America/Cancun": "MXN",
        "America/Montevideo": "UYU",
        "America/La_Paz": "BOB",
        "America/Asuncion": "PYG",
        "America/Guatemala": "GTQ",
        "America/Tegucigalpa": "HNL",
        "America/Managua": "NIO",
        "America/Costa_Rica": "CRC",
        "America/Santo_Domingo": "DOP",
        "America/Panama": "PAB",
        "America/Caracas": "VES",
        "America/Guayaquil": "USD", "America/El_Salvador": "USD",
        "America/New_York": "USD", "America/Chicago": "USD", "America/Denver": "USD",
        "America/Los_Angeles": "USD", "America/Phoenix": "USD", "America/Anchorage": "USD",
        "America/Toronto": "CAD", "America/Vancouver": "CAD", "America/Edmonton": "CAD", "America/Winnipeg": "CAD",
        "Europe/Madrid": "EUR", "Europe/Berlin": "EUR", "Europe/Paris": "EUR", "Europe/Rome": "EUR",
        "Europe/Lisbon": "EUR", "Europe/Amsterdam": "EUR", "Europe/Brussels": "EUR", "Europe/Vienna": "EUR",
        "Europe/Dublin": "EUR", "Europe/Helsinki": "EUR", "Europe/Athens": "EUR",
        "Europe/London": "GBP",
        "Europe/Zurich": "CHF",
        "Europe/Stockholm": "SEK",
        "Europe/Oslo": "NOK",
        "Europe/Copenhagen": "DKK",
        "Europe/Warsaw": "PLN"
    };

    function detectCurrencyFromLocale() {
        try {
            var tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
            if (tz && TIMEZONE_TO_CURRENCY[tz]) return TIMEZONE_TO_CURRENCY[tz];
        } catch (e) {}

        var locales = (navigator.languages && navigator.languages.length ? navigator.languages : [navigator.language || ""]);
        for (var i = 0; i < locales.length; i++) {
            var parts = (locales[i] || "").split(/[-_]/);
            var region = parts.length > 1 ? parts[1].toUpperCase() : "";
            if (region && COUNTRY_TO_CURRENCY[region]) return COUNTRY_TO_CURRENCY[region];
        }

        return "USD";
    }

    var GEOIP_CACHE_KEY = "moonly_geoip_country";

    function detectCurrencyViaGeoIP(callback) {
        var cachedCountry = sessionStorage.getItem(GEOIP_CACHE_KEY);
        if (cachedCountry) {
            callback(COUNTRY_TO_CURRENCY[cachedCountry] || null);
            return;
        }
        if (!window.fetch) { callback(null); return; }

        var timedOut = false;
        var timer = setTimeout(function () { timedOut = true; callback(null); }, 3000);

        fetch("https://ipapi.co/json/")
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (timedOut) return;
                clearTimeout(timer);
                var country = data && data.country ? data.country : null;
                if (country) sessionStorage.setItem(GEOIP_CACHE_KEY, country);
                callback(country ? (COUNTRY_TO_CURRENCY[country] || null) : null);
            })
            .catch(function () {
                if (timedOut) return;
                clearTimeout(timer);
                callback(null);
            });
    }

    var lastAppliedCurrency = null;

    function getPreferredCurrency() {
        if (lastAppliedCurrency) return lastAppliedCurrency;
        var sessionChoice = sessionStorage.getItem(STORAGE_CURRENCY);
        if (sessionChoice && SUPPORTED_CURRENCIES.indexOf(sessionChoice) !== -1) return sessionChoice;
        return detectCurrencyFromLocale();
    }

    function formatCurrency(usdAmount, code) {
        var meta = CURRENCY_META[code] || CURRENCY_META[DEFAULT_CURRENCY];
        var converted = usdAmount * meta.rate;
        var formatted = converted.toLocaleString("es-CL", {
            minimumFractionDigits: meta.decimals,
            maximumFractionDigits: meta.decimals
        });
        return meta.symbol + formatted + (code !== "USD" ? " " + code : "");
    }

    function symbolFor(code) {
        var meta = CURRENCY_META[code] || CURRENCY_META[DEFAULT_CURRENCY];
        return meta.symbol;
    }

    function refreshCurrencyDisplays(code) {
        document.querySelectorAll("[data-usd]").forEach(function (el) {
            var usd = parseFloat(el.getAttribute("data-usd"));
            if (isNaN(usd)) return;
            el.textContent = formatCurrency(usd, code);
        });
    }

    function applyCurrency(code, animate, isManualChoice) {
        if (SUPPORTED_CURRENCIES.indexOf(code) === -1) code = DEFAULT_CURRENCY;

        if (animate) {
            document.documentElement.classList.add("theme-transition");
            window.setTimeout(function () { document.documentElement.classList.remove("theme-transition"); }, 300);
        }

        lastAppliedCurrency = code;

        if (isManualChoice) sessionStorage.setItem(STORAGE_CURRENCY, code);

        document.querySelectorAll(".currency-toggle .current-currency").forEach(function (el) {
            el.textContent = code;
        });
        document.querySelectorAll(".currency-option").forEach(function (opt) {
            opt.classList.toggle("active", opt.getAttribute("data-currency") === code);
        });

        refreshCurrencyDisplays(code);
        document.dispatchEvent(new CustomEvent("moonly:currencychange", { detail: { currency: code } }));
    }

    function makeCurrencyOptionEl(code) {
        var opt = document.createElement("div");
        opt.className = "currency-option";
        opt.setAttribute("data-currency", code);
        opt.setAttribute("role", "option");
        opt.innerHTML =
            '<span class="code">' + code + "</span>" +
            '<span class="name">' + CURRENCY_META[code].name + '<small class="currency-country">' + CURRENCY_META[code].country + "</small></span>" +
            '<i class="fa-solid fa-check check"></i>';
        return opt;
    }

    function buildCurrencyMenuIfNeeded() {
        document.querySelectorAll(".currency-selector-ctrl").forEach(function (selector) {
            var menu = selector.querySelector(".currency-menu");
            if (!menu || menu.getAttribute("data-built") === "1") return;
            menu.setAttribute("data-built", "1");

            var searchWrap = document.createElement("div");
            searchWrap.className = "currency-search-wrap";
            searchWrap.innerHTML = '<i class="fa-solid fa-magnifying-glass"></i><input type="text" class="currency-search" placeholder="Buscar país o moneda…">';
            menu.appendChild(searchWrap);

            var listEl = document.createElement("div");
            listEl.className = "currency-list";
            menu.appendChild(listEl);

            var emptyEl = document.createElement("div");
            emptyEl.className = "currency-empty";
            emptyEl.textContent = "Sin resultados";
            emptyEl.style.display = "none";
            menu.appendChild(emptyEl);

            POPULAR_CURRENCIES.forEach(function (code) {
                listEl.appendChild(makeCurrencyOptionEl(code));
            });

            var searchInput = searchWrap.querySelector(".currency-search");
            searchInput.addEventListener("input", function () {
                var q = searchInput.value.trim().toLowerCase();
                listEl.innerHTML = "";

                var matches;
                if (!q) {
                    matches = POPULAR_CURRENCIES;
                } else {
                    matches = SUPPORTED_CURRENCIES.filter(function (code) {
                        var meta = CURRENCY_META[code];
                        return code.toLowerCase().indexOf(q) !== -1 ||
                            meta.name.toLowerCase().indexOf(q) !== -1 ||
                            meta.country.toLowerCase().indexOf(q) !== -1;
                    });
                }

                emptyEl.style.display = matches.length ? "none" : "block";
                var currentCode = getPreferredCurrency();
                matches.forEach(function (code) {
                    var el = makeCurrencyOptionEl(code);
                    el.classList.toggle("active", code === currentCode);
                    listEl.appendChild(el);
                });
            });

            searchInput.addEventListener("click", function (e) { e.stopPropagation(); });
            searchInput.addEventListener("keydown", function (e) { e.stopPropagation(); });
        });
    }

    function initCurrency() {
        try {
            localStorage.removeItem(STORAGE_CURRENCY);
            localStorage.removeItem(STORAGE_CURRENCY + "_manual_override");
            localStorage.removeItem(GEOIP_CACHE_KEY);
        } catch (e) {}

        buildCurrencyMenuIfNeeded();

        var hasManualChoiceThisSession = !!sessionStorage.getItem(STORAGE_CURRENCY);
        applyCurrency(getPreferredCurrency(), false, false);

        if (!hasManualChoiceThisSession) {
            detectCurrencyViaGeoIP(function (geoCurrency) {
                if (geoCurrency && !sessionStorage.getItem(STORAGE_CURRENCY)) {
                    applyCurrency(geoCurrency, true, false);
                }
            });
        }

        document.querySelectorAll(".currency-selector-ctrl").forEach(function (selector) {
            var toggle = selector.querySelector(".currency-toggle");
            if (toggle) {
                toggle.addEventListener("click", function (e) {
                    e.stopPropagation();
                    var willOpen = !selector.classList.contains("open");
                    document.querySelectorAll(".currency-selector-ctrl.open").forEach(function (s) { s.classList.remove("open"); });
                    if (willOpen) {
                        selector.classList.add("open");
                        var input = selector.querySelector(".currency-search");
                        if (input) { input.value = ""; input.dispatchEvent(new Event("input")); setTimeout(function () { input.focus(); }, 50); }
                    }
                });
            }
            selector.addEventListener("click", function (e) {
                var opt = e.target.closest(".currency-option");
                if (!opt) return;
                applyCurrency(opt.getAttribute("data-currency"), true, true);
                selector.classList.remove("open");
            });
        });

        document.addEventListener("click", function () {
            document.querySelectorAll(".currency-selector-ctrl.open").forEach(function (s) { s.classList.remove("open"); });
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        initTheme();
        initLang();
        initCurrency();
    });

    window.MoonlyI18n = { t: t, getLang: getPreferredLang, applyLang: applyLang };
    window.MoonlyTheme = { applyTheme: applyTheme, getTheme: getPreferredTheme };
    window.MoonlyCurrency = {
        format: formatCurrency,
        getCurrency: getPreferredCurrency,
        applyCurrency: applyCurrency,
        refresh: refreshCurrencyDisplays,
        symbolFor: symbolFor,
        convert: function (usdAmount, code) {
            var meta = CURRENCY_META[code] || CURRENCY_META[DEFAULT_CURRENCY];
            return usdAmount * meta.rate;
        },
        decimalsFor: function (code) {
            var meta = CURRENCY_META[code] || CURRENCY_META[DEFAULT_CURRENCY];
            return meta.decimals;
        }
    };
})();
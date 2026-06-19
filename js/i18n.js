/* =============================================
   MOONLY — I18N.JS
   Motor de traducción. Requiere i18n-dict.js cargado antes.
   ============================================= */
(function () {
    'use strict';

    var STORAGE_KEY    = 'moonly_lang';
    var SUPPORTED      = ['es', 'en'];
    var DEFAULT        = 'es';

    var LANG_META = {
        es: { flag: '🇪🇸', label: 'Español' },
        en: { flag: '🇺🇸', label: 'English' }
    };

    /* ── Detectar idioma preferido ── */
    function detectBrowser() {
        var nav = (navigator.language || navigator.userLanguage || 'es').toLowerCase();
        if (nav.indexOf('en') === 0) return 'en';
        return 'es';
    }

    function getPreferred() {
        var saved = localStorage.getItem(STORAGE_KEY);
        if (saved && SUPPORTED.indexOf(saved) !== -1) return saved;
        return detectBrowser();
    }

    /* ── Traducir una clave ── */
    function t(key, lang) {
        var dict  = window.MOONLY_I18N || {};
        /* Orden de búsqueda: idioma activo → common → idioma por defecto */
        var table = dict[lang] || {};
        if (table[key] !== undefined) return table[key];
        if (dict.common && dict.common[key] !== undefined) return dict.common[key];
        var def = dict[DEFAULT] || {};
        return def[key];
    }

    /* ── Aplicar idioma al DOM ── */
    function apply(lang, animate) {
        if (SUPPORTED.indexOf(lang) === -1) lang = DEFAULT;

        if (animate) {
            document.documentElement.classList.add('theme-transition');
            setTimeout(function () { document.documentElement.classList.remove('theme-transition'); }, 300);
        }

        document.documentElement.setAttribute('lang', lang);
        localStorage.setItem(STORAGE_KEY, lang);

        /* data-i18n → textContent */
        document.querySelectorAll('[data-i18n]').forEach(function (el) {
            var val = t(el.getAttribute('data-i18n'), lang);
            if (val !== undefined) el.textContent = val;
        });

        /* data-i18n-html → innerHTML (para claves con <strong>, <a>, etc.) */
        document.querySelectorAll('[data-i18n-html]').forEach(function (el) {
            var val = t(el.getAttribute('data-i18n-html'), lang);
            if (val !== undefined) el.innerHTML = val;
        });

        /* data-i18n-attr → atributos (placeholder, aria-label, etc.) */
        document.querySelectorAll('[data-i18n-attr]').forEach(function (el) {
            el.getAttribute('data-i18n-attr').split(';').forEach(function (pair) {
                var parts = pair.split(':');
                if (parts.length !== 2) return;
                var val = t(parts[1].trim(), lang);
                if (val !== undefined) el.setAttribute(parts[0].trim(), val);
            });
        });

        /* Actualizar selector de idioma en el navbar */
        document.querySelectorAll('.lang-toggle .current-flag').forEach(function (el) {
            el.textContent = LANG_META[lang].flag;
        });
        document.querySelectorAll('.lang-option').forEach(function (opt) {
            opt.classList.toggle('active', opt.getAttribute('data-lang') === lang);
        });

        document.dispatchEvent(new CustomEvent('moonly:langchange', { detail: { lang: lang } }));
    }

    /* ── Construir menú de idiomas ── */
    function buildMenu() {
        document.querySelectorAll('.lang-selector').forEach(function (selector) {
            var menu = selector.querySelector('.lang-menu');
            if (!menu || menu.children.length > 0) return;

            SUPPORTED.forEach(function (code) {
                var opt = document.createElement('div');
                opt.className = 'lang-option';
                opt.setAttribute('data-lang', code);
                opt.setAttribute('role', 'option');
                opt.innerHTML =
                    '<span class="flag">' + LANG_META[code].flag + '</span>' +
                    '<span>' + LANG_META[code].label + '</span>' +
                    '<i class="fa-solid fa-check check"></i>';
                menu.appendChild(opt);
            });
        });
    }

    /* ── Inicializar ── */
    function init() {
        buildMenu();
        apply(getPreferred(), false);

        document.querySelectorAll('.lang-selector').forEach(function (selector) {
            var toggle = selector.querySelector('.lang-toggle');
            if (toggle) {
                toggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var willOpen = !selector.classList.contains('open');
                    document.querySelectorAll('.lang-selector.open').forEach(function (s) {
                        s.classList.remove('open');
                    });
                    if (willOpen) selector.classList.add('open');
                });
            }

            selector.addEventListener('click', function (e) {
                var opt = e.target.closest('.lang-option');
                if (!opt) return;
                apply(opt.getAttribute('data-lang'), true);
                selector.classList.remove('open');
            });
        });

        document.addEventListener('click', function () {
            document.querySelectorAll('.lang-selector.open').forEach(function (s) {
                s.classList.remove('open');
            });
        });
    }

    /* ── API pública ── */
    window.MoonlyI18n = { t: t, getLang: getPreferred, apply: apply };

    document.addEventListener('DOMContentLoaded', init);

})();
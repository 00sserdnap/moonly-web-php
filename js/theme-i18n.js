/* =============================================
   MOONLY — THEME.JS
   Solo maneja dark / light mode.
   ============================================= */
(function () {
    'use strict';

    var STORAGE_KEY = 'moonly_theme';

    function getPreferred() {
        var saved = localStorage.getItem(STORAGE_KEY);
        if (saved === 'dark' || saved === 'light') return saved;
        return (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches)
            ? 'light' : 'dark';
    }

    function apply(theme, animate) {
        var root = document.documentElement;
        if (animate) {
            root.classList.add('theme-transition');
            setTimeout(function () { root.classList.remove('theme-transition'); }, 300);
        }
        root.setAttribute('data-theme', theme);
        localStorage.setItem(STORAGE_KEY, theme);

        var meta = document.querySelector('meta[name="theme-color"]');
        if (meta) meta.setAttribute('content', theme === 'light' ? '#f4f7fb' : '#080b12');

        document.querySelectorAll('.theme-toggle').forEach(function (btn) {
            btn.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
        });
    }

    function init() {
        apply(getPreferred(), false);

        document.querySelectorAll('.theme-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var current = document.documentElement.getAttribute('data-theme') || 'dark';
                apply(current === 'dark' ? 'light' : 'dark', true);
            });
        });
    }

    /* Exponer para uso externo si se necesita */
    window.MoonlyTheme = { apply: apply, getPreferred: getPreferred };

    document.addEventListener('DOMContentLoaded', init);

})();
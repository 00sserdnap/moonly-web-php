/* =============================================
   MOONLY — THEME.JS
   Maneja dark / light mode.
   El script inline en header.php aplica el tema
   antes del primer paint. Este archivo registra
   el evento del botón cuando el DOM está listo.
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

        /* Meta theme-color (barra del navegador en móvil) */
        var meta = document.querySelector('meta[name="theme-color"]');
        if (meta) meta.setAttribute('content', theme === 'light' ? '#f4f7fb' : '#080b12');

        /* Actualizar aria-pressed en todos los botones de toggle */
        document.querySelectorAll('.theme-toggle').forEach(function (btn) {
            btn.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
        });
    }

    function attachToggle() {
        document.querySelectorAll('.theme-toggle').forEach(function (btn) {
            /* Evitar duplicar el listener si se llama dos veces */
            if (btn.dataset.themeReady) return;
            btn.dataset.themeReady = '1';

            btn.addEventListener('click', function () {
                var current = document.documentElement.getAttribute('data-theme') || 'dark';
                apply(current === 'dark' ? 'light' : 'dark', true);
            });
        });

        /* Aplicar el tema correcto al botón (por si el inline no lo hizo) */
        apply(getPreferred(), false);
    }

    /* Exponer API pública */
    window.MoonlyTheme = { apply: apply, getPreferred: getPreferred };

    /* Registrar el listener tan pronto como el DOM esté listo */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', attachToggle);
    } else {
        /* El script cargó después del DOMContentLoaded (defer/async) */
        attachToggle();
    }

})();

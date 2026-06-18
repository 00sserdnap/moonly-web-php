/* =============================================
   MOONLY — TÉRMINOS (terminos.js)
   1. Scroll-spy: resalta el artículo activo en el TOC.
   2. Aplica data-i18n-html al cargar y en cada cambio
      de idioma — funciona como fallback si theme-i18n.js
      no tiene soporte nativo para data-i18n-html.
   ============================================= */
document.addEventListener("DOMContentLoaded", function () {

    /* ── 1. SCROLL-SPY ── */
    var tocLinks = Array.prototype.slice.call(document.querySelectorAll(".legal-toc-list a"));
    var articles = Array.prototype.slice.call(document.querySelectorAll(".legal-article"));

    if (tocLinks.length && articles.length) {
        function setActive(id) {
            tocLinks.forEach(function (link) {
                link.classList.toggle("active", link.getAttribute("href") === "#" + id);
            });
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) setActive(entry.target.id);
            });
        }, { rootMargin: "-20% 0px -70% 0px", threshold: 0 });

        articles.forEach(function (a) { observer.observe(a); });
        setActive(articles[0].id);

        tocLinks.forEach(function (link) {
            link.addEventListener("click", function () {
                setActive(this.getAttribute("href").replace("#", ""));
            });
        });
    }

    /* ── 2. DATA-I18N-HTML ──
       Aplica innerHTML desde el diccionario para los elementos con
       data-i18n-html. Corre al cargar y cada vez que cambia el idioma. */
    function applyHtmlTranslations() {
        if (!window.MoonlyI18n) return;
        var lang = window.MoonlyI18n.getLang();
        document.querySelectorAll("[data-i18n-html]").forEach(function (el) {
            var key = el.getAttribute("data-i18n-html");
            var val = window.MoonlyI18n.t(key, lang);
            if (val !== undefined && val !== null) el.innerHTML = val;
        });
    }

    /* Esperar a que MoonlyI18n esté disponible (theme-i18n.js corre antes,
       pero por si acaso lo reintentamos tras un tick) */
    if (window.MoonlyI18n) {
        applyHtmlTranslations();
    } else {
        setTimeout(applyHtmlTranslations, 50);
    }

    /* Re-aplicar en cada cambio de idioma */
    document.addEventListener("moonly:langchange", applyHtmlTranslations);
});
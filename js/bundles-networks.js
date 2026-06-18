/* =============================================
   MOONLY — NETWORK PACKS (bundles-networks.js)
   Maneja la tarjeta expandible, el switch Solo Config /
   Config + Host, el selector de RAM, y el recálculo de
   precio (con soporte de conversión de moneda global).
   ============================================= */
document.addEventListener("DOMContentLoaded", function () {

    /* RAM disponible para la modalidad "Config + Host" y su precio mensual
       (mismo $1.70 USD/GB que usa planes.js para Minecraft). */
    var PRICE_PER_GB_USD = 1.70;
    var RAM_OPTIONS = [2, 4];

    var PACKS = {
        lobby: { configUsd: 10.00 },
        survival: { configUsd: 30.00 }
    };

    function t(key) {
        if (window.MoonlyI18n && typeof window.MoonlyI18n.t === "function") {
            var lang = window.MoonlyI18n.getLang();
            var val = window.MoonlyI18n.t(key, lang);
            if (val !== undefined) return val;
        }
        return key;
    }

    function formatUsdInline(usd) {
        if (window.MoonlyCurrency && typeof window.MoonlyCurrency.format === "function") {
            var code = window.MoonlyCurrency.getCurrency();
            return window.MoonlyCurrency.format(usd, code);
        }
        return "$" + usd.toFixed(2);
    }

    var cards = document.querySelectorAll(".np-card");

    cards.forEach(function (card) {
        var packKey = card.getAttribute("data-pack");
        var pack = PACKS[packKey];
        if (!pack) return;

        var state = { mode: "config", ram: RAM_OPTIONS[0] };

        var modeOptions = card.querySelectorAll(".np-mode-option");
        var ramSelect = card.querySelector(".np-ram-select");
        var ramOptions = card.querySelectorAll(".np-ram-option");
        var priceTotal = card.querySelector(".np-price-total");
        var priceSub = card.querySelector(".np-price-sub");
        var cardPriceTag = card.querySelector(".np-card-price-tag");

        function renderRamOptions() {
            ramOptions.forEach(function (opt) {
                var gb = parseInt(opt.getAttribute("data-gb"), 10);
                var monthlyUsd = gb * PRICE_PER_GB_USD;
                opt.querySelector(".np-ram-option-price").textContent = formatUsdInline(monthlyUsd) + "/" + t("np.per_month_short");
                opt.classList.toggle("active", gb === state.ram);
            });
        }

        function renderPrice() {
            if (state.mode === "config") {
                priceTotal.textContent = formatUsdInline(pack.configUsd);
                priceSub.textContent = t("np.one_time_payment");
            } else {
                var monthlyUsd = state.ram * PRICE_PER_GB_USD;
                priceTotal.textContent = formatUsdInline(pack.configUsd) + " + " + formatUsdInline(monthlyUsd) + "/" + t("np.per_month_short");
                priceSub.textContent = t("np.config_plus_host_sub");
            }
            ramSelect.classList.toggle("visible", state.mode === "host");
        }

        modeOptions.forEach(function (opt) {
            opt.addEventListener("click", function () {
                modeOptions.forEach(function (o) { o.classList.remove("active"); });
                opt.classList.add("active");
                state.mode = opt.getAttribute("data-mode");
                renderPrice();
            });
        });

        ramOptions.forEach(function (opt) {
            opt.addEventListener("click", function () {
                state.ram = parseInt(opt.getAttribute("data-gb"), 10);
                renderRamOptions();
                renderPrice();
            });
        });

        /* Click en la portada (header de la tarjeta) abre/cierra el panel */
        var coverToggle = card.querySelector(".np-card-cover");
        coverToggle.addEventListener("click", function () {
            var isOpen = card.classList.contains("open");
            cards.forEach(function (c) { c.classList.remove("open"); });
            if (!isOpen) card.classList.add("open");
        });

        if (cardPriceTag) cardPriceTag.textContent = formatUsdInline(pack.configUsd);
        renderRamOptions();
        renderPrice();

        /* Re-render al cambiar idioma o moneda */
        document.addEventListener("moonly:langchange", function () { renderRamOptions(); renderPrice(); });
        document.addEventListener("moonly:currencychange", function () {
            renderRamOptions();
            renderPrice();
            if (cardPriceTag) cardPriceTag.textContent = formatUsdInline(pack.configUsd);
        });
    });

});
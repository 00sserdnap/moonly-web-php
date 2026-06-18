/* =============================================
   MOONLY — PLANES MINECRAFT (planes.js)
   Genera las tarjetas de planes según duración (1/3/6 meses)
   y se sincroniza con el selector de moneda global.
   ============================================= */
document.addEventListener("DOMContentLoaded", function () {

    var PRICE_PER_GB_USD = 1.70;

    /* Descuento por pago adelantado. 1 mes no tiene descuento. */
    var DURATION_DISCOUNT = { 1: 0, 3: 0.05, 6: 0.10 };

    /* RAM, vCPU, almacenamiento, jugadores y nombre — valores típicos de hosting Minecraft.
       splitter: true a partir de 16GB. */
    var PLANS = [
        { ram: 2,  name: "Pebble",    cpu: "100%", storage: "10 GB",  players: "10" },
        { ram: 4,  name: "Cobble",    cpu: "150%", storage: "20 GB",  players: "20" },
        { ram: 6,  name: "Granite",   cpu: "200%", storage: "30 GB",  players: "35" },
        { ram: 8,  name: "Bedrock",   cpu: "250%", storage: "40 GB",  players: "50",  popular: true },
        { ram: 12, name: "Obsidian",  cpu: "300%", storage: "60 GB",  players: "75" },
        { ram: 16, name: "Emerald",   cpu: "350%", storage: "80 GB",  players: "100", splitter: true },
        { ram: 24, name: "Netherite", cpu: "400%", storage: "120 GB", players: "150", splitter: true },
        { ram: 32, name: "Eclipse",   cpu: "450%", storage: "160 GB", players: "Ilimitado", splitter: true }
    ];

    var grid = document.getElementById("plans-grid");
    var switchEl = document.getElementById("duration-switch");
    if (!grid || !switchEl) return;

    var currentMonths = 1;

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

    function playersLabel(plan) {
        if (plan.players === "Ilimitado") return t("plans.feat_unlimited_players");
        return plan.players + " " + t("plans.players_label").toLowerCase();
    }

    function renderCards() {
        grid.innerHTML = "";
        var discount = DURATION_DISCOUNT[currentMonths] || 0;

        PLANS.forEach(function (plan) {
            var monthlyUsd = plan.ram * PRICE_PER_GB_USD;
            var totalNoDiscountUsd = monthlyUsd * currentMonths;
            var totalUsd = totalNoDiscountUsd * (1 - discount);
            var hasDiscount = discount > 0;

            var card = document.createElement("div");
            card.className = "plan-card" + (plan.popular ? " popular" : "");

            var popularTag = plan.popular
                ? '<span class="plan-popular-tag" data-i18n="plans.popular_tag">' + t("plans.popular_tag") + "</span>"
                : "";

            /* Precio chico de referencia: muestra el total SIN descuento, tachado, solo si hay descuento activo */
            var originalPriceHtml = hasDiscount
                ? '<span class="plan-price-original" data-usd="' + totalNoDiscountUsd.toFixed(2) + '">' + formatUsdInline(totalNoDiscountUsd) + '</span>'
                : '';

            var discountBadgeHtml = hasDiscount
                ? '<span class="plan-discount-badge">-' + Math.round(discount * 100) + '%</span>'
                : '';

            card.innerHTML =
                popularTag +
                '<div class="plan-name">' + plan.name + '</div>' +
                '<div class="plan-ram">' + plan.ram + ' GB</div>' +
                '<div class="plan-ram-label">' + t("plans.ram_label") + '</div>' +

                '<div class="plan-price-row">' +
                    '<span class="plan-price" data-usd="' + totalUsd.toFixed(2) + '">' + formatUsdInline(totalUsd) + '</span>' +
                    discountBadgeHtml +
                '</div>' +
                '<div class="plan-total-row">' +
                    originalPriceHtml +
                    '<span>' + t("plans.total_label") + ' · ' + t("plans.duration_" + currentMonths) + '</span>' +
                '</div>' +

                '<div class="plan-specs">' +
                    '<div class="plan-spec"><i class="fa-solid fa-microchip"></i> ' + plan.cpu + ' ' + t("plans.cpu_label") + '</div>' +
                    '<div class="plan-spec"><i class="fa-solid fa-hard-drive"></i> ' + plan.storage + ' ' + t("plans.storage_label") + '</div>' +
                    '<div class="plan-spec"><i class="fa-solid fa-users"></i> ' + playersLabel(plan) + '</div>' +
                    (plan.splitter ? '<div class="plan-spec"><i class="fa-solid fa-network-wired"></i> ' + t("plans.feat_splitter") + '</div>' : '') +
                    '<div class="plan-spec"><i class="fa-solid fa-shield-halved"></i> ' + t("plans.feat_ddos") + '</div>' +
                    '<div class="plan-spec"><i class="fa-solid fa-clock-rotate-left"></i> ' + t("plans.feat_backups") + '</div>' +
                    '<div class="plan-spec"><i class="fa-solid fa-gauge"></i> ' + t("plans.feat_panel") + '</div>' +
                '</div>' +

                '<a href="https://billing.moonly.es" target="_blank" class="plan-btn">' +
                    '<i class="fa-solid fa-rocket"></i> ' + t("plans.btn_order") +
                '</a>';

            grid.appendChild(card);
        });
    }

    /* ── Duration switch ── */
    switchEl.querySelectorAll(".duration-option").forEach(function (opt) {
        opt.addEventListener("click", function () {
            switchEl.querySelectorAll(".duration-option").forEach(function (o) { o.classList.remove("active"); });
            opt.classList.add("active");
            currentMonths = parseInt(opt.getAttribute("data-months"), 10) || 1;
            renderCards();
        });
    });

    /* ── Re-render on language or currency change ── */
    document.addEventListener("moonly:langchange", renderCards);
    document.addEventListener("moonly:currencychange", renderCards);

    renderCards();
});
/* =============================================
   MOONLY — PLANES TEAMSPEAK (teamspeak.js)
   Genera las tarjetas de planes basadas en precios fijos.
   ============================================= */
document.addEventListener("DOMContentLoaded", function () {

    var DURATION_DISCOUNT = { 1: 0, 3: 0.05, 6: 0.10 };

    var PLANS = [
        { name: "Whisper",  priceUsd: 1.50, slots: "32",  ram: "256MB" },
        { name: "Voice",    priceUsd: 3.00, slots: "64",  ram: "512MB", popular: true },
        { name: "Channel",  priceUsd: 5.50, slots: "128", ram: "1GB" },
        { name: "Network",  priceUsd: 9.00, slots: "512", ram: "2GB" }
    ];

    var grid = document.getElementById("teamspeak-plans-grid");
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

    function renderCards() {
        grid.innerHTML = "";
        var discount = DURATION_DISCOUNT[currentMonths] || 0;

        PLANS.forEach(function (plan) {
            var totalNoDiscountUsd = plan.priceUsd * currentMonths;
            var totalUsd = totalNoDiscountUsd * (1 - discount);
            var hasDiscount = discount > 0;

            var card = document.createElement("div");
            card.className = "plan-card" + (plan.popular ? " popular" : "");

            if (plan.popular) {
                card.style.borderColor = "#2580c3";
                card.style.boxShadow = "0 0 0 1px #2580c3, 0 16px 36px rgba(37,128,195,.12)";
            }

            var popularTag = plan.popular
                ? '<span class="plan-popular-tag" style="background: #2580c3; color: #fff; box-shadow: 0 6px 16px rgba(37,128,195,.4);">' + t("plans.popular_tag") + '</span>'
                : "";

            var originalPriceHtml = hasDiscount
                ? '<span class="plan-price-original" data-usd="' + totalNoDiscountUsd.toFixed(2) + '">' + formatUsdInline(totalNoDiscountUsd) + '</span>'
                : '';

            var discountBadgeHtml = hasDiscount
                ? '<span class="plan-discount-badge">-' + Math.round(discount * 100) + '%</span>'
                : '';

            card.innerHTML =
                popularTag +
                '<div class="plan-name" style="color: #2580c3; font-size: 1.1rem;">' + plan.name + '</div>' +
                '<div class="plan-price-row" style="margin-top: 15px;">' +
                '<span class="plan-price" style="color:#2580c3;" data-usd="' + totalUsd.toFixed(2) + '">' + formatUsdInline(totalUsd) + '</span>' +
                discountBadgeHtml +
                '</div>' +
                '<div class="plan-total-row" style="margin-bottom: 25px;">' +
                originalPriceHtml +
                '<span>' + t("plans.total_label") + ' · ' + t("plans.duration_" + currentMonths) + '</span>' +
                '</div>' +

                '<div class="plan-specs" style="border-top: 1px solid var(--border-soft); padding-top: 20px;">' +
                '<div class="plan-spec"><i class="fa-solid fa-users" style="color:#2580c3;"></i> <span>' + plan.slots + ' ' + t("teamspeak.feat_slots") + '</span></div>' +
                '<div class="plan-spec"><i class="fa-solid fa-memory" style="color:#2580c3;"></i> <span>' + plan.ram + ' RAM</span></div>' +
                '<div class="plan-spec"><i class="fa-solid fa-shield-halved" style="color:#2580c3;"></i> <span>' + t("plans.feat_ddos") + '</span></div>' +
                '<div class="plan-spec"><i class="fa-solid fa-gauge" style="color:#2580c3;"></i> <span>' + t("teamspeak.feat_lowlatency") + '</span></div>' +
                '</div>' +

                '<a href="https://billing.moonly.es" target="_blank" class="plan-btn" style="background: #2580c3; border-color: #2580c3; color: #fff;">' +
                '<i class="fa-solid fa-rocket"></i> ' + t("plans.btn_order") +
                '</a>';

            grid.appendChild(card);
        });
    }

    switchEl.querySelectorAll(".duration-option").forEach(function (opt) {
        opt.addEventListener("click", function () {
            switchEl.querySelectorAll(".duration-option").forEach(function (o) { o.classList.remove("active"); });
            opt.classList.add("active");
            currentMonths = parseInt(opt.getAttribute("data-months"), 10) || 1;
            renderCards();
        });
    });

    document.addEventListener("moonly:langchange", renderCards);
    document.addEventListener("moonly:currencychange", renderCards);

    renderCards();
});
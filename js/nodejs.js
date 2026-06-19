/* =============================================
   MOONLY — PLANES NODE.JS (nodejs.js)
   ============================================= */
document.addEventListener("DOMContentLoaded", function () {

    var DURATION_DISCOUNT = { 1: 0, 3: 0.05, 6: 0.10 };

    var PLANS = [
        { name: "Module",  priceUsd: 1.50, cpu: "50%",  ram: "512MB", storage: "5GB"  },
        { name: "Server",  priceUsd: 3.00, cpu: "75%",  ram: "1GB",   storage: "15GB", popular: true },
        { name: "Realtime",priceUsd: 6.00, cpu: "150%", ram: "2GB",   storage: "30GB" },
        { name: "Cluster", priceUsd: 12.00, cpu: "300%", ram: "4GB",  storage: "60GB" }
    ];

    var grid = document.getElementById("nodejs-plans-grid");
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
                card.style.borderColor = "#3c873a";
                card.style.boxShadow = "0 0 0 1px #3c873a, 0 16px 36px rgba(60,135,58,.12)";
            }

            var popularTag = plan.popular
                ? '<span class="plan-popular-tag" style="background: #3c873a; color: #fff; box-shadow: 0 6px 16px rgba(60,135,58,.4);">' + t("plans.popular_tag") + '</span>'
                : "";

            var originalPriceHtml = hasDiscount
                ? '<span class="plan-price-original" data-usd="' + totalNoDiscountUsd.toFixed(2) + '">' + formatUsdInline(totalNoDiscountUsd) + '</span>'
                : '';

            var discountBadgeHtml = hasDiscount
                ? '<span class="plan-discount-badge">-' + Math.round(discount * 100) + '%</span>'
                : '';

            card.innerHTML =
                popularTag +
                '<div class="plan-name" style="color: #3c873a; font-size: 1.1rem;">' + plan.name + '</div>' +
                '<div class="plan-price-row" style="margin-top: 15px;">' +
                '<span class="plan-price" style="color:#3c873a;" data-usd="' + totalUsd.toFixed(2) + '">' + formatUsdInline(totalUsd) + '</span>' +
                discountBadgeHtml +
                '</div>' +
                '<div class="plan-total-row" style="margin-bottom: 25px;">' +
                originalPriceHtml +
                '<span>' + t("plans.total_label") + ' · ' + t("plans.duration_" + currentMonths) + '</span>' +
                '</div>' +

                '<div class="plan-specs" style="border-top: 1px solid var(--border-soft); padding-top: 20px;">' +
                '<div class="plan-spec"><i class="fa-solid fa-microchip" style="color:#3c873a;"></i> <span>' + plan.cpu + ' CPU</span></div>' +
                '<div class="plan-spec"><i class="fa-solid fa-memory" style="color:#3c873a;"></i> <span>' + plan.ram + ' RAM</span></div>' +
                '<div class="plan-spec"><i class="fa-solid fa-hard-drive" style="color:#3c873a;"></i> <span>' + plan.storage + ' SSD</span></div>' +
                '<div class="plan-spec"><i class="fa-solid fa-rotate" style="color:#3c873a;"></i> <span>' + t("nodejs.feat_autorestart") + '</span></div>' +
                '</div>' +

                '<a href="https://billing.moonly.es" target="_blank" class="plan-btn" style="background: #3c873a; border-color: #3c873a; color: #fff;">' +
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
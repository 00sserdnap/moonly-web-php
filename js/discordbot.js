/* =============================================
   MOONLY — PLANES DISCORD BOT (discordbot.js)
   Genera las tarjetas de planes basadas en precios fijos.
   ============================================= */
document.addEventListener("DOMContentLoaded", function () {

    /* Descuento por pago adelantado. 1 mes no tiene descuento. */
    var DURATION_DISCOUNT = { 1: 0, 3: 0.05, 6: 0.10 };

    /* Datos extraídos de tu imagen */
    var PLANS = [
        { name: "Basic",     priceUsd: 1.00,  cpu: "50%",  ram: "512MB", storage: "5GB",   bots: "1",  hasIp: false },
        { name: "Advanced",  priceUsd: 2.00,  cpu: "75%",  ram: "1GB",   storage: "15GB",  bots: "1",  hasIp: false },
        { name: "Advanced+", priceUsd: 4.00,  cpu: "110%", ram: "3GB",   storage: "40GB",  bots: "4",  hasIp: false, popular: true },
        { name: "Ultimate",  priceUsd: 10.00, cpu: "300%", ram: "7GB",   storage: "100GB", bots: "13", hasIp: true }
    ];

    var grid = document.getElementById("discord-plans-grid");
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
            
            // Toque estético si es popular (color Discord blurple #5865F2 en vez de cyan)
            if(plan.popular) {
                card.style.borderColor = "#5865F2";
                card.style.boxShadow = "0 0 0 1px #5865F2, 0 16px 36px rgba(88,101,242,.12)";
            }

            var popularTag = plan.popular
                ? '<span class="plan-popular-tag" style="background: #5865F2; color: #fff; box-shadow: 0 6px 16px rgba(88,101,242,.4);" data-i18n="plans.popular_tag">' + t("plans.popular_tag") + '</span>'
                : "";

            var originalPriceHtml = hasDiscount
                ? '<span class="plan-price-original" data-usd="' + totalNoDiscountUsd.toFixed(2) + '">' + formatUsdInline(totalNoDiscountUsd) + '</span>'
                : '';

            var discountBadgeHtml = hasDiscount
                ? '<span class="plan-discount-badge">-' + Math.round(discount * 100) + '%</span>'
                : '';

            // Icono de X o Check para la IP
            var ipIcon = plan.hasIp ? '<i class="fa-solid fa-check" style="color: var(--yellow);"></i>' : '<i class="fa-solid fa-circle-xmark" style="color: var(--muted); opacity: 0.5;"></i>';
            var ipStyle = plan.hasIp ? '' : 'text-decoration: line-through; opacity: 0.5;';

            card.innerHTML =
                popularTag +
                '<div class="plan-name" style="color: #fff; font-size: 1.1rem;">' + plan.name + '</div>' +
                '<div class="plan-price-row" style="margin-top: 15px;">' +
                    '<span class="plan-price" data-usd="' + totalUsd.toFixed(2) + '">' + formatUsdInline(totalUsd) + '</span>' +
                    discountBadgeHtml +
                '</div>' +
                '<div class="plan-total-row" style="margin-bottom: 25px;">' +
                    originalPriceHtml +
                    '<span>Billed Monthly / ' + t("plans.duration_" + currentMonths) + '</span>' +
                '</div>' +

                '<div class="plan-specs" style="border-top: 1px solid var(--border-soft); padding-top: 20px;">' +
                    '<div class="plan-spec"><i class="fa-solid fa-check" style="color: var(--yellow);"></i> <span>' + plan.cpu + ' ' + t("discord.feat_cpu") + '</span></div>' +
                    '<div class="plan-spec"><i class="fa-solid fa-check" style="color: var(--yellow);"></i> <span>' + plan.ram + ' ' + t("discord.feat_ram") + '</span></div>' +
                    '<div class="plan-spec"><i class="fa-solid fa-check" style="color: var(--yellow);"></i> <span>' + plan.storage + ' ' + t("discord.feat_storage") + '</span></div>' +
                    '<div class="plan-spec"><i class="fa-solid fa-check" style="color: var(--yellow);"></i> <span>' + t("discord.feat_support") + '</span></div>' +
                    '<div class="plan-spec"><i class="fa-solid fa-check" style="color: var(--yellow);"></i> <span>' + t("discord.feat_bots") + ' ' + plan.bots + ' ' + t("discord.feat_bots_suffix") + '</span></div>' +
                    '<div class="plan-spec" style="' + ipStyle + '">' + ipIcon + ' <span>' + t("discord.feat_ip") + '</span></div>' +
                '</div>' +

                '<a href="https://billing.moonly.es" target="_blank" class="plan-btn" ' + (plan.popular ? 'style="background: var(--yellow); border-color: var(--yellow); color: #04101a;"' : 'style="background: var(--yellow); color: #04101a;"') + '>' +
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
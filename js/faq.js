/* =============================================
   MOONLY — PREGUNTAS FRECUENTES (faq.js)
   Genera el listado desde un array de datos, maneja
   tabs por categoría, acordeón y búsqueda en vivo.
   ============================================= */
document.addEventListener("DOMContentLoaded", function () {

    var CATEGORIES = [
        { id: "general",   icon: "fa-circle-info",      label: "General" },
        { id: "minecraft", icon: "fa-cubes",             label: "Minecraft" },
        { id: "dedicados", icon: "fa-server",            label: "Cloud Dedicated" },
        { id: "discord",   icon: "fa-brands fa-discord", label: "Discord Bot" },
        { id: "pagos",     icon: "fa-credit-card",       label: "Pagos y Facturación" },
        { id: "soporte",   icon: "fa-headset",           label: "Soporte" }
    ];

    var FAQS = [
        /* ── GENERAL ── */
        { id: "gen_que_es", cat: "general",
          q: "¿Qué es Moonly Hosting?",
          a: "Moonly Hosting es un proveedor de hosting para servidores de juegos, servidores dedicados (bare metal), bots de Discord y otros servicios de alojamiento. Operamos con hardware propio de alto rendimiento para garantizar la mejor experiencia posible para tu comunidad." },
        { id: "gen_ubicacion", cat: "general",
          q: "¿Dónde están ubicados sus servidores?",
          a: "Contamos con nodos disponibles en Chile y Estados Unidos, y servidores dedicados en New York, Miami y Los Angeles. Esto nos permite ofrecer baja latencia tanto para comunidades en LATAM como en Norteamérica." },
        { id: "gen_activacion", cat: "general",
          q: "¿Cuánto tarda la activación de mi servicio?",
          a: "La activación es <strong>inmediata y automática</strong> una vez que el pago es confirmado. En la gran mayoría de los casos no necesitas esperar a que un humano revise nada — tu panel estará listo en minutos." },
        { id: "gen_contrato", cat: "general",
          q: "¿Necesito firmar un contrato o permanencia mínima?",
          a: "No. Todos nuestros planes son sin contratos ni permanencia obligatoria. Pagas por el período que elijas (mensual, trimestral o semestral) y puedes cancelar cuando quieras desde tu área de cliente." },
        { id: "gen_factura", cat: "general",
          q: "¿Emiten boleta o factura?",
          a: "Sí, cada pago genera automáticamente un comprobante disponible en tu área de cliente en <a href=\"https://billing.moonly.es\" target=\"_blank\">billing.moonly.es</a>, que puedes descargar en cualquier momento." },

        /* ── MINECRAFT ── */
        { id: "mc_versiones", cat: "minecraft",
          q: "¿Qué versiones de Minecraft soportan?",
          a: "Soportamos todas las versiones de Minecraft Java Edition, desde las más antiguas hasta la última release, además de servidores Bedrock (PC, consola y móvil) y alojamiento Modded para Forge, Fabric y modpacks personalizados." },
        { id: "mc_jar_propio", cat: "minecraft",
          q: "¿Puedo subir mi propio jar, plugins o modpack?",
          a: "Por supuesto. Tu panel de control te permite subir cualquier archivo .jar, plugin o modpack que quieras usar, además de instalar versiones populares (Paper, Spigot, Forge, Fabric, Purpur) con un clic desde nuestro instalador automático." },
        { id: "mc_ram_que_incluye", cat: "minecraft",
          q: "¿Qué significa pagar 'por GB de RAM'?",
          a: "Nuestros planes de Minecraft cobran un precio fijo por cada GB de RAM — <strong>$1.70 USD por GB al mes</strong>. No hay paquetes cerrados con specs que no necesitas: eliges exactamente cuánta RAM quieres y pagas solo por eso. CPU, almacenamiento y slots escalan junto con la RAM elegida." },
        { id: "mc_cambiar_plan", cat: "minecraft",
          q: "¿Puedo cambiar de plan (subir o bajar RAM) después?",
          a: "Sí, puedes mejorar o reducir tu plan en cualquier momento desde tu área de cliente. Si subes de plan, solo pagas la diferencia prorrateada; el cambio se aplica sin perder tus mundos ni configuraciones." },
        { id: "mc_backups", cat: "minecraft",
          q: "¿Hacen copias de seguridad de mi servidor?",
          a: "Sí. Además de que puedes programar tus propios backups automáticos desde el panel, mantenemos copias periódicas en nodos aislados como parte de nuestro sistema de disaster recovery. Aun así, recomendamos mantener tu propio respaldo adicional para mayor tranquilidad." },
        { id: "mc_ddos", cat: "minecraft",
          q: "¿Mis servidores están protegidos contra ataques DDoS?",
          a: "Todos los planes de Minecraft incluyen protección anti-DDoS activa sin costo adicional, filtrando el tráfico malicioso antes de que llegue a tu servidor." },
        { id: "mc_migracion", cat: "minecraft",
          q: "Tengo un servidor en otro proveedor, ¿pueden migrarlo?",
          a: "Sí, nuestro equipo de soporte puede ayudarte a migrar tu mundo, plugins y configuraciones desde tu hosting actual sin costo adicional. Solo abre un ticket en nuestro Discord con los detalles de tu servidor." },

        /* ── CLOUD DEDICATED ── */
        { id: "ded_que_es", cat: "dedicados",
          q: "¿Qué diferencia hay entre un servidor dedicado y uno compartido?",
          a: "En un servidor dedicado (bare metal), todo el hardware físico es exclusivamente tuyo — no compartes CPU, RAM ni disco con ningún otro cliente. Esto se traduce en rendimiento consistente y predecible, ideal para hosting de alto tráfico, bases de datos exigentes o redes completas de Minecraft." },
        { id: "ded_setup", cat: "dedicados",
          q: "¿Cuánto tarda el despliegue de un servidor dedicado?",
          a: "El despliegue es de aproximadamente <strong>10 minutos</strong> tras confirmar el pago, gracias a nuestro sistema de aprovisionamiento automatizado." },
        { id: "ded_root", cat: "dedicados",
          q: "¿Tengo acceso root completo?",
          a: "Sí, todos los planes de Cloud Dedicated incluyen acceso root total al servidor. Este acceso está sujeto a supervisión periódica de tráfico de entrada/salida para garantizar el cumplimiento de nuestros Términos de Servicio." },
        { id: "ded_bandwidth", cat: "dedicados",
          q: "¿El ancho de banda tiene límite?",
          a: "No. Todos los planes de Cloud Dedicated incluyen 1Gbps de bandwidth sin límite de transferencia mensual." },
        { id: "ded_os", cat: "dedicados",
          q: "¿Puedo elegir el sistema operativo?",
          a: "Sí, puedes solicitar la distribución Linux de tu preferencia (Ubuntu, Debian, CentOS, etc.) o Windows Server según disponibilidad, indicándolo al momento de la activación o a través de un ticket de soporte." },

        /* ── DISCORD BOT ── */
        { id: "db_lenguajes", cat: "discord",
          q: "¿Qué lenguajes de programación soportan para bots de Discord?",
          a: "Soportamos Node.js, Python y Java de forma nativa desde el panel, además de poder configurar otros entornos a solicitud." },
        { id: "db_247", cat: "discord",
          q: "¿Mi bot estará en línea 24/7?",
          a: "Sí, todos los planes de Discord Bot Hosting están diseñados para mantener tu bot en línea de forma continua, con reinicio automático en caso de caída inesperada." },
        { id: "db_cuantos_bots", cat: "discord",
          q: "¿Puedo alojar más de un bot en el mismo plan?",
          a: "Depende del plan elegido: cada plan especifica cuántos bots/slots incluye, desde 1 bot en el plan Basic hasta 13 bots en el plan Ultimate." },
        { id: "db_ip_fija", cat: "discord",
          q: "¿Los planes incluyen IP dedicada?",
          a: "La IP dedicada está disponible únicamente en el plan Ultimate. Los planes inferiores no incluyen esta característica." },

        /* ── PAGOS Y FACTURACIÓN ── */
        { id: "pag_metodos", cat: "pagos",
          q: "¿Qué métodos de pago aceptan?",
          a: "Aceptamos tarjetas de crédito/débito, transferencia y otros métodos disponibles directamente en tu área de cliente en <a href=\"https://billing.moonly.es\" target=\"_blank\">billing.moonly.es</a> al momento de generar tu orden." },
        { id: "pag_impuestos", cat: "pagos",
          q: "¿Los precios mostrados incluyen impuestos?",
          a: "No. Los precios indicados en el sitio no incluyen impuestos adicionales; estos se calculan y aplican automáticamente al momento de generar la factura, según tu ubicación." },
        { id: "pag_vencido", cat: "pagos",
          q: "¿Qué pasa si no pago a tiempo la renovación?",
          a: "Si no recibimos el pago en la fecha de vencimiento, el servicio entra en estado <strong>suspendido</strong> (tus archivos se conservan por 3 días). Si pasan más de 7 días desde el vencimiento sin pago, el servicio se termina y los archivos se eliminan de forma permanente." },
        { id: "pag_reembolso", cat: "pagos",
          q: "¿Ofrecen reembolsos?",
          a: "Para servicios distintos a Minecraft ofrecemos garantía de devolución 100% durante 48 horas. Para Minecraft Hosting, los reembolsos se evalúan caso por caso cuando existe un error atribuible a nosotros. Revisa el detalle en nuestros <a href=\"terminos.php\">Términos de Servicio</a>." },
        { id: "pag_descuentos", cat: "pagos",
          q: "¿Hay descuentos por pagar varios meses por adelantado?",
          a: "Sí. Al elegir 3 meses obtienes descuento, y al elegir 6 meses obtienes el mejor precio total disponible. Puedes ver el ahorro exacto en cada plan al cambiar la duración." },

        /* ── SOPORTE ── */
        { id: "sop_canales", cat: "soporte",
          q: "¿Por dónde puedo contactar a soporte?",
          a: "Nuestro canal principal es <strong>Discord</strong>, donde tenemos un equipo activo respondiendo tickets. También puedes escribirnos por WhatsApp o al correo <a href=\"mailto:soporte@moonly.es\">soporte@moonly.es</a>." },
        { id: "sop_horario", cat: "soporte",
          q: "¿Cuál es el horario de atención?",
          a: "Nuestro equipo de soporte atiende todos los días, con tiempos de respuesta más rápidos en horario diurno (Chile). Para incidentes críticos de servidores activos, monitoreamos la infraestructura de forma continua." },
        { id: "sop_idiomas", cat: "soporte",
          q: "¿Atienden en otros idiomas además de español?",
          a: "Sí, nuestro sitio y soporte están disponibles en español, inglés y portugués." },
        { id: "sop_partners", cat: "soporte",
          q: "Quiero proponer una asociación o alianza comercial, ¿con quién hablo?",
          a: "Para propuestas de partnership, ofertas comerciales o contacto formal, escríbenos directamente a <a href=\"mailto:partners@moonly.es\">partners@moonly.es</a>." }
    ];

    /* ── REFERENCIAS DOM ── */
    var grid       = document.getElementById("faq-wrap");
    var tabsEl     = document.getElementById("faq-tabs");
    var searchEl   = document.getElementById("faq-search");
    var searchWrap = document.getElementById("faq-search-wrap");
    var clearBtn   = document.getElementById("faq-search-clear");
    var metaEl     = document.getElementById("faq-search-meta");

    /* Sin contenedor principal no hay nada que hacer */
    if (!grid || !tabsEl) return;

    var state = { cat: "all", query: "" };

    /* ── HELPERS ── */
    function t(key, fallback) {
        if (window.MoonlyI18n && typeof window.MoonlyI18n.t === "function") {
            var lang = window.MoonlyI18n.getLang();
            var val  = window.MoonlyI18n.t(key, lang);
            if (val !== undefined) return val;
        }
        return fallback;
    }

    function escapeRe(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    function highlight(text, query) {
        if (!query) return text;
        try {
            return text.replace(new RegExp("(" + escapeRe(query) + ")", "ig"),
                "<mark class=\"faq-highlight\">$1</mark>");
        } catch (e) { return text; }
    }

    function catIcon(cat) {
        return cat.icon.indexOf("fa-brands") === 0
            ? cat.icon
            : "fa-solid " + cat.icon;
    }

    function getCatLabel(cat) {
        return t("faq.cat_" + cat.id, cat.label);
    }

    function matches(faq, query) {
        if (!query) return true;
        var qTxt = t("faq." + faq.id + "_q", faq.q);
        var aTxt = t("faq." + faq.id + "_a", faq.a);
        return (qTxt + " " + aTxt).toLowerCase().indexOf(query.toLowerCase()) !== -1;
    }

    /* ── TABS ── */
    function buildTabs() {
        var html = "";

        /* Tab "Todas" */
        html += '<div class="faq-tab' + (state.cat === "all" ? " active" : "") + '" data-cat="all">'
             + '<i class="fa-solid fa-grip"></i> <span>' + t("faq.tab_all", "Todas") + '</span>'
             + '<span class="faq-tab-count">' + FAQS.length + '</span></div>';

        CATEGORIES.forEach(function (cat) {
            var count = FAQS.filter(function (f) { return f.cat === cat.id; }).length;
            html += '<div class="faq-tab' + (state.cat === cat.id ? " active" : "") + '" data-cat="' + cat.id + '">'
                 + '<i class="' + catIcon(cat) + '"></i>'
                 + ' <span>' + getCatLabel(cat) + '</span>'
                 + '<span class="faq-tab-count">' + count + '</span></div>';
        });

        tabsEl.innerHTML = html;

        tabsEl.querySelectorAll(".faq-tab").forEach(function (el) {
            el.addEventListener("click", function () {
                state.cat = this.getAttribute("data-cat");
                buildTabs();
                renderList();
            });
        });
    }

    /* ── RENDER PRINCIPAL ── */
    function renderList() {
        var query = state.query.trim();
        var visible = FAQS.filter(function (f) {
            return (state.cat === "all" || f.cat === state.cat) && matches(f, query);
        });

        grid.innerHTML = "";

        if (visible.length === 0) {
            grid.innerHTML = '<div class="faq-empty">'
                + '<i class="fa-solid fa-magnifying-glass"></i>'
                + '<div class="faq-empty-title">' + t("faq.empty_title", "No encontramos resultados") + '</div>'
                + '<div class="faq-empty-desc">' + t("faq.empty_desc", "Prueba con otras palabras, o contáctanos directamente en Discord.") + '</div>'
                + '</div>';
            updateMeta(0);
            return;
        }

        if (state.cat === "all" && !query) {
            /* Vista "Todas": agrupada por categoría */
            CATEGORIES.forEach(function (cat) {
                var inCat = FAQS.filter(function (f) { return f.cat === cat.id; });
                if (!inCat.length) return;

                var heading = document.createElement("div");
                heading.className = "faq-category-heading";
                heading.innerHTML = '<span class="faq-category-heading-icon"><i class="' + catIcon(cat) + '"></i></span>'
                    + '<span class="faq-category-heading-text">' + getCatLabel(cat) + '</span>';
                grid.appendChild(heading);

                var listEl = document.createElement("div");
                listEl.className = "faq-list";
                inCat.forEach(function (f) { listEl.appendChild(buildItem(f, query)); });
                grid.appendChild(listEl);
            });
        } else {
            /* Vista tab/búsqueda: lista plana */
            var listEl = document.createElement("div");
            listEl.className = "faq-list";
            visible.forEach(function (f) { listEl.appendChild(buildItem(f, query)); });
            grid.appendChild(listEl);
        }

        updateMeta(visible.length);
    }

    /* ── ITEM DE ACORDEÓN ── */
    function buildItem(faq, query) {
        var item = document.createElement("div");
        item.className = "faq-item";

        var qText = t("faq." + faq.id + "_q", faq.q);
        var aText = t("faq." + faq.id + "_a", faq.a);

        item.innerHTML =
            '<div class="faq-question">'
          +   '<span class="faq-question-text">' + highlight(qText, query) + '</span>'
          +   '<span class="faq-question-icon"><i class="fa-solid fa-chevron-down"></i></span>'
          + '</div>'
          + '<div class="faq-answer">'
          +   '<div class="faq-answer-inner"><p>' + highlight(aText, query) + '</p></div>'
          + '</div>';

        item.querySelector(".faq-question").addEventListener("click", function () {
            var isOpen = item.classList.contains("open");
            /* Cierra todos los demás en el mismo listado */
            var siblings = item.parentNode ? item.parentNode.querySelectorAll(".faq-item.open") : [];
            for (var i = 0; i < siblings.length; i++) {
                if (siblings[i] !== item) siblings[i].classList.remove("open");
            }
            item.classList.toggle("open", !isOpen);
        });

        /* Si hay búsqueda, abre automáticamente las coincidencias */
        if (query) item.classList.add("open");

        return item;
    }

    /* ── META DE BÚSQUEDA ── */
    function updateMeta(count) {
        if (!metaEl) return;
        if (!state.query.trim()) { metaEl.innerHTML = ""; return; }
        var tpl = count === 1
            ? t("faq.search_result_one", "<strong>1</strong> resultado encontrado")
            : t("faq.search_result_many", "<strong>{count}</strong> resultados encontrados");
        metaEl.innerHTML = tpl.replace("{count}", count);
    }

    /* ── EVENTOS DE BÚSQUEDA (con guard de null) ── */
    if (searchEl) {
        searchEl.addEventListener("input", function () {
            state.query = this.value;
            if (searchWrap) searchWrap.classList.toggle("has-value", state.query.length > 0);
            renderList();
        });
    }

    if (clearBtn) {
        clearBtn.addEventListener("click", function () {
            state.query = "";
            if (searchEl)   { searchEl.value = ""; searchEl.focus(); }
            if (searchWrap) searchWrap.classList.remove("has-value");
            renderList();
        });
    }

    /* ── Re-render al cambiar idioma ── */
    document.addEventListener("moonly:langchange", function () {
        buildTabs();
        renderList();
    });

    /* ── ARRANQUE ── */
    buildTabs();
    renderList();

});
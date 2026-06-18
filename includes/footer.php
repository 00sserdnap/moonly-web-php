<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?php echo $base_path; ?>index.php" class="logo">
                    <i class="fa-solid fa-moon" style="color:var(--cyan);font-size:1.6rem;"></i>
                    <div class="logo-text"><span class="moonly">MOONLY</span><span class="hosting">HOSTING</span></div>
                </a>
                <p data-i18n="footer.tagline">Calidad y rendimiento estelar al mejor precio. Hosting premium para que tu comunidad crezca sin límites.</p>
            </div>
            <div class="footer-col">
                <h4 data-i18n="footer.services">Servicios</h4>
                <ul>
                    <li><a href="<?php echo $base_path; ?>html/planes.php" data-i18n="footer.service.minecraft">Minecraft Hosting</a></li>
                    <li><a href="<?php echo $base_path; ?>html/dedicados.php" data-i18n="footer.service.dedicated">Cloud Dedicated</a></li>
                    <li><a href="<?php echo $base_path; ?>html/metodos-de-pagos.php" data-i18n="footer.service.payment">Métodos de pago</a></li>
                    <li><a href="<?php echo $base_path; ?>html/terminos.php" data-i18n="footer.service.terms">Términos de servicio</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 data-i18n="footer.support">Soporte</h4>
                <div class="footer-contact">
                    <a href="https://discord.gg/moonly" target="_blank" class="discord">
                        <i class="fa-brands fa-discord"></i> <span data-i18n="nav.discord">Discord</span>
                    </a>
                    <a href="https://wa.me/56900000000" target="_blank" class="whatsapp">
                        <i class="fa-brands fa-whatsapp"></i> <span data-i18n="nav.whatsapp">WhatsApp</span>
                    </a>
                    <a href="mailto:soporte@moonlyhosting.com" class="gmail">
                        <i class="fa-solid fa-envelope"></i> <span data-i18n="nav.email">Email soporte</span>
                    </a>
                </div>
            </div>
            <div class="footer-col">
                <h4 data-i18n="footer.contact_formal">Contacto formal</h4>
                <div class="footer-contact">
                    <a href="mailto:partners@moonlyhosting.com" class="gmail">
                        <i class="fa-brands fa-google"></i> <span data-i18n="footer.partners">Partners / Ofertas</span>
                    </a>
                </div>
                <p style="color:var(--muted);font-size:.78rem;margin-top:14px;line-height:1.55;" data-i18n="footer.partners_desc">Para propuestas de asociación, ofertas comerciales o contacto formal, escribe a partners@moonlyhosting.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p data-i18n="footer.rights">&copy; 2026 Moonly Hosting. Todos los derechos reservados.</p>
            <span><span data-i18n="footer.made_with">Hecho con</span> <i class="fa-solid fa-heart" style="color:var(--cyan);"></i> <span data-i18n="footer.made_with_end">para la comunidad</span></span>
        </div>
    </div>
</footer>

<script src="<?php echo $base_path; ?>js/i18n-dict.js?v=6"></script>
<script src="<?php echo $base_path; ?>js/theme-i18n.js?v=6"></script>
<?php if (isset($extra_js) && $extra_js): ?>
<script src="<?php echo $base_path; ?><?php echo $extra_js; ?>?v=6"></script>
<?php endif; ?>
<script src="<?php echo $base_path; ?>js/main.js?v=6"></script>

<script>
/* ── Carga de imágenes con fallback en cascada de formatos ── */
window.tryNextImg = function (img) {
    var list = (img.getAttribute('data-fallbacks') || '').split(',').filter(Boolean);
    if (list.length === 0) {
        img.onerror = null;
        img.style.display = 'none';
        img.parentElement.style.background = 'linear-gradient(160deg, rgba(20,20,28,.9), rgba(40,40,55,.9))';
        return;
    }
    var next = list.shift();
    img.setAttribute('data-fallbacks', list.join(','));
    img.src = next;
};

/* ── Navbar scroll-hide ── */
(function () {
    var nav = document.querySelector('.navbar');
    if (!nav) return;
    function onScroll() {
        var y = window.scrollY || window.pageYOffset || 0;
        var h = nav.offsetHeight || 120;
        var shift = Math.min(y, h);
        nav.style.transform = 'translateY(-' + shift + 'px)';
        nav.style.pointerEvents = shift >= h - 2 ? 'none' : 'auto';
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll, { passive: true });
    onScroll();
})();

/* ── Mega menús (Minecraft, Soporte): abrir/cerrar con clic ── */
(function () {
    var megaToggles = document.querySelectorAll('.has-mega > .dropdown-toggle');
    
    megaToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function (e) {
            if(window.innerWidth > 980) {
                e.preventDefault();
                var container = this.parentElement;
                
                // Cierra otros mega menús que estén abiertos para que no se superpongan
                document.querySelectorAll('.has-mega.open').forEach(function(other) {
                    if (other !== container) other.classList.remove('open');
                });

                container.classList.toggle('open');
            }
        });
    });

    /* Cerrar al hacer clic fuera */
    document.addEventListener('click', function (e) {
        document.querySelectorAll('.has-mega.open').forEach(function(container) {
            if (!container.contains(e.target)) {
                container.classList.remove('open');
            }
        });
    });
})();

/* ── Menú Móvil (Hamburguesa) ── */
(function() {
    var mobileBtn = document.querySelector('.mobile-menu-btn');
    var navbar = document.querySelector('.navbar');
    
    if(mobileBtn && navbar) {
        mobileBtn.addEventListener('click', function() {
            // Abre/Cierra el menú principal
            navbar.classList.toggle('menu-open');
            
            // Cambia el ícono
            var icon = mobileBtn.querySelector('i');
            if(navbar.classList.contains('menu-open')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            }
        });
    }
    
    // Hace que los menús desplegables funcionen como acordeón en celular
    var dropdownToggles = document.querySelectorAll('.dropdown-container > .dropdown-toggle');
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            if(window.innerWidth <= 980) {
                e.preventDefault();
                var parent = this.parentElement;
                parent.classList.toggle('open');
            }
        });
    });
})();
</script>
</body>
</html>
<footer class="footer">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-brand">
                <a href="<?php echo $base_path; ?>index.php" class="logo">
                    <i class="fa-solid fa-moon" style="color:var(--cyan);font-size:1.6rem;"></i>
                    <div class="logo-text">
                        <span class="moonly">MOONLY</span>
                        <span class="hosting">HOSTING</span>
                    </div>
                </a>
                <p data-i18n="footer.tagline">Calidad y rendimiento estelar al mejor precio.</p>
            </div>

            <div class="footer-col">
                <h4 data-i18n="footer.services">Servicios</h4>
                <ul>
                    <li><a href="<?php echo $base_path; ?>html/planes.php"          data-i18n="footer.service.minecraft">Minecraft Hosting</a></li>
                    <li><a href="<?php echo $base_path; ?>html/dedicados.php"        data-i18n="footer.service.dedicated">Cloud Dedicated</a></li>
                    <li><a href="<?php echo $base_path; ?>html/metodos-de-pagos.php" data-i18n="footer.service.payment">Métodos de pago</a></li>
                    <li><a href="<?php echo $base_path; ?>html/terminos.php"         data-i18n="footer.service.terms">Términos de servicio</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 data-i18n="footer.support">Soporte</h4>
                <div class="footer-contact">
                    <a href="https://discord.gg/moonly" target="_blank" rel="noopener" class="discord">
                        <i class="fa-brands fa-discord"></i>
                        <span data-i18n="nav.discord">Discord</span>
                    </a>
                    <a href="https://wa.me/56900000000" target="_blank" rel="noopener" class="whatsapp">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span data-i18n="nav.whatsapp">WhatsApp</span>
                    </a>
                    <a href="mailto:soporte@moonlyhosting.com" class="gmail">
                        <i class="fa-solid fa-envelope"></i>
                        <span data-i18n="nav.email">Email soporte</span>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4 data-i18n="footer.contact_formal">Contacto formal</h4>
                <div class="footer-contact">
                    <a href="mailto:partners@moonlyhosting.com" class="gmail">
                        <i class="fa-brands fa-google"></i>
                        <span data-i18n="footer.partners">Partners / Ofertas</span>
                    </a>
                </div>
                <p style="color:var(--muted);font-size:.78rem;margin-top:14px;line-height:1.55;"
                   data-i18n="footer.partners_desc">
                    Para propuestas de asociación, ofertas comerciales o contacto formal.
                </p>
            </div>

        </div>

        <div class="footer-bottom">
            <p data-i18n="footer.rights">&copy; 2026 Moonly Hosting. Todos los derechos reservados.</p>
            <span>
                <span data-i18n="footer.made_with">Hecho con</span>
                <i class="fa-solid fa-heart" style="color:var(--cyan);"></i>
                <span data-i18n="footer.made_with_end">para la comunidad</span>
            </span>
        </div>
    </div>
</footer>

<!-- ════════════════════════════════════════
     SCRIPTS — orden importa:
     1. Diccionario de traducciones
     2. Motor de tema + i18n + moneda
     3. JS específico de la página (opcional)
     4. main.js (navbar, menús, transiciones)
     ════════════════════════════════════════ -->
<script src="<?php echo $base_path; ?>js/i18n-dict.js?v=11"></script>
<script src="<?php echo $base_path; ?>js/theme-i18n.js?v=11"></script>

<?php if (isset($extra_js) && $extra_js): ?>
    <script src="<?php echo $base_path; ?><?php echo $extra_js; ?>?v=11"></script>
<?php endif; ?>

<script src="<?php echo $base_path; ?>js/main.js?v=11"></script>

</body>
</html>
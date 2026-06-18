<?php
$base_path = '../';
$page_title = 'Términos y Condiciones — Moonly Hosting';
$extra_css  = 'css/legal.css';
$body_class = 'legal-body';
$extra_js   = 'js/terminos.js';
include '../includes/header.php';
?>

<nav class="breadcrumb-bar">
    <div class="container">
        <a href="../index.php" data-i18n="plans.breadcrumb_home">Inicio</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current" data-i18n="terms.breadcrumb_current">Términos de Servicio</span>
    </div>
</nav>

<section class="legal-hero">
    <div class="container">
        <div class="legal-hero-icon"><i class="fa-solid fa-file-contract"></i></div>
        <h1 class="legal-hero-title" data-i18n="terms.hero_title">Términos y Condiciones</h1>
        <p class="legal-hero-desc" data-i18n="terms.hero_desc">Este Acuerdo regula el uso de los productos y servicios de Moonly Hosting. Te recomendamos leerlo completo antes de contratar cualquiera de nuestros servicios.</p>
        <span class="legal-hero-meta"><i class="fa-solid fa-calendar-days"></i> <span data-i18n="terms.last_update">Última actualización: Junio 2026</span></span>
    </div>
</section>

<section class="legal-section">
    <div class="legal-layout">

        <!-- ══════════ ÍNDICE LATERAL ══════════ -->
        <aside class="legal-toc">
            <p class="legal-toc-title" data-i18n="terms.toc_title">Contenido</p>
            <div class="legal-toc-list">
                <a href="#cuenta"><span class="toc-num">1</span> <span data-i18n="terms.toc_1">Tu cuenta</span></a>
                <a href="#pagos"><span class="toc-num">2</span> <span data-i18n="terms.toc_2">Pagos</span></a>
                <a href="#cancelaciones"><span class="toc-num">3</span> <span data-i18n="terms.toc_3">Cancelaciones</span></a>
                <a href="#uso"><span class="toc-num">4</span> <span data-i18n="terms.toc_4">Uso del Servicio</span></a>
                <a href="#legal"><span class="toc-num">5</span> <span data-i18n="terms.toc_5">Obligaciones Legales</span></a>
                <a href="#responsabilidad"><span class="toc-num">6</span> <span data-i18n="terms.toc_6">Responsabilidad</span></a>
                <a href="#sla"><span class="toc-num">7</span> <span data-i18n="terms.toc_7">Acuerdo de Nivel de Servicio</span></a>
                <a href="#reembolsos"><span class="toc-num">8</span> <span data-i18n="terms.toc_8">Reembolsos</span></a>
                <a href="#privacidad"><span class="toc-num">9</span> <span data-i18n="terms.toc_9">Privacidad</span></a>
            </div>
        </aside>

        <!-- ══════════ CONTENIDO ══════════ -->
        <div class="legal-content">

            <p class="legal-intro" data-i18n-html="terms.intro">
                Estos Términos de Servicio ("Acuerdo") constituyen un acuerdo vinculante entre <strong>Moonly Hosting</strong>, con domicilio en Santiago de Chile, y el usuario de nuestros productos y servicios ("Tú" o "Cliente"). Al acceder o utilizar nuestros productos y servicios, aceptas cumplir con los términos y condiciones establecidos en este Acuerdo. Si no estás de acuerdo, no podrás acceder ni utilizar nuestros productos y servicios. Moonly Hosting se reserva el derecho de modificar este Acuerdo en cualquier momento, y es tu responsabilidad revisar este Acuerdo para estar al tanto de cualquier cambio.
            </p>

            <!-- 1 -->
            <article class="legal-article" id="cuenta">
                <div class="legal-article-header">
                    <span class="legal-article-num">1</span>
                    <h2 class="legal-article-title" data-i18n="terms.s1_title">Tu cuenta</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">1.1.</span><span data-i18n="terms.s1_1">Nos reservamos el derecho total de cancelar tu cuenta en cualquier momento, con o sin previo aviso.</span></p>
                    <p><span class="legal-clause-label">1.2.</span><span data-i18n="terms.s1_2">Al solicitar un servidor, o cualquier otro servicio de Moonly Hosting, solo estás alquilando el servicio de hosting. Todos los servidores son propiedad de Moonly Hosting.</span></p>
                    <p><span class="legal-clause-label">1.3.</span><span data-i18n="terms.s1_3">Eres responsable de mantener la confidencialidad de tu información de cuenta y de todas las actividades realizadas bajo tu cuenta. Debes notificar inmediatamente a Moonly Hosting ante cualquier uso no autorizado o brecha de seguridad. No compartas tus credenciales con terceros; usa la función de sub-usuario para otorgar acceso a otras personas.</span></p>
                </div>
            </article>

            <!-- 2 -->
            <article class="legal-article" id="pagos">
                <div class="legal-article-header">
                    <span class="legal-article-num">2</span>
                    <h2 class="legal-article-title" data-i18n="terms.s2_title">Pagos</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">2.1.</span><span data-i18n="terms.s2_1">Los servicios no se activarán hasta que se confirme el pago y se verifique su autenticidad. En la mayoría de los casos la verificación es automática; en circunstancias excepcionales puede ser necesaria una revisión manual.</span></p>
                    <p><span class="legal-clause-label">2.2.</span><span data-i18n-html="terms.s2_2">Si tienes un servidor activo y no recibimos el pago de renovación en la fecha de vencimiento, tu servidor entrará en modo <strong>suspendido</strong>. Tus archivos se conservarán durante 3 días.</span></p>
                    <p><span class="legal-clause-label">2.3.</span><span data-i18n-html="terms.s2_3">Si no realizas un pago dentro de los <strong>7 días</strong> posteriores al vencimiento, el servicio será terminado definitivamente y los archivos eliminados de forma permanente.</span></p>
                    <p><span class="legal-clause-label">2.4.</span><span data-i18n="terms.s2_4">Cualquier contracargo malintencionado dará lugar a la cancelación inmediata de tu cuenta y eliminación permanente de tus servicios.</span></p>
                    <p><span class="legal-clause-label">2.5.</span><span data-i18n="terms.s2_5">Los precios indicados en nuestras webs no incluyen impuestos adicionales. Estos se aplican automáticamente al generar la factura, dependiendo de tu ubicación.</span></p>
                </div>
            </article>

            <!-- 3 -->
            <article class="legal-article" id="cancelaciones">
                <div class="legal-article-header">
                    <span class="legal-article-num">3</span>
                    <h2 class="legal-article-title" data-i18n="terms.s3_title">Cancelaciones</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">3.1.</span><span data-i18n-html="terms.s3_1">Para cancelar tus servicios, debes emitir una solicitud de cancelación en <a href="https://billing.moonly.es" target="_blank">billing.moonly.es</a>.</span></p>
                    <p><span class="legal-clause-label">3.2.</span><span data-i18n="terms.s3_2">Para pagos automáticos, debes cancelar manualmente los pagos recurrentes. De otra manera, tu cuenta enviará periódicamente los pagos pendientes. Revisa la política de reembolsos para más información.</span></p>
                    <p><span class="legal-clause-label">3.3.</span><span data-i18n="terms.s3_3">Si seleccionas "Cancelación inmediata del servidor", no se realizará reembolso de los días restantes.</span></p>
                </div>
            </article>

            <!-- 4 -->
            <article class="legal-article" id="uso">
                <div class="legal-article-header">
                    <span class="legal-article-num">4</span>
                    <h2 class="legal-article-title" data-i18n="terms.s4_title">Uso del Servicio</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">4.1.</span><span data-i18n="terms.s4_1">No puedes eludir deliberadamente ningún límite o restricción de tu servicio. Intentar modificar u omitir cualquier restricción resultará en la suspensión de tus servicios y cancelación de tu cuenta.</span></p>
                    <p><span class="legal-clause-label">4.2.</span><span data-i18n="terms.s4_2">Los servicios de Minecraft Hosting vienen con capacidad de almacenamiento generosa, con posibilidad de expansión según las capacidades del nodo. Nos reservamos el derecho de eliminar archivos excesivos.</span></p>
                    <p><span class="legal-clause-label">4.3.</span><span data-i18n="terms.s4_3">Nos reservamos el derecho de modificar los comandos de inicio configurados en los servidores cuando generen conflictos o comprometan el rendimiento de otros servicios en el mismo nodo compartido.</span></p>
                    <div class="legal-callout">
                        <i class="fa-solid fa-circle-info"></i>
                        <span data-i18n-html="terms.s4_callout"><strong>Excepción:</strong> esta disposición no aplica a los servidores contratados bajo planes de <strong>Cloud Dedicated</strong>.</span>
                    </div>
                </div>
            </article>

            <!-- 5 -->
            <article class="legal-article" id="legal">
                <div class="legal-article-header">
                    <span class="legal-article-num">5</span>
                    <h2 class="legal-article-title" data-i18n="terms.s5_title">Obligaciones Legales</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">5.1.</span><span data-i18n="terms.s5_1">Moonly Hosting prohíbe estrictamente cualquier actividad ilegal en los servidores alojados en nuestra infraestructura. Se consideran actividades prohibidas entre otras:</span></p>
                    <div class="legal-list">
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.s5_list_1">Piratería, craqueo y redistribución de contenido ilegal</span></div>
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.s5_list_2">Minería de criptomonedas y operación de casinos en línea</span></div>
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.s5_list_3">Hacking, phishing y estafas cibernéticas</span></div>
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.s5_list_4">Ataques de denegación de servicio (DDoS)</span></div>
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.s5_list_5">Acoso y envío masivo de spam</span></div>
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.s5_list_6">Alojamiento de servicios VPN</span></div>
                    </div>
                    <p><span data-i18n="terms.s5_1b">Esta lista no es exhaustiva; otras actividades también pueden ser restringidas a discreción de Moonly Hosting.</span></p>
                    <p><span class="legal-clause-label">5.2.</span><span data-i18n="terms.s5_2">Moonly Hosting se reserva el derecho de proporcionar, sin previo aviso, cualquier información requerida por entidades gubernamentales en el marco de investigaciones o procedimientos judiciales.</span></p>
                    <p><span class="legal-clause-label">5.3.</span><span data-i18n="terms.s5_3">Todos los servidores deben cumplir con los términos de la desarrolladora/propietaria de cada juego. Para Minecraft, todos los servidores deben aceptar explícitamente el EULA de Minecraft antes de iniciarse por primera vez.</span></p>
                    <p><span class="legal-clause-label">5.4.</span><span data-i18n="terms.s5_4">No estamos afiliados de ninguna manera con Mojang AB©.</span></p>
                    <p><span class="legal-clause-label">5.5.</span><span data-i18n="terms.s5_5">Reconoces y aceptas que, a pesar de nuestros esfuerzos por salvaguardar la seguridad de nuestros sistemas, no es posible garantizar que estén completamente libres de vulnerabilidades. Al utilizar nuestros servicios, aceptas voluntariamente los riesgos inherentes al entorno digital.</span></p>
                </div>
            </article>

            <!-- 6 -->
            <article class="legal-article" id="responsabilidad">
                <div class="legal-article-header">
                    <span class="legal-article-num">6</span>
                    <h2 class="legal-article-title" data-i18n="terms.s6_title">Responsabilidad</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">6.1.</span><span data-i18n="terms.s6_1">Moonly Hosting se reserva el derecho de modificar las tarifas, beneficios, reglas, regulaciones, ofertas especiales, términos y condiciones, o cancelar los servicios en cualquier momento y sin previo aviso.</span></p>
                    <p><span class="legal-clause-label">6.2.</span><span data-i18n="terms.s6_2">Debido a la naturaleza de los servicios que brindamos, puede haber problemas como impactos en el rendimiento, corrupción o pérdida de datos y retrasos. No somos responsables, aunque se hará un esfuerzo razonable para ayudarte.</span></p>
                    <p><span class="legal-clause-label">6.3.</span><span data-i18n="terms.s6_3">Moonly Hosting cuenta con un sistema de disaster recovery. Almacenamos copias periódicas de los servidores activos en nodos aislados. Recomendamos a nuestros clientes mantener su propio plan de copias de seguridad.</span></p>
                    <p><span class="legal-clause-label">6.4.</span><span data-i18n="terms.s6_4">Los servicios se ofrecen "tal como están" y "según disponibilidad". Moonly Hosting renuncia expresamente a cualquier garantía, ya sea expresa o implícita. Bajo ninguna circunstancia será responsable de daños consecuentes, indirectos, especiales o incidentales.</span></p>
                    <p><span class="legal-clause-label">6.5.</span><span data-i18n-html="terms.s6_5">Moonly Hosting se reserva el derecho de negar servicio a cualquier individuo o entidad. Si tienes alguna inquietud, contacta a <a href="mailto:soporte@moonly.es">soporte@moonly.es</a>.</span></p>
                </div>
            </article>

            <!-- 7 -->
            <article class="legal-article" id="sla">
                <div class="legal-article-header">
                    <span class="legal-article-num">7</span>
                    <h2 class="legal-article-title" data-i18n="terms.s7_title">Acuerdo de Nivel de Servicio (SLA)</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">7.1.</span><span data-i18n="terms.s7_1">Este Acuerdo de Nivel de Servicio (SLA) regula los estándares mínimos de disponibilidad y funcionamiento de nuestros servicios. Moonly Hosting se reserva el derecho de modificarlo en cualquier momento, sin previo aviso.</span></p>

                    <p><span class="legal-clause-label">7.2.</span><strong data-i18n="terms.s7_2_title">Servicios cubiertos por el SLA:</strong></p>
                    <table class="legal-table">
                        <thead>
                            <tr>
                                <th data-i18n="terms.sla_th_service">Servicio</th>
                                <th data-i18n="terms.sla_th_uptime">Disponibilidad</th>
                                <th data-i18n="terms.sla_th_threshold">Umbral de reclamo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-i18n="terms.sla_row_network">Red</td>
                                <td class="num-cell">99.99%</td>
                                <td data-i18n="terms.sla_row_network_t">+10 min continuos</td>
                            </tr>
                            <tr>
                                <td data-i18n="terms.sla_row_panel">Panel de control</td>
                                <td class="num-cell">99%</td>
                                <td data-i18n="terms.sla_row_panel_t">+20 min continuos</td>
                            </tr>
                            <tr>
                                <td data-i18n="terms.sla_row_hardware">Hardware</td>
                                <td class="num-cell">—</td>
                                <td data-i18n="terms.sla_row_hardware_t">+25 min continuos</td>
                            </tr>
                            <tr>
                                <td data-i18n="terms.sla_row_ddos">Mitigación DDoS</td>
                                <td class="num-cell">—</td>
                                <td data-i18n="terms.sla_row_ddos_t">+5 min sin mitigar</td>
                            </tr>
                        </tbody>
                    </table>

                    <p><span class="legal-clause-label">7.3.</span><strong data-i18n="terms.s7_3_title">Exclusiones del SLA:</strong> <span data-i18n="terms.s7_3">no aplica en casos de mantenimiento programado, fallos de software, errores causados por el cliente, sobreuso de recursos o fuerza mayor.</span></p>

                    <p><span class="legal-clause-label">7.4.</span><strong data-i18n="terms.s7_4_title">Compensación por incumplimiento:</strong></p>
                    <div class="legal-list">
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.sla_comp_1">Por cada 4 horas continuas de inactividad verificable, recibirás 1 día adicional de servicio.</span></div>
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.sla_comp_2">Debes abrir un ticket de soporte solicitando la compensación dentro de los 7 días posteriores al incidente.</span></div>
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.sla_comp_3">Todas las reclamaciones serán investigadas y la decisión final será tomada a nuestra entera discreción.</span></div>
                        <div class="legal-list-item"><i class="fa-solid fa-circle"></i> <span data-i18n="terms.sla_comp_4">Nos reservamos el derecho de denegar cualquier solicitud si existe evidencia razonable de que el cliente causó o contribuyó intencionalmente a la interrupción.</span></div>
                    </div>
                </div>
            </article>

            <!-- 8 -->
            <article class="legal-article" id="reembolsos">
                <div class="legal-article-header">
                    <span class="legal-article-num">8</span>
                    <h2 class="legal-article-title" data-i18n="terms.s8_title">Reembolsos</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">8.1.</span><span data-i18n="terms.s8_1">Moonly Hosting ofrece reembolsos únicamente en casos donde se determine que ha existido un error atribuible a nuestra parte, emitidos bajo criterio exclusivo de Moonly Hosting luego de revisar cada caso individualmente. No se otorgarán reembolsos por causas ajenas a Moonly Hosting.</span></p>
                    <p><span class="legal-clause-label">8.2.</span><span data-i18n="terms.s8_2">Para servidores de juegos distintos a Minecraft Hosting, ofrecemos una garantía de devolución del 100% por 48 horas sin condiciones.</span></p>
                    <p><span class="legal-clause-label">8.3.</span><span data-i18n="terms.s8_3">Si una cuenta es suspendida o cancelada por violación de los Términos de Servicio, no se otorgará ningún reembolso.</span></p>
                </div>
            </article>

            <!-- 9 -->
            <article class="legal-article" id="privacidad">
                <div class="legal-article-header">
                    <span class="legal-article-num">9</span>
                    <h2 class="legal-article-title" data-i18n="terms.s9_title">Privacidad</h2>
                </div>
                <div class="legal-article-body">
                    <p><span class="legal-clause-label">9.1.</span><span data-i18n="terms.s9_1">Nos comprometemos a utilizar los datos de nuestros usuarios exclusivamente para brindarles el mejor servicio posible. En ningún caso venderemos ni distribuiremos los datos de nuestros clientes.</span></p>
                    <p><span class="legal-clause-label">9.2.</span><span data-i18n="terms.s9_2">Moonly Hosting nunca guardará ningún tipo de archivo relacionado con los servicios de nuestros usuarios una vez finalice el periodo de vida del servicio, a no ser que lo hayamos especificado previamente.</span></p>
                    <p><span class="legal-clause-label">9.3.</span><span data-i18n="terms.s9_3">Solo accederemos a los archivos/datos de los servidores de nuestros clientes cuando sea necesario brindarles soporte técnico, previo consentimiento, o cuando se sospeche que el servidor estaría infringiendo nuestros términos y condiciones.</span></p>
                    <p><span class="legal-clause-label">9.4.</span><span data-i18n-html="terms.s9_4">Tienes el derecho de solicitar la eliminación de tus datos personales. Ciertos datos no pueden ser eliminados por razones de cumplimiento normativo. Para solicitar la eliminación, crea un ticket en nuestro Discord o escríbenos a <a href="mailto:soporte@moonly.es">soporte@moonly.es</a>.</span></p>
                </div>
            </article>

            <!-- ── CTA FINAL ── -->
            <div class="legal-footer-note">
                <p class="legal-footer-note-text" data-i18n-html="terms.footer_note">
                    <strong>¿Tienes dudas sobre estos términos?</strong> Nuestro equipo de soporte está disponible para aclarar cualquier punto antes de que contrates un servicio.
                </p>
                <a href="https://discord.gg/moonly" target="_blank" class="legal-footer-note-btn">
                    <i class="fa-brands fa-discord"></i> <span data-i18n="terms.footer_btn">Hablar con Soporte</span>
                </a>
            </div>

        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
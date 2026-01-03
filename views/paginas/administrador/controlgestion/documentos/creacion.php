<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="ListaGeneralDocumentos">Lista de Documentos</a>
        <a class="nav-link active ms-0" href="CreacionDocumentos">Crear Documento</a>
    </nav>
    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detalle de Documento</div>
                <div class="card-body">
                    <form id="formCrearDocumento" autocomplete="off">
                        <input type="hidden" id="idusuario" name="idusuario" value="<?= json_encode($_SESSION['id']) ?>">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="documento">Nombre de Documento</label>
                                <input class="form-control" id="documento" name="documento" type="text" placeholder="Ingresar Nombre de Documento">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="filtrarAdjunto">Tipo Adjunto</label>
                                <select class="form-control text-uppercase" id="filtrarAdjunto" name="filtrarAdjunto">
                                    <option selected disabled>Seleccionar Tipo Adjunto</option>
                                    <?php foreach ($lista_adjuntos as $adjunto) : ?>
                                        <option value="<?php echo $adjunto->id ?>"><?php echo $adjunto->adjunto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="formFileAdjunto">Cargue Documento</label>
                            <input class="form-control" id="formFileAdjunto" name="formFileAdjunto" type="file" placeholder="Ingresa Documento">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="fecha_inicio">Fecha Inicio</label>
                                <input class="form-control" id="fecha_inicio" name="fecha_inicio" type="date">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="fecha_termino">Fecha Termino</label>
                                <input class="form-control" id="fecha_termino" name="fecha_termino" type="date">
                            </div>
                        </div>
                        <button class="btn btn-primary" id="btn-registrar-documento" name="btn-registrar-documento" type="button"><i class="fas fa-save"></i> Crear documento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Gestion de Activos - Transber <?php echo date("Y"); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seleccione “Cerrar sesión” a continuación si está listo para finalizar su sesión actual.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="Close">Cerrar sesión</a>
            </div>
        </div>
    </div>
</div>
<!-- JS SWEETALERT -->
<script src="vendor/realrashid/sweet-alert/resources/js/sweetalert.all.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="public/assets/vendor/jquery/jquery.min.js"></script>
<script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="public/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="public/assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<!-- <script src="public/assets/js/demo/chart-area-demo.js"></script>
    <script src="public/assets/js/demo/chart-pie-demo.js"></script> -->

<!-- Page level plugins -->
<script src="public/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="public/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="public/assets/js/demo/datatables-demo.js"></script>

<script src="public/js/ajaxEventosDocumento.js"></script>

</body>

</html>
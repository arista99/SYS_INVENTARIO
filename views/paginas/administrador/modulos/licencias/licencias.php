<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="CreacionLicencias">Crear Licencia</a>
        <a class="nav-link active ms-0" href="ListaLicencias">Lista de Licencias</a>
        <!-- <a class="nav-link active ms-0" href="ListaEquiAcce">Equipos & Accesorios</a> -->
    </nav>

    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>

    <hr class="mt-0 mb-4">
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="licencia" id="licencia" class="form-control" placeholder="Nombre licencia">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarLicencia" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Lista de Licencias</div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered" id="tablaDatosLicencia" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre Software</th>
                                <th class="text-center">Version</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Proveevor</th>
                                <th class="text-center">Documento</th>
                                <th class="text-center">Fecha Registro</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Se rellena dinamicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!---Modal Actualizar---->
    <div class="modal fade" id="modalEditarLicencia" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="formEditarLicencia" autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Licencia</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_software">Actualizar Nombre de Software</label>
                            <input class="form-control" id="edit_software" name="edit_software" type="text">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_version">Actualizar Version</label>
                            <input class="form-control" id="edit_version" name="edit_version">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_cantidad">Actualizar Cantidad</label>
                            <input class="form-control" id="edit_cantidad" name="edit_cantidad" type="text">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_tipo">Actualizar Tipo</label>
                            <input class="form-control" id="edit_tipo" name="edit_tipo" type="text">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_proveedor">Actualizar Proveedor</label>
                            <select class="form-control text-uppercase" id="edit_proveedor" name="edit_proveedor">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_documento">Actualizar Documento</label>
                            <select class="form-control text-uppercase" id="edit_documento" name="edit_documento">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar">Cerrar</button>
                    <button type="submit" name="updateInfoButtonLicencia" id="updateInfoButtonLicencia" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
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

<script src="public/js/ajaxEventosLicencia.js"></script>
<script src="public/js/ajaxSelectLicencia.js"></script>

</body>

</html>
<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="ListaGeneralLicencias">Lista de Licencias</a>
        <a class="nav-link active ms-0" href="CreacionLicencias">Crear Licencia</a>
    </nav>
    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detalle de Licencias</div>
                <div class="card-body">
                    <form id="formCrearLicencia" autocomplete="off">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="software">Nombre de Software</label>
                                <input class="form-control" id="software" name="software" type="text" placeholder="Ingresar Nombre de Software">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="version">Ingrese Version</label>
                                <input class="form-control" id="version" name="version" type="text" placeholder="Ingresa Version">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="cantidad">Ingrese Cantidad</label>
                                <input class="form-control" id="cantidad" name="cantidad" type="text" placeholder="Ingresar Cantidad">
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="disponible">Ingrese Disponible</label>
                                <input class="form-control" id="disponible" name="disponible" type="text" placeholder="Ingresar Disponible">
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="tipo">Tipo</label>
                                <input class="form-control" id="tipo" name="tipo" type="text" placeholder="Ingresa Tipo">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                    <label class="small mb-1" for="fecha_inicio_licencia">Fecha Inicio Licencia</label>
                                    <input class="form-control" id="fecha_inicio_licencia" name="fecha_inicio_licencia" type="date">
                            </div>
                            <div class="col-md-6">
                                    <label class="small mb-1" for="fecha_fin_licencia">Fecha Fin Licencia</label>
                                    <input class="form-control" id="fecha_fin_licencia" name="fecha_fin_licencia" type="date">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="proveedor">Proveedor</label>
                                <select class="form-control text-uppercase" id="proveedor" name="proveedor">
                                    <option selected disabled>Seleccionar Proveedor</option>
                                    <?php foreach ($lista_proveedor as $proveedores) : ?>
                                        <option value="<?php echo $proveedores->id ?>"><?php echo $proveedores->proveedor ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="documento">Documento</label>
                                <select class="form-control text-uppercase" id="documento" name="documento">
                                    <option selected disabled>Seleccionar Documento</option>
                                    <?php foreach ($documentos_tra as $documento) : ?>
                                        <option value="<?php echo $documento->id ?>"><?php echo $documento->documento ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="categoria">Categorias</label>
                                    <select class="form-control text-uppercase" id="categoria" name="categoria">
                                        <option selected disabled>Seleccionar Categoria</option>
                                            <option value="<?php echo $lista_categorias->id ?>"><?php echo $lista_categorias->categoria ?></option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="fabricante">Fabricantes</label>
                                    <select class="form-control text-uppercase" id="fabricante" name="fabricante">
                                        <option selected disabled>Seleccionar Fabricante</option>
                                    </select>
                                </div>
                        </div>
                        <button class="btn btn-primary" id="btn-registrar-licencia" name="btn-registrar-licencia" type="button"><i class="fas fa-save"></i> Crear licencia</button>
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

<script src="public/js/ajaxEventosLicencia.js"></script>
<script src="public/js/ajaxCascada.js"></script>

</body>

</html>
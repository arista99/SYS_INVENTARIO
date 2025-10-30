<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="CreacionAccesorio">Crear Accesorio</a>
        <a class="nav-link active ms-0" href="ListaGeneralAccesorio">Lista de Accesorio</a>
    </nav>

    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>

    <hr class="mt-0 mb-4">
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="accesorio" id="accesorio" class="form-control" placeholder="Nombre Accesorio">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarAccesorio" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Lista de Accesorios</div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered" id="tablaDatosAccesorio" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre Accesorio</th>
                                <th class="text-center">Numero de Serie</th>
                                <th class="text-center">Condición</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Proveedor</th>
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

    <div class="modal fade" id="modalEditarAccesorio" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <!-- id="formEditarUsuario" - action="actualizarActivoPC" method="POST"  -->
            <form autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Accesorio</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="edit_nombre">Actualizar Nombre de Accesorio</label>
                                <input class="form-control" id="edit_nombre" name="edit_nombre" type="text" placeholder="Ingresar Nombre de Accesorio">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="edit_serie">Actualizar Numero de Serie</label>
                                <input class="form-control" id="edit_serie" name="edit_serie" type="text" placeholder="Ingresar Numero de Serie">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="edit_categoria">Categorias</label>
                                <select class="form-control text-uppercase" id="edit_categoria" name="categoria">
                                    <option selected disabled>Seleccionar Categoria</option>
                                 </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="edit_fabricante">Fabricantes</label>
                                <select class="form-control text-uppercase" id="edit_fabricante" name="fabricante">
                                    <option selected disabled>Seleccionar Fabricante</option>
                                </select>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="edit_condicion">Condiciones</label>
                                <select class="form-control text-uppercase" id="edit_condicion" name="condicion">
                                    <option selected disabled>Seleccionar Condicion</option>
                                    <?php foreach ($lista_condiciones as $condiciones) : ?>
                                        <option value="<?php echo $condiciones->id ?>"><?php echo $condiciones->condicion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="edit_estado">Estados</label>
                                <select class="form-control text-uppercase" id="edit_estado" name="estado">
                                    <option selected disabled>Seleccionar Estado</option>
                                    <?php foreach ($lista_estados as $estados) : ?>
                                        <option value="<?php echo $estados->id ?>"><?php echo $estados->estado ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="edit_proveedor">Proveedores</label>
                                <select class="form-control text-uppercase" id="edit_proveedor" name="proveedor">
                                    <option selected disabled>Seleccionar Proveedor</option>
                                    <?php foreach ($lista_proveedores as $proveedores) : ?>
                                        <option value="<?php echo $proveedores->id ?>"><?php echo $proveedores->proveedor ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="edit_documento">Documentos</label>
                                <select class="form-control text-uppercase" id="edit_documento" name="documento">
                                    <option selected disabled>Seleccionar documento</option>
                                </select>
                            </div>
                        </div>
                </div>    
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-window-close"></i> Cerrar</button>
                    <button type="submit" name="updateInfoButtonAccesorio" id="updateInfoButtonAccesorio" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
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

<!-- Page level plugins -->
<script src="public/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="public/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="public/assets/js/demo/datatables-demo.js"></script>

<!-- Select2 CSS y JS -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="public/js/ajaxEventosAccesorio.js"></script>
<script src="public/js/ajaxSelectAccesorio.js"></script>
<script src="public/js/ajaxEditCascada.js"></script>
</body>

</html>
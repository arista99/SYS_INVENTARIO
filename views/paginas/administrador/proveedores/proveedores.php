<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="CreacionProveedores">Crear Proveedor</a>
        <a class="nav-link active ms-0" href="ListaProveedores">Lista de Proveedores</a>
        <!-- <a class="nav-link active ms-0" href="ListaEquiAcce">Equipos & Accesorios</a> -->
    </nav>

    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>

    <hr class="mt-0 mb-4">
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder="Nombre Proveedor">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarProveedor" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Lista de Proveedores</div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered" id="tablaDatosProveedor" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Proveedor</th>
                                <th class="text-center">Dirección</th>
                                <th class="text-center">Contacto</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Telefono</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Documento</th>
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

    <div class="modal fade" id="modalEditarProveedor" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="formEditarProveedor" autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_proveedor" class="form-label">Actualizar Proveedor</label>
                            <input type="text" id="edit_proveedor" name="edit_proveedor" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_direccion" class="form-label">Actualizar Dirección</label>
                            <input type="text" id="edit_direccion" name="edit_direccion" class="form-control">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_contacto" class="form-label">Actualizar Contacto</label>
                            <input type="text" id="edit_contacto" name="edit_contacto" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_email" class="form-label">Actualizar Email</label>
                            <input type="email" id="edit_email" name="edit_email" class="form-control">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_telefono" class="form-label">Actualizar Telefono</label>
                            <input type="text" id="edit_telefono" name="edit_telefono" class="form-control">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_producto" class="form-label">Actualizar Tipo de Producto</label>
                            <select class="form-control text-uppercase" id="edit_producto" name="edit_producto">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_documento" class="form-label">Actualizar Tipo de Documento</label>
                            <select class="form-control text-uppercase" id="edit_documento" name="edit_documento">
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar">Cerrar</button>
                    <button type="submit" name="updateInfoButtonProveedor" id="updateInfoButtonProveedor" class="btn btn-primary">Actualizar</button>
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

<script src="public/js/ajaxEventosProveedor.js"></script>
<script src="public/js/ajaxSelectProveedor.js"></script>

</body>

</html>
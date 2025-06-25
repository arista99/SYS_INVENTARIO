<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="CreacionUsuarios">Crear Usuario</a>
        <a class="nav-link active ms-0" href="ListaUsuarios">Lista de Usuarios</a>
        <a class="nav-link active ms-0" href="ListaEquiAcce">Equipos & Accesorios</a>
    </nav>

    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>

    <hr class="mt-0 mb-4">
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre Usuario">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarUsuario" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Lista de Usuarios</div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered" id="tablaDatosUsuario" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Usuario de Red</th>
                                <th class="text-center">Centro de Costo</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Sede</th>
                                <th class="text-center">Pefil</th>
                                <th class="text-center">Area</th>
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

    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <!-- id="formEditarUsuario"  -->
            <form action="actualizarUsuario" method="POST" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">

                    <div class="mb-3">
                        <label for="edit_usuario" class="form-label">Usuario</label>
                        <input type="text" id="edit_usuario" name="edit_usuario" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_usu_red" class="form-label">Usuario de Red</label>
                        <input type="text" id="edit_usu_red" name="edit_usu_red" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_centro_cosoto" class="form-label">Centro de Costo</label>
                        <select class="form-control text-uppercase" id="edit_centro_costo" name="edit_centro_costo">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="text" id="edit_email" name="edit_email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_sede" class="form-label">Sede</label>
                        <select class="form-control text-uppercase" id="edit_sede" name="edit_sede">
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_perfil" class="form-label">Perfil</label>
                        <select class="form-control text-uppercase" id="edit_perfil" name="edit_perfil">
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_area" class="form-label">Area</label>
                        <select class="form-control text-uppercase" id="edit_area" name="edit_area">
                            
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar">Cerrar</button>
                    <button type="submit" name="updateInfoButtonUsuario" id="updateInfoButtonUsuario" class="btn btn-primary">Actualizar</button>
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

<script src="public/js/ajaxEventosUsuario.js"></script>
<script src="public/js/ajaxSelectUsuario.js"></script>

</body>

</html>
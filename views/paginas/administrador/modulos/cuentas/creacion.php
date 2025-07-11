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
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detalle de Usuario</div>
                <div class="card-body">
                    <form id="formCrearUsuario" autocomplete="off">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="usuarioRed">Usuario de red</label>
                                <input class="form-control" id="usuarioRed" name="usuarioRed" type="text" placeholder="Ingresar usuario de red">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="usuario">Nombre de Usuario</label>
                                <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingresar nombre de usuario">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="filtrarSede">Sede</label>
                                <select class="form-control text-uppercase" id="filtrarSede">
                                    <option selected disabled>Seleccionar Sede</option>
                                    <?php foreach ($sedes_tra as $sede) : ?>
                                        <option value="<?php echo $sede->id ?>"><?php echo $sede->sede ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="contrasena">Contraseña</label>
                                <input class="form-control" id="contrasena" name="contrasena" type="password" placeholder="Ingresa contraseña">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="filtrarCentro">Centro de Costo</label>
                                <select class="form-control text-uppercase" id="filtrarCentro">
                                    <option selected disabled>Seleccionar Centro de Costo</option>
                                    <?php foreach ($centros_tra as $centro) : ?>
                                        <option value="<?php echo $centro->id ?>"><?php echo $centro->centro_costo ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="filtrarArea">Area</label>
                                <select class="form-control text-uppercase" id="filtrarArea">
                                    <option selected disabled>Seleccionar Área</option>
                                    <?php foreach ($areas_tra as $area) : ?>
                                        <option value="<?php echo $area->id ?>"><?php echo $area->area ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="correo">Email</label>
                            <input class="form-control" id="correo" name="correo" type="email" placeholder="Ingresa corrreo">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="filtrarPerfil">Perfil</label>
                                <select class="form-control text-uppercase" id="filtrarPerfil">
                                    <option selected disabled>Seleccionar Pefil</option>
                                    <?php foreach ($perfiles_tra as $perfil) : ?>
                                        <option value="<?php echo $perfil->id ?>"><?php echo $perfil->perfil ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="cargo">Cargo</label>
                                <input class="form-control" id="cargo" name="cargo" type="text" placeholder="Ingresar Cargo">
                            </div>
                        </div>
                        <button class="btn btn-primary" id="btn-registrar-usuario" name="btn-registrar-usuario" type="button">Crear usuario</button>
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

<script src="public/js/usuario.js"></script>

</body>

</html>
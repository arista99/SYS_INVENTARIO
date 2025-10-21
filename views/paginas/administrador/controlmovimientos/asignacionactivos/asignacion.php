<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="ControlAsignacionActivo">Crear Asignación de Activo</a>
        <a class="nav-link active ms-0" href="ListaGenerealAsignacionActivo">Lista de Asignacion de Activo</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detalle de Asignación de Activo</div>
                <div class="card-body">
                    <!-- <form id="formCrearUsuario" autocomplete="off">
                        <button class="btn btn-primary" id="btn-registrar-usuario" name="btn-registrar-usuario" type="button">Asignación de Activo</button>
                    </form> -->
                    <form id="formAsignacionActivo" autocomplete="off">
                        <!-- Usuario -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Usuario</label>
                            <div class="col-sm-8">
                                <input type="hidden" id="id_usuario" name="usuario">
                                <input type="text" id="nombre_usuario" class="form-control" placeholder="Seleccione un usuario" readonly>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modalUsuarios">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>

                        <!-- Celular -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Celular</label>
                            <div class="col-sm-8">
                                <input type="hidden" id="id_celular" name="celular">
                                <input type="text" id="info_celular" class="form-control" placeholder="Seleccione un celular" readonly>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modalCelulares">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>

                        <!-- Desktop/Laptop -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Desktop / Laptop</label>
                            <div class="col-sm-8">
                                <input type="hidden" id="id_desklap" name="desklap">
                                <input type="text" id="info_desklap" class="form-control" placeholder="Seleccione un equipo" readonly>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modalDeskLap">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>

                        <!-- Tipo de entrega -->
                        <div class="form-group">
                            <label for="tipo_entrega">Tipo de Entrega</label>
                            <select class="form-control" id="tipo_entrega" name="tipo_entrega" required>
                                <option selected disabled>Seleccione Tipo de Entrega</option>
                                <?php foreach ($lista_tipo_entrega as $entregas) : ?>
                                    <?php if(in_array($entregas->id,[3,4])) continue; ?>
                                    <option value="<?php echo $entregas->id ?>"><?php echo $entregas->entrega ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Observación -->
                        <div class="form-group">
                            <label for="observacion">Observación</label>
                            <textarea id="observacion" name="observacion" rows="3" class="form-control"></textarea>
                        </div>

                        <button  id="btn-registrar-asignacion" name="btn-registrar-asignacion" type="button" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Asignación
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- MODAL DE BUSQUEDA - USUARIOS -->

    <div class="modal fade" id="modalUsuarios" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Buscar Usuario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="tablaUsuarios">
                        <thead>
                            <tr>
                                <th>Sede</th>
                                <th>Area</th>
                                <th>Nombre</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_usuarios as $u): ?>
                                <tr>
                                    <td><?php echo $u->sede ?></td>
                                    <td><?php echo $u->area ?></td>
                                    <td><?php echo $u->nombre ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-success seleccionar-usuario"
                                            data-id="<?php echo $u->id ?>"
                                            data-nombre="<?php echo $u->nombre . ' - ' . $u->area; ?>">
                                            Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE BUSQUEDA - CELULARES -->

    <div class="modal fade" id="modalCelulares" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Buscar Celular</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="tablaCelulares">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>NS</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_celular as $cel): ?>
                                <tr>
                                    <td><?php echo $cel->fabricante ?> </td>
                                    <td><?php echo $cel->modelo ?> </td>
                                    <td><?php echo $cel->ns ?> </td>
                                    <td>
                                        <button class="btn btn-sm btn-success seleccionar-celular"
                                            data-id="<?php echo $cel->id; ?>"
                                            data-info="<?php echo $cel->fabricante . ' - ' . $cel->modelo . ' - ' . $cel->ns; ?>">
                                            Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE BUSQUEDA - DESKTOP - LAPTOP -->

    <div class="modal fade" id="modalDeskLap" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Buscar Desktop / Laptop</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="tablaDeskLap">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>NS</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_desklap as $dl): ?>
                                <tr>
                                    <td><?php echo $dl->fabricante; ?></td>
                                    <td><?php echo $dl->modelo; ?></td>
                                    <td><?php echo $dl->ns; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-success seleccionar-desklap"
                                            data-id="<?php echo $dl->id; ?>"
                                            data-info="<?php echo $dl->fabricante . ' - ' . $dl->modelo . ' - ' . $dl->ns; ?>">
                                            Seleccionar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleMarcaabel"
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModeloabel"
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

<script src="public/js/ajaxBusqueda.js"></script>
<script src="public/js/ajaxEventosAsignacionActivo.js"></script>
</body>

</html>
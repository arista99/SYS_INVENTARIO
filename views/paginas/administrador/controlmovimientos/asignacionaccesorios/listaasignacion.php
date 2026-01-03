<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="ListaGeneralAsignacionAccesorio">Lista de Asignacion de Accesorio</a>
        <a class="nav-link " href="ControlAsignacionAccesorio">Crear Asignación de Accesorio</a>
    </nav>
    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>

    <hr class="mt-0 mb-4">
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="asignacion" id="asignacion" class="form-control" placeholder="Nombre asignacion">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarAsignacion" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Lista de Asignación de Accesorio</div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered" id="tablaDatosAsignacionAccesorio" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Accesorio</th>
                                <th class="text-center">Observación</th>
                                <th class="text-center">Tipo de Entrega</th>
                                <th class="text-center">Ver Detalles</th>
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

    <div class="modal fade" id="modalEditarAsignacionAccesorio" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles de Asignacion de Accesorio</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Usuario</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="edit_id_usuario" name="usuario">
                            <input type="text" id="edit_nombre_usuario" class="form-control" placeholder="Seleccione un usuario" readonly>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modalUsuarios">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>

                    <!-- Accesorio -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Accesorio</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="edit_id_accesorio" name="accesorio">
                            <input type="text" id="edit_info_accesorio" class="form-control" placeholder="Seleccione un Accesorio" readonly>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modalAccesorios">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small mb-1" for="edit_fecha_movimiento">Fecha Asignación</label>
                        <input class="form-control" id="edit_fecha_movimiento" name="edit_fecha_movimiento" type="date" readonly>
                    </div>

                    <!-- Tipo de entrega -->
                    <div class="form-group">
                        <label for="edit_tipo_entrega">Tipo de Entrega</label>
                        <select class="form-control" id="edit_tipo_entrega" name="edit_tipo_entrega" required>
                            <option selected disabled>Seleccione Tipo de Entrega</option>
                        </select>
                    </div>

                    <!-- Observación -->
                    <div class="form-group">
                        <label for="edit_observacion">Observación</label>
                        <textarea id="edit_observacion" name="edit_observacion" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-window-close"></i> Cerrar</button>
                        <button type="submit" name="updateInfoButtonAsignacionAccesorio" id="updateInfoButtonAsignacionAccesorio" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                    </div>
                </div>
            </form>
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

    <!-- MODAL DE BUSQUEDA - ACCESORIOS -->

    <div class="modal fade" id="modalAccesorios" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Buscar Accesorio</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="tablaAccesorios">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Equipo</th>
                                <th>NS</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_accesorios as $acc): ?>
                                <tr>
                                    <td><?php echo $acc->fabricante ?> </td>
                                    <td><?php echo $acc->nombre ?> </td>
                                    <td><?php echo $acc->ns ?> </td>
                                    <td>
                                        <button class="btn btn-sm btn-success seleccionar-accesorio"
                                            data-id="<?php echo $acc->id; ?>"
                                            data-info="<?php echo $acc->fabricante . ' - ' . $acc->nombre . ' - ' . $acc->ns; ?>">
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

<script src="public/js/ajaxEventosAsignacionAccesorio.js"></script>
<script src="public/js/ajaxSelectAsignacionAccesorio.js"></script>
<script src="public/js/ajaxBusquedaEdicionAccesorio.js"></script>

</body>

</html>
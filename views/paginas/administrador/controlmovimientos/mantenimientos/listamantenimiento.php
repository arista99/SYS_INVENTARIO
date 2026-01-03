<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="ListaGeneralMantenimiento">Lista de Mantenimientos</a>
        <a class="nav-link" href="ControlMantenimientos">Registrar Mantenimiento</a>
    </nav>

    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>

    <hr class="mt-0 mb-4">
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="mantenimiento" id="mantenimiento" class="form-control" placeholder="Nombre Equipo">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarMantenimiento" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Lista de Asignación de Activo</div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered" id="tablaDatosMantenimiento" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre de Equipo</th>
                                <th class="text-center">Tipo de Mantenimiento</th>
                                <th class="text-center">Fecha Inicio</th>
                                <th class="text-center">Fecha Fin</th>
                                <th class="text-center">Usuario Soporte</th>
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

    <div class="modal fade" id="modalEditarMantenimiento" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles de Mantenimiento</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <!-- Desktop/Laptop -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Desktop / Laptop</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="edit_id_desklap" name="edit_id_desklap">
                            <input type="text" id="edit_info_desklap" class="form-control" placeholder="Seleccione un equipo" readonly>
                        </div>
                        <!-- <div class="col-sm-2">
                            <button type="button" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modalDeskLap">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div> -->
                    </div>

                    <!-- Tipo de entrega -->
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_mantenimiento">Tipo de Mantenimiento</label>
                            <select class="form-control text-uppercase" id="edit_mantenimiento" name="edit_mantenimiento">
                                <option selected disabled>Seleccionar Mantenimiento</option>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_proveedor">Proveedor</label>
                            <select class="form-control text-uppercase" id="edit_proveedor" name="edit_proveedor">
                            </select>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_estado">Estado Final</label>
                            <select class="form-control text-uppercase" id="edit_estado" name="edit_estado">
                                <option selected disabled>Seleccionar Estados</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_usuario">Usuario Soporte</label>
                            <select class="form-control text-uppercase" id="edit_usuario" name="edit_usuario">
                            </select>
                        </div>
                    </div>
                     <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                                <label class="small mb-1" for="edit_fecha_inicio">Fecha Inicio</label>
                                <input class="form-control" id="edit_fecha_inicio" name="edit_fecha_inicio" type="date" readonly>
                        </div>
                        <div class="col-md-6">
                                <label class="small mb-1" for="edit_fecha_fin">Fecha Fin</label>
                                <input class="form-control" id="edit_fecha_fin" name="edit_fecha_fin" type="date">
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="form-group">
                        <label for="edit_descripcion">Descripción</label>
                        <textarea id="edit_descripcion" name="edit_descripcion" rows="3" class="form-control"></textarea>
                    </div>

                    <!-- Observación -->
                    <div class="form-group">
                        <label for="edit_observacion">Observación</label>
                        <textarea id="edit_observacion" name="edit_observacion" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar"><i class="fas fa-window-close"></i> Cerrar</button>
                        <button type="submit" name="updateInfoButtonMantenimiento" id="updateInfoButtonMantenimiento" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                    </div>
                </div>
            </form>
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

<script src="public/js/ajaxEventosMantenimiento.js"></script>
<script src="public/js/ajaxSelectMantenimiento.js"></script>
<script src="public/js/ajaxBusquedaMantenimiento.js"></script>

</body>

</html>
<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="ListaGeneralAsignacionLicencia">Lista de Asignacion de Licencia</a>
        <a class="nav-link active ms-0" href="ControlAsignacionLicencia">Crear Asignación de Licencia</a>
    </nav>
    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detalle de Asignación de Licencia</div>
                <div class="card-body">
                    <form autocomplete="off">

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

                        <!-- Licencia -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Licencia</label>
                            <div class="col-sm-8">
                                <input type="hidden" id="id_licencia" name="licencia">
                                <input type="text" id="info_licencia" class="form-control" placeholder="Seleccione una Licencia" readonly>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modalLicencias">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>

                       

                        <button class="btn btn-primary" id="saveInfoButtonAsignacionLicencia" name="saveInfoButtonAsignacionLicencia" type="button">
                            <i class="fas fa-save"></i> Guardar Asignación
                                </button>
                    </form>

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
                                <th>Nombre Equipo</th>
                                <th>NS</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_desklap as $dl): ?>
                                <tr>
                                    <td><?php echo $dl->nom_equipo; ?></td>
                                    <td><?php echo $dl->ns; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-success seleccionar-desklap"
                                            data-id="<?php echo $dl->id; ?>"
                                            data-info="<?php echo $dl->nom_equipo . ' - ' . $dl->ns; ?>">
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

    <!-- MODAL DE BUSQUEDA - USUARIOS -->

    <div class="modal fade" id="modalLicencias" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Buscar Licencias</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="tablaLicencias">
                        <thead>
                            <tr>
                                <th>Software</th>
                                <th>Version</th>
                                <th>Cantidad Total</th>
                                <th>Cantidad Disponible</th>
                                <th>Tipo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_licencia as $l): ?>
                                <tr>
                                    <td><?php echo $l->software ?></td>
                                    <td><?php echo $l->version ?></td>
                                    <td><?php echo $l->cantidad_total ?></td>
                                    <td><?php echo $l->cantidad_disponible ?></td>
                                    <td><?php echo $l->tipo ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-success seleccionar-licencia"
                                            data-id="<?php echo $l->id ?>"
                                            data-info="<?php echo $l->software . ' - ' . $l->version; ?>">
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

<!-- ... -->
<script src="vendor/realrashid/sweet-alert/resources/js/sweetalert.all.js"></script>
<script src="public/assets/vendor/jquery/jquery.min.js"></script>
<script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="public/assets/js/sb-admin-2.min.js"></script>
<script src="public/assets/vendor/chart.js/Chart.min.js"></script>
<script src="public/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="public/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="public/assets/js/demo/datatables-demo.js"></script>

<!-- ✅ Tu script personalizado VA AQUÍ, después de jQuery -->
<script src="public/js/ajaxEventosAsignacionLicencia.js"></script>
<script src="public/js/ajaxBusqueda.js"></script>

</body>
</html>
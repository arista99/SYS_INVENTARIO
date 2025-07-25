<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="CreacionActivoPC">Crear Activo PC</a>
        <a class="nav-link active ms-0" href="ListaActivoPC">Lista de PC</a>
        <!-- <a class="nav-link active ms-0" href="ListaEquiAcce">Equipos & Accesorios</a> -->
    </nav>

    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>

    <hr class="mt-0 mb-4">
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="activopc" id="activopc" class="form-control" placeholder="Nombre Activo">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarActivoPC" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Lista de ActivoPC</div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered" id="tablaDatosActivoPC" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre Equipo</th>
                                <th class="text-center">Numero de Serie</th>
                                <th class="text-center">Nombre Procesador</th>
                                <th class="text-center">Disco</th>
                                <th class="text-center">Memoria</th>
                                <th class="text-center">Numero Part</th>
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

    <div class="modal fade" id="modalEditarActivoPC" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <!-- id="formEditarUsuario"  -->
            <form id="formEditarActivoPC" autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Activo PC</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_equipo">Actualizar nombre del equipo</label>
                            <input class="form-control" id="edit_equipo" name="edit_equipo" type="text" placeholder="Actualizar Nombre de Equipo">
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_serie">Actualizar numero de serie del equipo</label>
                            <input class="form-control" id="edit_serie" name="edit_serie" type="text" placeholder="Actualizar numero de Serie">
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_part">Actualizar Numero de Part</label>
                            <input class="form-control" id="edit_part" name="edit_part" type="text" placeholder="Actualizar Numero de Part">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_procesador">Actualizar Procesador</label>
                            <input class="form-control" id="edit_procesador" name="edit_procesador" type="text" placeholder="Actualizar Procesasdor">
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_disco">Actualizar Disco</label>
                            <input class="form-control" id="edit_disco" name="edit_disco" type="text" placeholder="Actualizar Disco">
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_memoria">Actualizar Memoria</label>
                            <input class="form-control" id="edit_memoria" name="edit_memoria" type="text" placeholder="Actualizar Memoria">
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_ethernet">Mac Ethernet</label>
                            <input class="form-control" id="edit_ethernet" name="edit_ethernet" type="text" placeholder="Actualizar Ethernet">
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_wireless">Mac Wireless</label>
                            <input class="form-control" id="edit_wireless" name="edit_wireless" type="text" placeholder="Actualizar Wireless">
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_ip">Ingrese IP</label>
                            <input class="form-control" id="edit_ip" name="edit_ip" type="text" placeholder="Actualizar numero de IP">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_usuario">Actualizar Usuario</label>
                            <select class="form-control text-uppercase" id="edit_usuario" name="edit_usuario">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_sede">Actualizar Sede</label>
                            <select class="form-control text-uppercase" id="edit_sede" name="edit_sede">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_categoria">Actualizar Categoria</label>
                            <select class="form-control text-uppercase" id="edit_categoria" name="edit_categoria">
                            </select>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_centro">Actualizar Centro Costo</label>
                            <select class="form-control text-uppercase" id="edit_centro" name="edit_centro">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_area">Actualizar Area</label>
                            <select class="form-control text-uppercase" id="edit_area" name="edit_area">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_fabricante">Actualizar Fabricante</label>
                            <select class="form-control text-uppercase" id="edit_fabricante" name="edit_fabricante">
                            </select>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_proveedor">Actualizar Proveedor</label>
                            <select class="form-control text-uppercase" id="edit_proveedor" name="edit_proveedor">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_condicion">Actualizar Condición</label>
                            <select class="form-control text-uppercase" id="edit_condicion" name="edit_condicion">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_estado">Actualizar Estado</label>
                            <select class="form-control text-uppercase" id="edit_estado" name="edit_estado">
                            </select>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="edit_modelo">Actualizar Modelo</label>
                            <select class="form-control text-uppercase" id="edit_modelo" name="edit_modelo">
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
                    <button type="submit" name="updateInfoButtonActivoPC" id="updateInfoButtonActivoPC" class="btn btn-primary">Actualizar</button>
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

<!-- Select2 CSS y JS -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="public/js/ajaxEventosActivopc.js"></script>
<script src="public/js/ajaxSelectActivopc.js"></script>

</body>

</html>
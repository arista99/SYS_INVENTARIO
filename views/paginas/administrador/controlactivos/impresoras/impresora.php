<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link" href="CreacionImpresoras">Crear Impresora</a>
        <a class="nav-link active ms-0" href="ListaGeneralImpresora">Lista de Impresoras</a>
    </nav>

    <script>
        const id_perfil = <?= json_encode($_SESSION['id_perfil']) ?>;
    </script>

    <hr class="mt-0 mb-4">
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Nombre Modelo">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarImpresora" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Lista de Impresoras</div>
                <div class="card-body">
                    <!-- Table -->
                    <table class="table table-bordered" id="tablaDatosImpresora" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Modelo</th>
                                <th class="text-center">Numero de IP</th>
                                <th class="text-center">Numero Serie</th>
                                <th class="text-center">Fecha de Compra</th>
                                <th class="text-center">Estado</th>
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

    <div class="modal fade" id="modalEditarCelular" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <!-- id="formEditarUsuario" - action="actualizarActivoPC" method="POST"  -->
            <form autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Celular</h5>
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
                        <div class="col-md-6">
                                <label class="small mb-1" for="edit_fecha_compra">Actualizar Fecha Compra</label>
                                <input class="form-control" id="edit_fecha_compra" name="edit_fecha_compra" type="date">
                        </div>
                        <div class="col-md-6">
                                <label class="small mb-1" for="edit_fecha_baja">Actualizar Fecha Baja</label>
                                <input class="form-control" id="edit_fecha_baja" name="edit_fecha_baja" type="date">
                        </div>
                        <div class="col-md-6">
                                <label class="small mb-1" for="edit_fecha_inicio">Actualizar Fecha Inicio Garantia</label>
                                <input class="form-control" id="edit_fecha_inicio" name="edit_fecha_inicio" type="date">
                        </div>
                        <div class="col-md-6">
                                <label class="small mb-1" for="edit_fecha_fin">Actualizar Fecha Fin Garantia</label>
                                <input class="form-control" id="edit_fecha_fin" name="edit_fecha_fin" type="date">
                        </div>

                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_ip">Actualizar IP</label>
                            <input class="form-control" id="edit_ip" name="edit_ip" type="text" placeholder="Actualizar numero de IP">
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_proveedor">Actualizar Proveedor</label>
                            <select class="form-control text-uppercase" id="edit_proveedor" name="edit_proveedor">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_documento">Actualizar Documento</label>
                            <select class="form-control text-uppercase" id="edit_documento" name="edit_documento">
                            </select>
                        </div> 
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_categoria">Actualizar Categoria</label>
                            <select class="form-control text-uppercase" id="edit_categoria" name="edit_categoria">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_fabricante">Actualizar Fabricante</label>
                            <select class="form-control text-uppercase" id="edit_fabricante" name="edit_fabricante">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="edit_modelo">Actualizar Modelo</label>
                            <select class="form-control text-uppercase" id="edit_modelo" name="edit_modelo">
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
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar">Cerrar</button>
                    <button type="submit" name="updateInfoButtonCelular" id="updateInfoButtonCelular" class="btn btn-primary">Actualizar</button>
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

<script src="public/js/ajaxEventosImpresora.js"></script>
<script src="public/js/ajaxCascada.js"></script>

</body>

</html>
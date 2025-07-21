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
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detalle de PC</div>
                <div class="card-body">
                <!-- id="formCrearActivoPC"  - action="registrarActivoPC" method="POST"-->
                    <form id="formCrearActivoPC" autocomplete="off">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="equipo">Nombre del Equipo</label>
                                <input class="form-control" id="equipo" name="equipo" type="text" placeholder="Ingresar Nombre de Equipo">
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="serie">Numero de Serie del equipo</label>
                                <input class="form-control" id="serie" name="serie" type="text" placeholder="Ingresar Numero de Serie">
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="part">Ingrese Numero de Part</label>
                                <input class="form-control" id="part" name="part" type="text" placeholder="Ingresar Numero de Part">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="procesador">Ingrese Procesador</label>
                                <input class="form-control" id="procesador" name="procesador" type="text" placeholder="Ingresar Procesasdor">
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="disco">Ingrese Disco</label>
                                <input class="form-control" id="disco" name="disco" type="text" placeholder="Ingresar Disco">
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="memoria">Ingrese Memoria</label>
                                <input class="form-control" id="memoria" name="memoria" type="text" placeholder="Ingresar Memoria">
                            </div>

                        </div>

                        <!-- INICIO parte oculta -->
                        <div id="campos-extra" style="display: none;">
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="ethernet">Mac Ethernet</label>
                                    <input class="form-control" id="ethernet" name="ethernet" type="text" placeholder="Ingresar Ethernet">
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="wireless">Mac Wireless</label>
                                    <input class="form-control" id="wireless" name="wireless" type="text" placeholder="Ingresar Wireless">
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="ip">Ingrese IP</label>
                                    <input class="form-control" id="ip" name="ip" type="text" placeholder="Ingresar Numero de IP">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="usuario">Usuarios</label>
                                    <select class="form-control text-uppercase" id="usuario" name="usuario">
                                        <option selected disabled>Seleccionar Usuario</option>
                                        <?php foreach ($lista_usuarios as $usuarios) : ?>
                                            <option value="<?php echo $usuarios->id ?>"><?php echo $usuarios->usuario ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="sede">Sedes</label>
                                    <select class="form-control text-uppercase" id="sede" name="sede">
                                        <option selected disabled>Seleccionar Sede</option>
                                        <?php foreach ($lista_sedes as $sedes) : ?>
                                            <option value="<?php echo $sedes->id ?>"><?php echo $sedes->sede ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="categoria">Categorias</label>
                                    <select class="form-control text-uppercase" id="categoria" name="categoria">
                                        <option selected disabled>Seleccionar Sede</option>
                                        <?php foreach ($lista_categorias as $categorias) : ?>
                                            <option value="<?php echo $categorias->id ?>"><?php echo $categorias->categoria ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="centro">Centro Costo</label>
                                    <select class="form-control text-uppercase" id="centro" name="centro">
                                        <option selected disabled>Seleccionar Centro de Costo</option>
                                        <?php foreach ($lista_centros as $centros) : ?>
                                            <option value="<?php echo $centros->id ?>"><?php echo $centros->centro_costo ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="area">Areas</label>
                                    <select class="form-control text-uppercase" id="area" name="area">
                                        <option selected disabled>Seleccionar Area</option>
                                        <?php foreach ($lista_areas as $areas) : ?>
                                            <option value="<?php echo $areas->id ?>"><?php echo $areas->area ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="fabricante">Fabricantes</label>
                                    <select class="form-control text-uppercase" id="fabricante" name="fabricante">
                                        <option selected disabled>Seleccionar Fabricante</option>
                                        <?php foreach ($lista_fabricantes as $fabricantes) : ?>
                                            <option value="<?php echo $fabricantes->id ?>"><?php echo $fabricantes->fabricante ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="proveedor">Proveedores</label>
                                    <select class="form-control text-uppercase" id="proveedor" name="proveedor">
                                        <option selected disabled>Seleccionar Proveedor</option>
                                        <?php foreach ($lista_proveedores as $proveedores) : ?>
                                            <option value="<?php echo $proveedores->id ?>"><?php echo $proveedores->proveedor ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="condicion">Condiciones</label>
                                    <select class="form-control text-uppercase" id="condicion" name="condicion">
                                        <option selected disabled>Seleccionar Condicion</option>
                                        <?php foreach ($lista_condiciones as $condiciones) : ?>
                                            <option value="<?php echo $condiciones->id ?>"><?php echo $condiciones->condicion ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="estado">Estados</label>
                                    <select class="form-control text-uppercase" id="estado" name="estado">
                                        <option selected disabled>Seleccionar Estado</option>
                                        <?php foreach ($lista_estados as $estados) : ?>
                                            <option value="<?php echo $estados->id ?>"><?php echo $estados->estado ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="modelo">Modelos</label>
                                    <select class="form-control text-uppercase" id="modelo" name="modelo">
                                        <option selected disabled>Seleccionar Modelo</option>
                                        <?php foreach ($lista_modelos as $modelos) : ?>
                                            <option value="<?php echo $modelos->id ?>"><?php echo $modelos->modelo ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="documento">Documentos</label>
                                    <select class="form-control text-uppercase" id="documento" name="documento">
                                        <option selected disabled>Seleccionar documento</option>
                                        <?php foreach ($lista_documentos as $docummentos) : ?>
                                            <option value="<?php echo $docummentos->id ?>"><?php echo $docummentos->documento ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- FIN parte oculta -->

                        <!-- BOTÓN toggle -->
                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-outline-secondary" onclick="toggleCampos()">Ver más</button>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-primary" id="btn-registrar-activoPC" name="btn-registrar-activoPC" type="button">
                                Crear Activo
                            </button>

                            <!-- <div>
                                <label for="inputImportExcel" class="btn btn-success mb-0">
                                    <i class="fas fa-file-excel"></i> Importar Inventario Excel
                                </label>
                                <input class="form-control d-none" type="file" id="inputImportExcel" name="inputImportExcel" accept=".xls,.xlsx">
                            </div> -->
                        </div>
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

<script>
    function toggleCampos() {
        const extra = document.getElementById('campos-extra');
        const btn = event.target;
        if (extra.style.display === 'none') {
            extra.style.display = 'block';
            btn.innerText = 'Ver menos';
        } else {
            extra.style.display = 'none';
            btn.innerText = 'Ver más';
        }
    }
</script>

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

<script src="public/js/ajaxEventosExcel.js"></script>
<script src="public/js/ajaxEventosActivopc.js"></script>

</body>

</html>
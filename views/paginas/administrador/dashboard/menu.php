<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Panel de Control</h1>

    <div class="row">

        <!-- Registrar Activo -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="CreacionActivoPC" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Registrar Activo</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Nuevo</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Asignar Activo -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="AsignarActivo" class="text-decoration-none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Asignar Activo</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Usuarios</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Historial de Movimientos -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="HistorialActivos" class="text-decoration-none">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Historial</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Movimientos</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-history fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Reportes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="Reportes" class="text-decoration-none">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Reportes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Estadísticas</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Mantenimiento -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="MantenimientoActivos" class="text-decoration-none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Mantenimiento</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Activos</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tools fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Garantías -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="GarantiasActivos" class="text-decoration-none">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Garantías</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Equipos</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shield-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div> <!-- Fin fila de botones -->

</div>
<!-- /.container-fluid -->

<!-- Footer -->
<?php include_once('views/modulos/footer.php'); ?>
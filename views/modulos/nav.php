<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <!-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a> -->
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <!-- <li class="nav-item dropdown no-arrow mx-1"> -->
            <!-- <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>

                <span class="badge badge-danger badge-counter">0</span>
            </a> -->

            <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">

                <h6 class="dropdown-header">Alerta Personal de Cese</h6> -->

                <!-- Aquí AJAX inserta -->
            <!-- </div> -->
        <!-- </li> -->


        <!-- Nav Item - Messages -->
        <!-- <li class="nav-item dropdown no-arrow mx-1"> -->
            <!-- <a class="nav-link dropdown-toggle" href="#" id="mantenimientosDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tools fa-fw"></i>
                <!-- Contador de equipos en mantenimiento -->
                <!-- <span class="badge badge-danger badge-counter"> -->
                    <!-- <?php echo $totalMantenimientos; ?> -->
                <!-- </span> -->
            <!-- </a>  -->

            <!-- Dropdown - Mantenimientos -->
            <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="mantenimientosDropdown">
                <h6 class="dropdown-header">
                    Equipos en Mantenimiento
                </h6> -->

                <!-- <?php if ($totalMantenimientos > 0): ?>
                    <?php while ($m = $detalles->fetch_assoc()): ?>
                        <a class="dropdown-item d-flex align-items-center" href="DetalleMantenimiento.php?id=<?php echo $m['id']; ?>">
                            <div class="dropdown-list-image mr-3">
                                <i class="fas fa-laptop text-primary fa-2x"></i>
                            </div>
                            <div>
                                <div class="text-truncate">
                                    <?php echo $m['nom_equipo']; ?> (<?php echo $m['estado']; ?>)
                                </div>
                                <div class="small text-gray-500">
                                    Desde: <?php echo date("d-m-Y", strtotime($m['fecha_inicio'])); ?>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                    <a class="dropdown-item text-center small text-gray-500" href="MantenimientoActivos">Ver todos</a>
                <?php else: ?> -->
                <!-- <div class="dropdown-item text-center small text-gray-500">No hay equipos en mantenimiento</div> -->
                <!-- <?php endif; ?> -->
            <!-- </div> -->
        <!-- </li> -->


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase"><?php echo $usuario->nombre ?></span>
                <img class="img-profile rounded-circle"
                    src="public/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuración
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="Close" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar Sesión
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
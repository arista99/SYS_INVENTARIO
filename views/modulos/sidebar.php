<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardControl">
        <div class="sidebar-brand-text mx-3">Transber<sup>Pe</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="DashboardControl">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- CONTROL -->
    <div class="sidebar-heading">Interfaces</div>

    <!-- Módulos -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesActivos"
           aria-expanded="false" aria-controls="collapsePagesActivos">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Control de Activos</span>
        </a>
        <div id="collapsePagesActivos" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="CreacionDeskLap">Laptops & Desktop</a>
                <a class="collapse-item" href="CreacionAccesorio">Accesorios</a>
                <a class="collapse-item" href="CreacionLicencias">Licencias</a>
                <a class="collapse-item" href="CreacionCelulares">Celulares</a>
                <a class="collapse-item" href="CreacionImpresoras">Impresoras</a>
                <a class="collapse-item" href="CreacionInfraestructura">Infraestructura</a>
            </div>
        </div>
    </li>    

    <!-- DOCUMENTOS Y PROVEEDORES -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesGestion"
           aria-expanded="false" aria-controls="collapsePagesGestion">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Control de Gestión</span>
        </a>
        <div id="collapsePagesGestion" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="CreacionUsuarios">Control de Usuarios</a>
                <a class="collapse-item" href="CreacionProveedores">Control de Proveedores</a>
                <a class="collapse-item" href="CreacionDocumentos">Control de Documentos</a>
            </div>

        </div>
    </li>

    <!-- DOCUMENTOS Y PROVEEDORES -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesMovimientos"
           aria-expanded="false" aria-controls="collapsePagesMovimientos">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Control de Movimientos</span>
        </a>
        <div id="collapsePagesMovimientos" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="ControlAsignacionActivo">Asignación Activo</a>
                <a class="collapse-item" href="ControlAsignacionAccesorio">Asignación Accesorio</a>
                <a class="collapse-item" href="ControlActivos">Historial Activos</a>
                <a class="collapse-item" href="ControlMantenimientos">Mantenimientos</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Parametros -->
    <div class="sidebar-heading">Catálogos</div>

    <!-- Recursos -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesAddon"
           aria-expanded="false" aria-controls="collapsePagesAddon">
            <i class="fas fa-fw fa-folder"></i>
            <span>Control de Parametros</span>
        </a>
        <div id="collapsePagesAddon" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="CreacionCategorias">Categorias</a>
                <a class="collapse-item" href="CreacionFabricantes">Fabricantes</a>
                <a class="collapse-item" href="CreacionModelos">Modelos</a>
                <a class="collapse-item" href="CreacionAreas">Areas</a>
                <a class="collapse-item" href="CreacionCentroCostos">Centro de Costo</a>
            </div>
        </div>
    </li>

    <!-- Reportes -->  
    <li class="nav-item">
        <a class="nav-link" href="ControlReportesGeneral">
            <i class="fas fa-fw fa-table"></i>
            <span>Reportes</span>
        </a>
    </li>
  

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

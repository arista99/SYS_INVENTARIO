<?php
// --- obtener la "ruta actual" de forma segura ---
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
$current_raw = basename($uri_path); 

// --- obtener usuario global
// $usuario = $_SESSION["id_perfil"];

// --- whitelist de páginas válidas ---
$allowed_pages = [
    'DashboardControl',
    'CreacionDeskLap','ListaGeneralDeskLap',
    'CreacionAccesorio','ListaGeneralAccesorio',
    'CreacionLicencias','ListaGeneralLicencias',
    'CreacionCelulares','ListaGeneralCelular',
    'CreacionImpresoras','ListaGeneralImpresora',
    'CreacionInfraestructura','ListaGeneralInfraestructura',
    'CreacionUsuarios','ListaGenerealUsuarios',
    'CreacionProveedores','ListaGeneralProveedores',
    'CreacionDocumentos','ListaGeneralDocumentos',
    'ControlAsignacionActivo','ListaGeneralAsignacionActivo',
    'ControlAsignacionAccesorio','ListaGeneralAsignacionAccesorio',
    'ControlAsignacionLicencia','ListaGeneralAsignacionLicencia',
    'HistorialActivos','HistorialAccesorios',
    'CreacionCategorias','CreacionFabricantes','CreacionModelos',
    'CreacionAreas','CreacionCentroCostos',
    'ControlReportesGeneral',
    'ControlMantenimientos','ListaGeneralMantenimiento'
];

// Determinar página actual
$current = in_array($current_raw, $allowed_pages, true) ? $current_raw : 'DashboardControl';

// Helper general para manejar collapse
function getCollapseState(array $pages, string $current)
{
    return in_array($current, $pages, true)
        ? ['show' => 'show', 'aria' => 'true', 'collapsed' => '']
        : ['show' => '', 'aria' => 'false', 'collapsed' => 'collapsed'];
}

// Definir grupos de secciones
$activos_pages = [
    'CreacionDeskLap','ListaGeneralDeskLap',
    'CreacionAccesorio','ListaGeneralAccesorio',
    'CreacionLicencias','ListaGeneralLicencias',
    'CreacionCelulares','ListaGeneralCelular',
    'CreacionImpresoras','ListaGeneralImpresora',
    'CreacionInfraestructura','ListaGeneralInfraestructura'
];

$gestion_pages = [
    'CreacionUsuarios','ListaGenerealUsuarios',
    'CreacionProveedores','ListaGeneralProveedores',
    'CreacionDocumentos','ListaGeneralDocumentos'
];

$movimientos_pages = [
    'ControlAsignacionActivo','ListaGeneralAsignacionActivo',
    'ControlAsignacionAccesorio','ListaGeneralAsignacionAccesorio',
    'ControlAsignacionLicencia','ListaGeneralAsignacionLicencia',
    'HistorialActivos','HistorialAccesorios',
    'ControlMantenimientos','ListaGeneralMantenimiento'
];

$parametros_pages = [
    'CreacionCategorias','CreacionFabricantes',
    'CreacionModelos','CreacionAreas','CreacionCentroCostos'
];

// Obtener estados de cada grupo
$collapse_activos     = getCollapseState($activos_pages, $current);
$collapse_gestion     = getCollapseState($gestion_pages, $current);
$collapse_movimientos = getCollapseState($movimientos_pages, $current);
$collapse_parametros  = getCollapseState($parametros_pages, $current);
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardControl">
        <div class="sidebar-brand-text mx-3">Transber<sup>Pe</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= $current === 'DashboardControl' ? 'active' : '' ?>">
        <a class="nav-link" href="DashboardControl">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- CONTROL -->
    <div class="sidebar-heading">Interfaces</div>

    <!-- Control de Activos -->
    <li class="nav-item">
        <a class="nav-link <?= $collapse_activos['collapsed'] ?>"
            href="#" data-toggle="collapse" data-target="#collapsePagesActivos"
            aria-expanded="<?= $collapse_activos['aria'] ?>"
            aria-controls="collapsePagesActivos">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Control de Activos</span>
        </a>
        <div id="collapsePagesActivos"
             class="collapse <?= $collapse_activos['show'] ?>"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= in_array($current, ['CreacionDeskLap','ListaGeneralDeskLap'], true) ? 'active' : '' ?>" href="ListaGeneralDeskLap">Laptops & Desktop</a>
                <a class="collapse-item <?= in_array($current, ['CreacionAccesorio','ListaGeneralAccesorio'], true) ? 'active' : '' ?>" href="ListaGeneralAccesorio">Accesorios</a>
                <a class="collapse-item <?= in_array($current, ['CreacionLicencias','ListaGeneralLicencias'], true) ? 'active' : '' ?>" href="ListaGeneralLicencias">Licencias</a>
                <a class="collapse-item <?= in_array($current, ['CreacionCelulares','ListaGeneralCelular'], true) ? 'active' : '' ?>" href="ListaGeneralCelular">Celulares</a>
                <a class="collapse-item <?= in_array($current, ['CreacionImpresoras','ListaGeneralImpresora'], true) ? 'active' : '' ?>" href="ListaGeneralImpresora">Impresoras</a>
                <!-- <a class="collapse-item <?= in_array($current, ['CreacionInfraestructura','ListaGeneralInfraestructura'], true) ? 'active' : '' ?>" href="ListaGeneralInfraestructura">Infraestructura</a> -->
            </div>
        </div>
    </li>

    <!-- Control de Gestión -->
    <li class="nav-item">
        <a class="nav-link <?= $collapse_gestion['collapsed'] ?>"
            href="#" data-toggle="collapse" data-target="#collapsePagesGestion"
            aria-expanded="<?= $collapse_gestion['aria'] ?>"
            aria-controls="collapsePagesGestion">
            <i class="fas fa-fw fa-folder"></i>
            <span>Control de Gestión</span>
        </a>
        <div id="collapsePagesGestion"
             class="collapse <?= $collapse_gestion['show'] ?>"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= in_array($current, ['CreacionUsuarios','ListaGenerealUsuarios'], true) ? 'active' : '' ?>" href="ListaGenerealUsuarios">Usuarios</a>
                <a class="collapse-item <?= in_array($current, ['CreacionProveedores','ListaGeneralProveedores'], true) ? 'active' : '' ?>" href="ListaGeneralProveedores">Proveedores</a>
                <a class="collapse-item <?= in_array($current, ['CreacionDocumentos','ListaGeneralDocumentos'], true) ? 'active' : '' ?>" href="ListaGeneralDocumentos">Documentos</a>
            </div>
        </div>
    </li>

    <!-- Control de Movimientos -->
    <li class="nav-item">
        <a class="nav-link <?= $collapse_movimientos['collapsed'] ?>"
            href="#" data-toggle="collapse" data-target="#collapsePagesMovimientos"
            aria-expanded="<?= $collapse_movimientos['aria'] ?>"
            aria-controls="collapsePagesMovimientos">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Control de Movimientos</span>
        </a>
        <div id="collapsePagesMovimientos"
             class="collapse <?= $collapse_movimientos['show'] ?>"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= in_array($current, ['ControlAsignacionActivo','ListaGeneralAsignacionActivo'], true) ? 'active' : '' ?>" href="ListaGeneralAsignacionActivo">Asignación Activo</a>
                <a class="collapse-item <?= in_array($current, ['ControlAsignacionAccesorio','ListaGeneralAsignacionAccesorio'], true) ? 'active' : '' ?>" href="ListaGeneralAsignacionAccesorio">Asignación Accesorio</a>
                <a class="collapse-item <?= in_array($current, ['ControlAsignacionLicencia','ListaGeneralAsignacionLicencia'], true) ? 'active' : '' ?>" href="ListaGeneralAsignacionLicencia">Asignación Licencia</a>
                <a class="collapse-item <?= in_array($current, ['HistorialActivos','HistorialAccesorios'], true) ? 'active' : '' ?>" href="HistorialActivos">Historial</a>
                <a class="collapse-item <?= in_array($current, ['ControlMantenimientos','ListaGeneralMantenimiento'], true) ? 'active' : '' ?>" href="ListaGeneralMantenimiento">Mantenimientos</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Parámetros -->
    <div class="sidebar-heading">Catálogos</div>

    <li class="nav-item">
        <a class="nav-link <?= $collapse_parametros['collapsed'] ?>"
            href="#" data-toggle="collapse" data-target="#collapsePagesAddon"
            aria-expanded="<?= $collapse_parametros['aria'] ?>"
            aria-controls="collapsePagesAddon">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Control de Parámetros</span>
        </a>
        <div id="collapsePagesAddon"
             class="collapse <?= $collapse_parametros['show'] ?>"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= in_array($current, ['CreacionCategorias'], true) ? 'active' : '' ?>" href="CreacionCategorias">Categorías</a>
                <a class="collapse-item <?= in_array($current, ['CreacionFabricantes'], true) ? 'active' : '' ?>" href="CreacionFabricantes">Fabricantes</a>
                <a class="collapse-item <?= in_array($current, ['CreacionModelos'], true) ? 'active' : '' ?>" href="CreacionModelos">Modelos</a>
                <a class="collapse-item <?= in_array($current, ['CreacionAreas'], true) ? 'active' : '' ?>" href="CreacionAreas">Áreas</a>
                <a class="collapse-item <?= in_array($current, ['CreacionCentroCostos'], true) ? 'active' : '' ?>" href="CreacionCentroCostos">Centro de Costo</a>
            </div>
        </div>
    </li>

    <!-- Reportes -->
    <li class="nav-item <?= $current === 'ControlReportesGeneral' ? 'active' : '' ?>">
        <a class="nav-link" href="ControlReportesGeneral">
            <i class="fas fa-fw fa-table"></i>
            <span>Reportes</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

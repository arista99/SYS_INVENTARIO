<?php
include_once('controller/controlIndex.php');
include_once('controller/controlDashboard.php');
include_once('controller/controlCuentas.php');
include_once('controller/controlAreas.php');
include_once('controller/controlCategorias.php');
include_once('controller/controlCentroCostos.php');
include_once('controller/controlFabricantes.php');
include_once('controller/controlModelos.php');
include_once('controller/controlProveedores.php');
include_once('controller/controlDocumentos.php');
include_once('controller/controlLicencias.php');
include_once('controller/controlDeskLap.php');
include_once('controller/controlAccesorios.php');
include_once('controller/controlReportes.php');
include_once('controller/controlCelulares.php');
include_once('controller/controlImpresoras.php');
include_once('controller/controlInfraestructura.php');
include_once('controller/controlAsignacionActivo.php');
include_once('controller/controlAsignacionAccesorios.php');
include_once('controller/controlHistorialActivos.php');

//PARA LOS CARACTERES EXTRAÑOS
header('Content-Type: text/html; charset=utf-8');

//ZONA DE HORARIO
date_default_timezone_set("America/Lima");

//VARIABLES CONTROLADORES
$controlIndex = new ControlIndex();
$controlDashboard = new ControlDashboard();
$controlCuentas = new ControlCuentas();
$controlAreas = new ControlAreas();
$controlCategorias = new ControlCategorias();
$controlCentroCostos = new ControlCentroCostos();
$controlFabricantes = new ControlFabricantes();
$controlModelos = new ControlModelos();
$controlProveedores = new ControlProveedores();
$controlDocumentos = new ControlDocumentos();
$controlLicencias = new ControlLicencias();
$controlDeskLap = new ControlDeskLap();
$controlAccesorios = new ControlAccesorios();
$controlReportes = new ControlReportes();
$controlCelulares = new ControlCelulares();
$controlImpresoras = new ControlImpresoras();
$controlInfraestructuras = new ControlInfraestructuras();
$controlAsignacionActivo = new ControlAsignacionActivo();
$controlAsignacionAccesorio = new ControlAsignacionAccesorio();
$controlHistorialActivos = new ControlHistorialActivos();

//LLAMADA DE LOS METODOS
if (!isset($_REQUEST['ruta'])) {
    $controlIndex->Index();
} else {
    $peticion = $_REQUEST['ruta'];
    if (method_exists($controlIndex, $peticion)) {
        call_user_func(array($controlIndex, $peticion));
    }elseif (method_exists($controlDashboard, $peticion)) {
        call_user_func(array($controlDashboard, $peticion));
    }elseif (method_exists($controlCuentas, $peticion)) {
        call_user_func(array($controlCuentas, $peticion));
    }elseif (method_exists($controlAreas, $peticion)) {
        call_user_func(array($controlAreas, $peticion));
    }elseif (method_exists($controlCategorias, $peticion)) {
        call_user_func(array($controlCategorias, $peticion));
    }elseif (method_exists($controlCentroCostos, $peticion)) {
        call_user_func(array($controlCentroCostos, $peticion));
    }elseif (method_exists($controlFabricantes, $peticion)) {
        call_user_func(array($controlFabricantes, $peticion));
    }elseif (method_exists($controlModelos, $peticion)) {
        call_user_func(array($controlModelos, $peticion));
    }elseif (method_exists($controlProveedores, $peticion)) {
        call_user_func(array($controlProveedores, $peticion));
    }elseif (method_exists($controlDocumentos, $peticion)) {
        call_user_func(array($controlDocumentos, $peticion));
    }elseif (method_exists($controlLicencias, $peticion)) {
        call_user_func(array($controlLicencias, $peticion));
    }elseif (method_exists($controlDeskLap, $peticion)) {
        call_user_func(array($controlDeskLap, $peticion));
    }elseif (method_exists($controlAccesorios, $peticion)) {
        call_user_func(array($controlAccesorios, $peticion));
    }elseif (method_exists($controlReportes, $peticion)) {
        call_user_func(array($controlReportes, $peticion));
    }elseif (method_exists($controlCelulares, $peticion)) {
        call_user_func(array($controlCelulares, $peticion));
    }elseif (method_exists($controlImpresoras, $peticion)) {
        call_user_func(array($controlImpresoras, $peticion));
    }elseif (method_exists($controlInfraestructuras, $peticion)) {
        call_user_func(array($controlInfraestructuras, $peticion));
    }elseif (method_exists($controlAsignacionActivo, $peticion)) {
        call_user_func(array($controlAsignacionActivo, $peticion));
    }elseif (method_exists($controlAsignacionAccesorio, $peticion)) {
        call_user_func(array($controlAsignacionAccesorio, $peticion));
    }elseif (method_exists($controlHistorialActivos, $peticion)) {
        call_user_func(array($controlHistorialActivos, $peticion));
    }else{
        $controlIndex->Index();
    }
}



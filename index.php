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
include_once('controller/controlAdjuntos.php');
include_once('controller/controlDocumentos.php');
include_once('controller/controlLicencias.php');
include_once('controller/controlActivosPc.php');

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
$controlCentroCostos = new controlCentroCostos();
$controlFabricantes = new controlFabricantes();
$controlModelos = new controlModelos();
$controlProveedores = new ControlProveedores();
$ControlAdjuntos = new ControlAdjuntos();
$ControlDocumentos = new ControlDocumentos();
$ControlLicencias = new ControlLicencias();
$ControlActivosPc = new ControlActivosPc();

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
    }elseif (method_exists($ControlAdjuntos, $peticion)) {
        call_user_func(array($ControlAdjuntos, $peticion));
    }elseif (method_exists($ControlDocumentos, $peticion)) {
        call_user_func(array($ControlDocumentos, $peticion));
    }elseif (method_exists($ControlLicencias, $peticion)) {
        call_user_func(array($ControlLicencias, $peticion));
    }elseif (method_exists($ControlActivosPc, $peticion)) {
        call_user_func(array($ControlActivosPc, $peticion));
    }else{
        $controlIndex->Index();
    }
}



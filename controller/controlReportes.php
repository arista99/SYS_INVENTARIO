<?php
//MODEL
include_once('model/modelHelpers.php');
//DATA


class ControlReportes
{
    //VARIABLE MODELO
    public $HELPERS;


    public function __construct()
    {
        $this->HELPERS = new ModeloHelpers();
    }

    public function ControlReportesGeneral()
    {
        // Iniciar sesión
        session_start();
        
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
        //     Redirigir al login si no está autenticado
           header("Location: Index");
            exit;
        }

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);
        include_once('views/paginas/administrador/reportes/reporte.php');
    }
}
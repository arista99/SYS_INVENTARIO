<?php
//MODEL
include_once('model/modelHelpers.php');
include_once('model/modelReportes.php');
//DATA


class ControlReportes
{
    //VARIABLE MODELO
    public $HELPERS;
    public $REPORTES;


    public function __construct()
    {
        $this->HELPERS = new ModeloHelpers();
        $this->REPORTES = new ModeloReportes();
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

    public function listarActivosAreas()
    {
        $activosPorArea = $this->REPORTES->activosAreas();

        echo json_encode($activosPorArea);
    }

      public function listarActivosEstados()
    {
        $activosPorEstado = $this->REPORTES->activosEstados();

        echo json_encode($activosPorEstado);
    }
}
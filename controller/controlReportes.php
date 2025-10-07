<?php
//MODEL

//DATA


class ControlReportes
{
    //VARIABLE MODELO
    public $CUENTAS;
    public $PERFILES;
    public $SEDES;
    public $CENTRO;
    public $AREA;
    public $ACTIVO;

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
        $this->PERFILES = new ModeloPerfiles();
        $this->SEDES = new ModeloSedes();
        $this->CENTRO = new ModeloCentroCostos();
        $this->AREA = new ModeloAreas();
        $this->ACTIVO = new ModeloActivosPC();
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

        $usuario = $this->CUENTAS->readUsuario($_SESSION['id']);
        include_once('views/paginas/administrador/reportes/reporte.php');
    }
}
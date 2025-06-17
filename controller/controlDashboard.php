<?php
//MODEL
include_once('model/modelCuentas.php');
//DATA


class ControlDashboard
{
    //VARIABLE MODELO
    public $CUENTAS;

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
    }
    public function DashboardControl()
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

        include_once('views/paginas/administrador/dashboard/menu.php');
    }

}
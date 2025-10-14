<?php
//MODEL
require_once('model/modelImpresoras.php');
require_once('model/modelHelpers.php');
//DATA
require_once('data/impresora.php');

class ControlImpresoras
{
    //VARIABLE MODELO

    public $IMPRESORAS;
    public $HELPERS;

    public function __construct()
    {
        $this->HELPERS = new ModeloHelpers();
    }
    
    public function CreacionImpresoras()
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

        include_once('views/paginas/administrador/controlactivos/impresoras/creacion.php');
    }
}
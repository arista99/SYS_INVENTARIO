<?php
//MODEL
require_once('model/modelCelulares.php');
require_once('model/modelHelpers.php');
//DATA
require_once('data/celular.php');

class ControlCelulares
{
    //VARIABLE MODELO

    public $CELULARES;
    public $HELPERS;

    public function __construct()
    {
        $this->HELPERS = new ModeloHelpers();
    }
    
    public function CreacionCelulares()
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

        include_once('views/paginas/administrador/controlactivos/celulares/creacion.php');
    }
}
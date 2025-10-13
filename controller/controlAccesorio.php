<?php

//MODEL
require_once('model/modelAccesorio.php');
include_once('model/modelHelpers.php');
//DATA
require_once('data/accesorio.php');

class ControlAccesorios
{
    //VARIABLE MODELO
    public $ACCESORIO;
    public $HELPERS;

    public function __construct()
    {
        $this->ACCESORIO = new ModeloAccesorio();
        $this->HELPERS = new ModeloHelpers();

    }

    public function CreacionAccesorio()
    {
        // Iniciar sesión
        session_start();
        
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
        //     Redirigir al login si no está autenticado
           header("Location: Index");
            exit;
        }

        $lista_usuarios = $this->HELPERS->ListarUsuario();
        $lista_centro_costo = $this->HELPERS->ListarCentrosCosto();
        $lista_categorias = $this->HELPERS->ListarCategoriaAccesorio();
        $lista_proveedores = $this->HELPERS->ListarProveedor();
        $lista_condiciones = $this->HELPERS->ListarCondiciones();
        $lista_estados = $this->HELPERS->ListarEstados();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/accesorios/creacion.php');

    }

    public function ListaGeneralAccesorio()
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

        include_once('views/paginas/administrador/controlactivos/accesorios/accesorio.php');
    }
}
<?php

//MODEL
require_once('model/modelCuentas.php');
require_once('model/modelAccesorio.php');
include_once('model/modelHelpers.php');
//DATA
require_once('data/accesorio.php');

class ControlAccesorios
{
    //VARIABLE MODELO
    public $CUENTAS;
    public $ACCESORIO;
    public $HELPERS;

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
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

        $lista_usuarios = $this->CUENTAS->listUsuarios();
        $lista_sedes = $this->SEDES->readSedes();
        $lista_categorias = $this->CATEGORIAS->readCategoria();
        $lista_areas = $this->AREAS->readAreas();
        $lista_fabricantes = $this->FABRICANTES->readFabricante();
        $lista_proveedores = $this->PROVEEDORES->readProveedores();
        $lista_condiciones = $this->CONDICIONES->readCondicion();
        $lista_estados = $this->ESTADOS->readEstado();
        $lista_modelos = $this->MODELOS->readModelo();
        $lista_documentos = $this->DOCUMENTOS->readDocumento();

        $usuario = $this->CUENTAS->readUsuario($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/accesorios/creacion.php');

    }

    public function ListaAccesorio()
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

        $lista_usuario = $this->CUENTAS->listUsuarios();
        $lista_activopc = $this->ACTIVO->readActivoPC();
        $lista_accesorio = $this->ACCESORIO->readAccesorio();

        // include_once('views/paginas/administrador/modulos/cuentas/asignacion.php');
    }
}
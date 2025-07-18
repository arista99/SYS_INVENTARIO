<?php
//MODEL

include_once('model/modelActivosPc.php');
include_once('model/modelCuentas.php');
include_once('model/modelSede.php');
include_once('model/modelCategorias.php');
include_once('model/modelCentroCostos.php');
include_once('model/modelAreas.php');
include_once('model/modelFabricantes.php');
include_once('model/modelProveedores.php');
include_once('model/modelCondiciones.php');
include_once('model/modelEstados.php');
include_once('model/modelModelos.php');
include_once('model/modelDocumentos.php');

//DATA

include_once('data/activospc.php');

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

class ControlActivosPc{
    //VARIABLE MODELO
    public $ACTIVOSPC;
    public $CUENTAS;
    public $SEDES;
    public $CATEGORIAS;
    public $CENTROCOSTO;
    public $AREAS;
    public $FABRICANTES;
    public $PROVEEDORES;
    public $CONDICIONES;
    public $ESTADOS;
    public $MODELOS;
    public $DOCUMENTOS;


    public function __construct()
    {
        $this->ACTIVOSPC = new ModeloActivosPC();
        $this->CUENTAS = new ModeloCuentas();
        $this->SEDES = new ModeloSedes();
        $this->CATEGORIAS = new ModeloCategorias();
        $this->CENTROCOSTO = new ModeloCentroCostos();
        $this->AREAS = new ModeloAreas();
        $this->FABRICANTES = new ModeloFabricantes();
        $this->PROVEEDORES = new ModeloProveedores();
        $this->CONDICIONES = new ModeloCondiciones();
        $this->ESTADOS = new ModeloEstados();
        $this->MODELOS = new ModeloModelos();
        $this->DOCUMENTOS = new ModeloDocumentos();
    }

    public function CreacionActivoPC()
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
        $lista_sedes= $this->SEDES->readSedes();
        $lista_categorias= $this->CATEGORIAS->readCategoria();
        $lista_centros = $this->CENTROCOSTO->readCentro();
        $lista_areas= $this->AREAS->readAreas();
        $lista_fabricantes= $this->FABRICANTES->readFabricante();
        $lista_proveedores= $this->PROVEEDORES->readProveedores();
        $lista_condiciones= $this->CONDICIONES->readCondicion();
        $lista_estados= $this->ESTADOS->readEstado();
        $lista_modelos= $this->MODELOS->readModelo();
        $lista_documentos= $this->DOCUMENTOS->readDocumento();

        $usuario = $this->CUENTAS->readUsuario($_SESSION['id']);

        include_once('views/paginas/administrador/activos/activospc.php');
    }

    public function importarExcelActivoPC()
    {
        if (isset($_FILES['archivoExcel'])) {
            $fileTmp = $_FILES['archivoExcel']['tmp_name'];

            $spreadsheet = IOFactory::load($fileTmp);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // echo "<pre>";
            // print_r($rows);
            // echo "</pre>";
            // exit;

            // Procesar cada fila (saltando encabezado)
            for ($i = 1; $i < count($rows); $i++) {
              $insert_excel =  $this->ACTIVOSPC->insertarFilaInventario($rows[$i]);
            }

            // echo "<pre>";
            // var_dump($insert_excel);
            // echo "</pre>";
            // exit;

            echo "Importación exitosa";
        } else {
            echo "No se recibió el archivo.";
        }
    }
}
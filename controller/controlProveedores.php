<?php
//MODEL
require_once('model/modelProveedores.php');
require_once('model/modelCuentas.php');

require_once('model/modelProductos.php');
require_once('model/modelDocumentos.php');

//DATA
require_once('data/proveedor.php');

class ControlProveedores
{
    //VARIABLE MODELO
    public $CUENTAS;
    public $PROVEEDORES;
    public $PRODUCTOS;
    public $DOCUMENTOS;

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
        $this->PROVEEDORES = new ModeloProveedores();
        $this->DOCUMENTOS = new ModeloDocumentos();
        $this->PRODUCTOS = new ModeloProductos();
    }

    public function CreacionProveedores()
    {
        // Iniciar sesión
        session_start();
        
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
        //     Redirigir al login si no está autenticado
           header("Location: Index");
            exit;
        }

        $productos_tra = $this->PRODUCTOS->readProducto();
        $documentos_tra = $this->DOCUMENTOS->readDocumento();


        $usuario = $this->CUENTAS->readUsuario($_SESSION['id']);

        include_once('views/paginas/administrador/proveedores/creacion.php');
    }

    public function ListaProveedores()
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

        include_once('views/paginas/administrador/proveedores/proveedores.php');
    }


    public function vistaProveedor()
    {
        // Obtener valores desde la solicitud AJAX
        $proveedor = $_POST['proveedor'] ?? '';

        // Llama al modelo
        $resultados = $this->PROVEEDORES->findProveedor($proveedor);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function listaProducto()
    {
        // Simula datos desde la BD
        $centros = $this->PRODUCTOS->readProducto(); // Array de objetos con idcentro y centro_costo

        echo json_encode($centros);
    }

    public function listaDocumento()
    {
        // Simula datos desde la BD
        $sedes = $this->DOCUMENTOS->readDocumento(); // Array de objetos con idcentro y centro_costo

        echo json_encode($sedes);
    }
}
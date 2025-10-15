<?php

//MODEL
require_once('model/modelAccesorios.php');
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
        $this->ACCESORIO = new ModeloAccesorios();
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

    public function findAccesorio()
    {
        // Obtener valores desde la solicitud AJAX
        $accesorio = $_POST['accesorio'] ?? '';

        // Llama al modelo
        $resultados = $this->ACCESORIO->findAccesorio($accesorio);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarAccesorio()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $accesorio = new Accesorio();
                $accesorio->setnombre($_POST['nombre']);
                $accesorio->setns($_POST['serie']);
                $accesorio->setid_categoria($_POST['categoria']);
                $accesorio->setid_fabricante($_POST['fabricante']);
                $accesorio->setid_condicion($_POST['condicion']);
                $accesorio->setid_estado($_POST['estado']);
                $accesorio->setid_proveedor($_POST['proveedor']);
                $accesorio->setid_documento(!empty($_POST['documento']) ? $_POST['documento'] : null);

                //llamando al insert de modelo solicitud
                $create_accesorio = $this->ACCESORIO->createAccesorios($accesorio);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_accesorio) {
                    echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear el usuario']);
                }
            } else {
                // Si no es una solicitud POST, enviar un mensaje de error
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            }
        } catch (\Throwable $th) {
            // Manejo de excepciones: devolver el mensaje de error
            echo json_encode(['success' => false, 'message' => $th->getMessage()]);
            // echo $th->getMessage();
        }
    }

    public function listaCategoriaAccesorio()
    {
        $categoria = $this->HELPERS->ListarCategoriaAccesorio();

        echo json_encode($categoria);
    }

    public function listaFabricante()
    {
        $id_categoria = filter_input(INPUT_POST, 'dato_mandar_servidor');

        $fabricante = $this->HELPERS->ListarFabricantes($id_categoria);
        
        echo json_encode($fabricante);
    }

    public function listaFabricanteEdit()
    {
        $fabricante = $this->HELPERS->ListarFabricantesEdit();
        
        echo json_encode($fabricante);
    }

    public function listaCondiciones()
    {
        $condicion = $this->HELPERS->ListarCondiciones();

        echo json_encode($condicion);
    }

    public function listaEstado()
    {
        $estado = $this->HELPERS->ListarEstados();

        echo json_encode($estado);
    }

    public function listaProveedores()
    {
        $proveedor = $this->HELPERS->ListarProveedor();

        echo json_encode($proveedor);
    }

    public function listaDocumentos()
    {
        $id_proveedor = filter_input(INPUT_POST, 'dato_mandar_servidor');

        $documento = $this->HELPERS->ListarDocumentos($id_proveedor);

        echo json_encode($documento);
    }

    public function listaDocumentosEdit()
    {
        $documento = $this->HELPERS->ListarDocumentosEdit();

        echo json_encode($documento);
    }

    
}
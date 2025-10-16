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
        $this->IMPRESORAS = New ModeloImpresoras();
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

        $lista_condiciones = $this->HELPERS->ListarCondiciones();
        $lista_estados = $this->HELPERS->ListarEstados();
        $lista_proveedores = $this->HELPERS->ListarProveedor();
        $lista_categorias= $this->HELPERS->ListarCategoriaImpresora();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);
        include_once('views/paginas/administrador/controlactivos/impresoras/creacion.php');
    }

    public function ListaGeneralImpresora()
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

        include_once('views/paginas/administrador/controlactivos/impresoras/impresora.php');
    }

    public function findImpresora()
    {
        // Obtener valores desde la solicitud AJAX
        $impresora = $_POST['modelo'] ?? '';

        // Llama al modelo
        $resultados = $this->IMPRESORAS->findImpresora($impresora);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarImpresora()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $impresora = new Impresora();
                $impresora->setip($_POST['ip']);
                $impresora->setns($_POST['serie']);
                $impresora->setfecha_compra($_POST['fecha_compra']);
                $impresora->setid_categoria($_POST['categoria']);
                $impresora->setid_fabricante($_POST['fabricante']);
                $impresora->setid_modelo($_POST['modelo']);
                $impresora->setid_condicion($_POST['condicion']);
                $impresora->setid_estado($_POST['estado']);
                $impresora->setid_proveedor($_POST['proveedor']);
                $impresora->setid_documento(!empty($_POST['documento']) ? $_POST['documento'] : null);

                //llamando al insert de modelo solicitud
                $create_impresora= $this->IMPRESORAS->createImpresoras($impresora);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_impresora) {
                    echo json_encode(['success' => true, 'message' => 'Impresora registrado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear el imprimir']);
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

    public function listaCategoriaImpresora()
    {
        $categoria = $this->HELPERS->ListarCategoriaImpresora();

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

    public function listaModelo()
    {
        $id_fabricante = filter_input(INPUT_POST, 'dato_mandar_servidor');

        $modelo = $this->HELPERS->ListarModelos($id_fabricante);

        echo json_encode($modelo);
    }

    public function listaModeloEdit()
    {
        $modelo = $this->HELPERS->ListarModelosEdit();

        echo json_encode($modelo);
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
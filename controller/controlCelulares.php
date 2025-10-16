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
        $this->CELULARES = new ModeloCelulares();
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
        $lista_categorias = $this->HELPERS->ListarCategoriaCelular();
        $lista_proveedores = $this->HELPERS->ListarProveedor();
        $lista_estados = $this->HELPERS->ListarEstados();
        $lista_condiciones = $this->HELPERS->ListarCondiciones();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/celulares/creacion.php');
    }

    public function ListaGeneralCelular()
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

        include_once('views/paginas/administrador/controlactivos/celulares/celular.php');
    }

    public function findCelular()
    {
        // Obtener valores desde la solicitud AJAX
        $celular = $_POST['numero'] ?? '';

        // Llama al modelo
        $resultados = $this->CELULARES->findCelular($celular);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarCelular()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $celular = new Celular();
                $celular->setimei($_POST['imei']);
                $celular->setnumero($_POST['numero']);
                $celular->setns($_POST['serie']);
                $celular->setid_categoria($_POST['categoria']);
                $celular->setid_fabricante($_POST['fabricante']);
                $celular->setid_modelo($_POST['modelo']);
                $celular->setid_condicion($_POST['condicion']);
                $celular->setid_estado($_POST['estado']);
                $celular->setid_proveedor($_POST['proveedor']);
                $celular->setid_documento(!empty($_POST['documento']) ? $_POST['documento'] : null);
                // echo "<pre>";
                // var_dump($celular);
                // echo "</pre>";
                //llamando al insert de modelo solicitud
                $create_celular= $this->CELULARES->createCelulares($celular);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_celular) {
                    echo json_encode(['success' => true, 'message' => 'Celular registrado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear el celular']);
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

    public function listaCategoriaCelular()
    {
        $categoria = $this->HELPERS->ListarCategoriaCelular();

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
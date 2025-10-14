<?php
//MODEL
require_once('model/modelCategorias.php');
require_once('model/modelHelpers.php');
//DATA
require_once('data/categoria.php');

class ControlCategorias
{
    //VARIABLE MODELO
   
    public $CATEGORIAS;
    public $HELPERS;

    public function __construct()
    {
        $this->CATEGORIAS = new ModeloCategorias();
        $this->HELPERS = new ModeloHelpers();
    }

    public function CreacionCategorias()
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

        include_once('views/paginas/administrador/controlparametros/categorias/categoria.php');
    }

    public function findCategoria()
    {
        // Obtener valores desde la solicitud AJAX
        $categoria = $_POST['categoria'] ?? '';

        // Llama al modelo
        $resultados = $this->CATEGORIAS->findCategoria($categoria);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function RegistrarCategoria()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $categoria = new Categoria();
                $categoria->setcategoria($_POST['categoria']);
                
                //llamando al insert de modelo area
                $create_area = $this->CATEGORIAS->createCategorias($categoria);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_area) {
                    echo json_encode(['success' => true, 'message' => 'Categoria registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear Categoria']);
                }
            } else {
                // Si no es una solicitud POST, enviar un mensaje de error
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            }
        } catch (Exception $th) {
            // Manejo de excepciones: devolver el mensaje de error
            echo json_encode(['success' => false, 'message' => $th->getMessage()]);
            // echo $th->getMessage();
        }
    }

    public function ActualizarCategoria()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $categoria = new Categoria();
                $categoria->setid($_POST['id']);
                $categoria->setcategoria($_POST['edit_categoria']);
                
                //llamando al insert de modelo area
                $update_categoria = $this->CATEGORIAS->updateCategorias($categoria);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_categoria) {
                    echo json_encode(['success' => true, 'message' => 'Categoria actualizada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizada Categoria']);
                }
            } else {
                // Si no es una solicitud POST, enviar un mensaje de error
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            }
        } catch (Exception $th) {
            // Manejo de excepciones: devolver el mensaje de error
            echo json_encode(['success' => false, 'message' => $th->getMessage()]);
            // echo $th->getMessage();
        }
    }

    public function EliminarCategoria()
    {
        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idcategoria = $_POST['id'] ?? '';

        $resultado = $this->CATEGORIAS->deleteCategorias($idcategoria);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }

}
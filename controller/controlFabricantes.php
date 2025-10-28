<?php
//MODEL
require_once('model/modelFabricantes.php');
require_once('model/modelHelpers.php');
//DATA
require_once('data/fabricante.php');

class ControlFabricantes
{
    //VARIABLE MODELO
    public $FABRICANTES;
    public $HELPERS;

    public function __construct()
    {
        $this->FABRICANTES = new ModeloFabricantes();
        $this->HELPERS = new ModeloHelpers();                                                                        
    }

    public function CreacionFabricantes()
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

        include_once('views/paginas/administrador/controlparametros/fabricantes/fabricante.php');
    }

    public function findFabricante()
    {
        // Obtener valores desde la solicitud AJAX
        $fabricante = $_POST['fabricante'] ?? '';

        // Llama al modelo
        $resultados = $this->FABRICANTES->findFabricante($fabricante);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarFabricante()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $fabricante = new Fabricante();
                $fabricante->setfabricante($_POST['fabricante']);
                
                //llamando al insert de modelo area
                $create_fabricante = $this->FABRICANTES->createFabricantes($fabricante);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_fabricante) {
                    echo json_encode(['success' => true, 'message' => 'Fabricante registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear Fabricante']);
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

    public function actualizarFabricante()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $fabricante = new Fabricante();
                $fabricante->setid($_POST['id']);
                $fabricante->setfabricante($_POST['edit_fabricante']);
                
                //llamando al insert de modelo area
                $update_fabricante = $this->FABRICANTES->updateFabricantes($fabricante);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_fabricante) {
                    echo json_encode(['success' => true, 'message' => 'Fabricante actualizado correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar Fabricante']);
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

    public function eliminarFabricante()
    {
        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idfabricante = $_POST['id'] ?? '';

        $resultado = $this->FABRICANTES->deleteFabricantes($idfabricante);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }
}
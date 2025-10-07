<?php
//MODEL
require_once('model/modelAreas.php');
require_once('model/modelCuentas.php');
//DATA
require_once('data/area.php');

class ControlAreas
{
    //VARIABLE MODELO
    public $CUENTAS;
    public $AREAS;

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
        $this->AREAS = new ModeloAreas();
    }

    public function CreacionAreas()
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

        include_once('views/paginas/administrador/controlparametros/areas/areas.php');
    }

    public function vistaArea()
    {
        // Obtener valores desde la solicitud AJAX
        $area = $_POST['area'] ?? '';

        // Llama al modelo
        $resultados = $this->AREAS->findArea($area);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarArea()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $area = new Area();
                $area->setarea($_POST['area']);
                
                //llamando al insert de modelo area
                $create_area = $this->AREAS->createAreas($area);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_area) {
                    echo json_encode(['success' => true, 'message' => 'Area registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear area']);
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

    public function actualizarArea()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $area = new Area();
                $area->setid($_POST['id']);
                $area->setarea($_POST['edit_area']);
                
                //llamando al insert de modelo area
                $update_area = $this->AREAS->updateAreas($area);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_area) {
                    echo json_encode(['success' => true, 'message' => 'Area registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear area']);
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

    public function eliminarArea()
    {
        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idarea = $_POST['id'] ?? '';

        $resultado = $this->AREAS->deleteAreas($idarea);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }
}
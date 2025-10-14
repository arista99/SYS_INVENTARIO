<?php
//MODEL
require_once('model/modelCentroCostos.php');
require_once('model/modelHelpers.php');
//DATA
require_once('data/centro_costo.php');

class ControlCentroCostos
{
    //VARIABLE MODELO
    public $CENTRO;
    public $HELPERS;

    public function __construct()
    {
        $this->CENTRO = new ModeloCentroCostos();
        $this->HELPERS = new ModeloHelpers();
    }

    public function CreacionCentroCostos()
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

        include_once('views/paginas/administrador/controlparametros/centro_costos/centro_costo.php');
    }

    
    public function vistaCentro()
    {
        // Obtener valores desde la solicitud AJAX
        $centro = $_POST['centro'] ?? '';

        // Llama al modelo
        $resultados = $this->CENTRO->findCentroCosto($centro);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarCentro()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $centro = new CentroCosto();
                $centro->setcentro_costo($_POST['centro']);
                
                //llamando al insert de modelo area
                $create_centro = $this->CENTRO->createCentros($centro);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_centro) {
                    echo json_encode(['success' => true, 'message' => 'Centro de Costo registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear Centro de Costo']);
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

    public function actualizarCentro()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $centro = new CentroCosto();
                $centro->setid($_POST['id']);
                $centro->setcentro_costo($_POST['edit_centro']);
                
                //llamando al insert de modelo area
                $update_centro = $this->CENTRO->updateCentros($centro);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_centro) {
                    echo json_encode(['success' => true, 'message' => 'Centro de Costo registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear Centro de Costo']);
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

    public function eliminarCentro()
    {
        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idcentro= $_POST['id'] ?? '';

        $resultado = $this->CENTRO->deleteCentros($idcentro);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }
}
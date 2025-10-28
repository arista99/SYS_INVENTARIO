<?php
//MODEL
require_once('model/modelModelos.php');
require_once('model/modelHelpers.php');
//DATA
require_once('data/modelo.php');

class ControlModelos
{
    //VARIABLE MODELO
    public $MODELOS;
    public $HELPERS;

    public function __construct()
    {
        $this->MODELOS = new ModeloModelos();
        $this->HELPERS = new ModeloHelpers();
    }

    public function CreacionModelos()
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

        include_once('views/paginas/administrador/controlparametros/modelos/modelo.php');
    }

    public function vistaModelo()
    {
        // Obtener valores desde la solicitud AJAX
        $modelo = $_POST['modelo'] ?? '';

        // Llama al modelo
        $resultados = $this->MODELOS->findModelo($modelo);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    // public function registrarModelo()
    // {
    //     try {
    //         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //             $modelo = new Modelo();
    //             $modelo->setmodelo($_POST['modelo']);
                
    //             //llamando al insert de modelo 
    //             $create_modelo = $this->MODELOS->createModelos($modelo);
    //             // Responder con JSON para que AJAX pueda manejar la respuesta
    //             if ($create_modelo) {
    //                 echo json_encode(['success' => true, 'message' => 'Modelo registrada correctamento']);
    //             } else {
    //                 echo json_encode(['success' => false, 'message' => 'Error al crear Modelo']);
    //             }
    //         } else {
    //             // Si no es una solicitud POST, enviar un mensaje de error
    //             echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    //         }
    //     } catch (Exception $th) {
    //         // Manejo de excepciones: devolver el mensaje de error
    //         echo json_encode(['success' => false, 'message' => $th->getMessage()]);
    //         // echo $th->getMessage();
    //     }
    // }

    // public function actualizarModelo()
    // {
    //     try {
    //         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //             $modelo = new Modelo();
    //             $modelo->setid($_POST['id']);
    //             $modelo->setmodelo($_POST['edit_modelo']);
                
    //             //llamando al insert de modelo 
    //             $create_modelo = $this->MODELOS->updateModelos($modelo);
    //             // Responder con JSON para que AJAX pueda manejar la respuesta
    //             if ($create_modelo) {
    //                 echo json_encode(['success' => true, 'message' => 'Modelo actualizado correctamento']);
    //             } else {
    //                 echo json_encode(['success' => false, 'message' => 'Error al actualizar Modelo']);
    //             }
    //         } else {
    //             // Si no es una solicitud POST, enviar un mensaje de error
    //             echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    //         }
    //     } catch (Exception $th) {
    //         // Manejo de excepciones: devolver el mensaje de error
    //         echo json_encode(['success' => false, 'message' => $th->getMessage()]);
    //         // echo $th->getMessage();
    //     }
    // }

    // public function eliminarModelo()
    // {
    //     // Obtener valores desde la solicitud AJAX
    //     if (!isset($_POST['id'])) {
    //         http_response_code(400);
    //         echo json_encode(['error' => 'ID no proporcionado']);
    //         exit;
    //     }

    //     $idmodelo = $_POST['id'] ?? '';

    //     $resultado = $this->MODELOS->deleteModelos($idmodelo);

    //     if ($resultado) {
    //         echo json_encode(['success' => true]);
    //     } else {
    //         http_response_code(500);
    //         echo json_encode(['error' => 'No se pudo eliminar']);
    //     }
    // }
}
<?php
//MODEL
include_once('model/modelAdjunto.php');
include_once('model/modelCuentas.php');

//DATA
include_once('data/adjunto.php');

class ControlAdjuntos
{
    //VARIABLE MODELO
    public $CUENTAS;
    public $ADJUNTOS;

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
        $this->ADJUNTOS = new ModeloAdjuntos();
    }

    public function CreacionAdjuntos()
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

        include_once('views/paginas/administrador/recursos/adjuntos/adjunto.php');
    }

    public function vistaAdjunto()
    {
        // Obtener valores desde la solicitud AJAX
        $adjunto = $_POST['adjunto'] ?? '';

        // Llama al modelo
        $resultados = $this->ADJUNTOS->findAdjunto($adjunto);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarAdjunto()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $adjunto = new Adjunto();
                $adjunto->setadjunto($_POST['adjunto']);
                
                //llamando al insert de modelo adjunto
                $create_adjunto = $this->ADJUNTOS->createAdjuntos($adjunto);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_adjunto) {
                    echo json_encode(['success' => true, 'message' => 'Adjunto registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear adjunto']);
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

    public function actualizarAdjunto()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $adjunto = new Adjunto();
                $adjunto->setadjunto($_POST['edit_adjunto']);
                $adjunto->setid($_POST['id']);
                
                //llamando al insert de modelo area
                $update_adjunto = $this->ADJUNTOS->updateAdjuntos($adjunto);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_adjunto) {
                    echo json_encode(['success' => true, 'message' => 'Adjunto actualizado correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar adjunto']);
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

    public function eliminarAdjunto()
    {
        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idadjunto = $_POST['id'] ?? '';

        $resultado = $this->ADJUNTOS->deleteAdjuntos($idadjunto);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }
}
<?php
//MODEL
require_once('model/modeloAreas.php');
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

        include_once('views/paginas/administrador/recursos/areas/areas.php');
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
                
                echo '<pre>';
                var_dump($area);
                echo '</pre>';
                //llmando al inser de modelo solicitud
                $create_area = $this->AREAS->createAreas($area);
                echo '<pre>';
                var_dump($create_area);
                echo '</pre>';
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_area) {
                    echo json_encode(['success' => true, 'message' => 'Ticket actualizado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar el ticket']);
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
}
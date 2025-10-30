<?php
//MODEL
require_once('model/modelHistorialMovimientos.php');
require_once('model/modelHelpers.php');
//DATA

class ControlHistorialMovimientos
{
    //VARIABLE MODELO
    public $HISTORIAL;
    public $HELPERS;

    public function __construct()
    {
        $this->HISTORIAL = new ModeloHistorialMovimientos();
        $this->HELPERS = new ModeloHelpers();                                                                        
    }

    public function HistorialActivos()
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

        include_once('views/paginas/administrador/controlmovimientos/historialmovimientos/historialactivos.php');
    }

    public function findHistorialActivos()
    {
        // Obtener valores desde la solicitud AJAX
        $asignacion = $_POST['asignacion'] ?? '';

        // Llama al modelo
        $resultados = $this->HISTORIAL->findHistorialActivos($asignacion);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function HistorialAccesorios()
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

        include_once('views/paginas/administrador/controlmovimientos/historialmovimientos/historialaccesorios.php');
    }

    
    public function findHistorialAccesorios()
    {
        // Obtener valores desde la solicitud AJAX
        $asignacion = $_POST['asignacion'] ?? '';

        // Llama al modelo
        $resultados = $this->HISTORIAL->findHistorialAccesorios($asignacion);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }
}
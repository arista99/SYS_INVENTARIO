<?php
//MODEL
include_once('model/modelLicencias.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/asignacion_licencia.php');

class ControlAsignacionLicencias
{
    //VARIABLE MODELO

    public $ASIGNACION;
    public $HELPERS;

    public function __construct()
    {
        $this->ASIGNACION = new ModeloAsignacionAccesorio();
        $this->HELPERS = new ModeloHelpers();
    }

    public function ControlAsignacionLicencia()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //     Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $lista_desklap = $this->HELPERS->ListarDeskLapDetalle();
        $lista_licencia = $this->HELPERS->ListarLicencias();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionlicencias/asignacion.php');
    }

    public function ListaGenerealAsignacionLicencia()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //     Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $lista_desklap = $this->HELPERS->ListarDeskLapDetalle();
        $lista_licencia = $this->HELPERS->ListarLicencias();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionlicencias/listaasignacion.php');
    }

    public function findAsignacionLicencia()
    {
        // Obtener valores desde la solicitud AJAX
        $asignacion = $_POST['asignacion'] ?? '';

        // Llama al modelo
        $resultados = $this->ASIGNACION->findAsignacionLicencia($asignacion);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarAsignacionActivo()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $asignacionlicencia = new AsignacionLicencia();
                $asignacionlicencia->setid_desk_lap($_POST['id_usuario']);
                $asignacionlicencia->setid_licencia($_POST['id_celular']);
                $asignacionlicencia->setfecha_asignacion($_POST['id_desklap']);

                //llamando al insert de asignacion 
                $create_asignacion = $this->ASIGNACION->createAsignacionLicencia($asignacionlicencia);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_asignacion) {
                    echo json_encode(['success' => true, 'message' => 'Asignacion registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al registrar Asignacion']);
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

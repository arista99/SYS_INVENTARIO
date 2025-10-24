<?php
//MODEL
include_once('model/modelAsignacionActivo.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/asignacion_activo.php');

class ControlAsignacionActivo
{
    //VARIABLE MODELO

    public $ASIGNACION;
    public $HELPERS;

    public function __construct()
    {
        $this->ASIGNACION = new ModeloAsignacionActivo();
        $this->HELPERS = new ModeloHelpers();
    }

    public function ControlAsignacionActivo()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //     Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $lista_usuarios = $this->HELPERS->ListarUsuario();
        $lista_celular = $this->HELPERS->ListarCelularesDetalle();
        $lista_desklap = $this->HELPERS->ListarDeskLapDetalle();
        $lista_tipo_entrega = $this->HELPERS->ListarTipoEntregas();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionactivos/asignacion.php');
    }

    public function ListaGenerealAsignacionActivo()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //     Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $lista_usuarios = $this->HELPERS->ListarUsuario();
        $lista_celular = $this->HELPERS->ListarCelularesDetalle();
        $lista_desklap = $this->HELPERS->ListarDeskLapDetalle();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionactivos/listaasignacion.php');
    }

    public function findAsignacionActivo()
    {
        // Obtener valores desde la solicitud AJAX
        $asignacion = $_POST['asignacion'] ?? '';

        // Llama al modelo
        $resultados = $this->ASIGNACION->findAsignacionActivo($asignacion);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarAsignacionActivo()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $asignacionactivo = new AsignacionActivo();
                $asignacionactivo->setid_usuario($_POST['id_usuario']);
                $asignacionactivo->setid_celular($_POST['id_celular']);
                $asignacionactivo->setid_desk_lap($_POST['id_desklap']);
                $asignacionactivo->setobservacion($_POST['observacion']);
                $asignacionactivo->setid_entrega($_POST['tipo_entrega']);

                //llamando al insert de asignacion 
                $create_asignacion = $this->ASIGNACION->createAsignacionActivo($asignacionactivo);
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

    public function actualizarAsignacionActivo()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $asignacionactivo = new AsignacionActivo();
                $asignacionactivo->setid($_POST['id']);
                $asignacionactivo->setid_usuario($_POST['edit_id_usuario']);
                $asignacionactivo->setid_celular($_POST['edit_id_celular']);
                $asignacionactivo->setid_desk_lap($_POST['edit_id_desklap']);
                $asignacionactivo->setobservacion($_POST['edit_observacion']);
                $asignacionactivo->setid_entrega($_POST['edit_tipo_entrega']);

                $idasignacion = $_POST['id'];
                $edit_tipo_entra = $_POST['edit_tipo_entrega'];

                if ((int)$edit_tipo_entra !== 3) {
                    $update_asignacion = $this->ASIGNACION->updateAsignacionActivo($asignacionactivo);
                    $message = 'Asignación actualizada correctamente.';
                } else {
                    $delete_asignacion = $this->ASIGNACION->deleteAsignacionActivo($idasignacion);
                    $message = 'Asignación eliminada correctamente.';
                }

                echo json_encode([
                    'success' => true,
                    'message' => $message
                ]);

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

    public function listarEntregas()
    {
        $entregas = $this->HELPERS->ListarTipoEntregas();

        echo json_encode($entregas);
    }
}

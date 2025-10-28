<?php
//MODEL
include_once('model/modelAsignacionAccesorio.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/asignacion_accesorio.php');

class ControlAsignacionAccesorio
{
    //VARIABLE MODELO

    public $ASIGNACION;
    public $HELPERS;

    public function __construct()
    {
        $this->ASIGNACION = new ModeloAsignacionAccesorio();
        $this->HELPERS = new ModeloHelpers();
    }

    public function ControlAsignacionAccesorio()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //     Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $lista_usuarios = $this->HELPERS->ListarUsuarioAsignaciones();
        $lista_accesorios = $this->HELPERS->ListarAccesoriosDetalle();
        $lista_tipo_entrega = $this->HELPERS->ListarTipoEntregas();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionaccesorios/asignacion.php');
    }

    public function ListaGenerealAsignacionAccesorio()
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
        $lista_accesorios = $this->HELPERS->ListarAccesoriosDetalle();
        $lista_tipo_entrega = $this->HELPERS->ListarTipoEntregas();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionaccesorios/listaasignacion.php');
    }

    public function findAsignacionAccesorio()
    {
        // Obtener valores desde la solicitud AJAX
        $asignacion = $_POST['asignacion'] ?? '';

        // Llama al modelo
        $resultados = $this->ASIGNACION->findAsignacionAccesorio($asignacion);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarAsignacionAccesorio()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $asignacionaccesorio = new AsignacionAccesorio();
                $asignacionaccesorio->setid_usuario($_POST['id_usuario']);
                $asignacionaccesorio->setid_accesorio($_POST['id_accesorio']);
                $asignacionaccesorio->setobservacion($_POST['observacion']);
                $asignacionaccesorio->setid_entrega($_POST['tipo_entrega']);

                //llamando al insert de asignacion 
                $create_accesorio = $this->ASIGNACION->createAsignacionAccesorio($asignacionaccesorio);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_accesorio) {
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

    public function listarEntregas()
    {
        $entregas = $this->HELPERS->ListarTipoEntregas();

        echo json_encode($entregas);
    }
}

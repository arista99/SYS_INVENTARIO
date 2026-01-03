<?php
//MODEL
include_once('model/modelMantenimientos.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/mantenimiento.php');

class ControlMantenimientos
{
    //VARIABLE MODELO
    public $MANTENIMIENTOS;
    public $HELPERS;


    public function __construct()
    {
        $this->MANTENIMIENTOS = new ModeloMantenimientos();
        $this->HELPERS = new ModeloHelpers();
    }


    public function pdfMantenimiento()
    {
        require_once('../SYS_INVENTARIO/public/libs/pdf/fpdf.php');

        if (isset($_REQUEST['id'])) {
                $mantenimiento = new mantenimiento();
                $mantenimiento->setid($_REQUEST['id']);

                if (ob_get_length()) {
        ob_end_clean();
    }


        $dataMantenimientoaPDF = $this->MANTENIMIENTOS->dataPDFMantenimiento($mantenimiento);

        }

        require_once 'views/paginas/administrador/controlmovimientos/mantenimientos/pdf/pdfmantenimiento.php';
    }

    public function ControlMantenimientos()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }
        
        $lista_proveedores = $this->HELPERS->ListarProveedor();
        $lista_desklap = $this->HELPERS->ListarDeskLapDetalleMantenimiento();
        $tipo_mantenimiento = $this->HELPERS->ListarTipoMantenimiento();
        $lista_usuarios = $this->HELPERS->ListarUsuarioSoporte();
        $usuario =  $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/mantenimientos/mantenimiento.php');
    }

    public function ListaGeneralMantenimiento()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //     Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $lista_proveedores = $this->HELPERS->ListarProveedor();
        $lista_desklap = $this->HELPERS->ListarDeskLapDetalleMantenimiento();
        $tipo_mantenimiento = $this->HELPERS->ListarTipoMantenimiento();
        $lista_usuarios = $this->HELPERS->ListarUsuarioSoporte();
        $lista_estados = $this->HELPERS->ListarEstados();
        $usuario =  $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/mantenimientos/listamantenimiento.php');
    }

    public function findMantenimiento()
    {
        // Obtener valores desde la solicitud AJAX
        $mantenimiento = $_POST['equipo'] ?? '';

        // Llama al modelo
        $resultados = $this->MANTENIMIENTOS->findMantenimiento($mantenimiento);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarMantenimiento()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $mantenimiento = new Mantenimiento();
                $mantenimiento->setid_desk_lap($_POST['id_desklap']);
                $mantenimiento->setid_tipo_mantenimiento($_POST['mantenimiento']);
                $mantenimiento->setid_proveedor($_POST['proveedor']);
                $mantenimiento->setdescripcion($_POST['descripcion']);
                $mantenimiento->setobservacion($_POST['observacion']);
                $mantenimiento->setfecha_inicio(date('Y-m-d'));
                $mantenimiento->setid_usuario_soporte($_POST['usuario']);
                $mantenimiento->setid_estado(3);

                // echo '<pre>';
                // var_dump($mantenimiento);
                // echo '</pre>';
                // exit();
                //llamando al insert de mantenimiento 
                $create_mantenimiento = $this->MANTENIMIENTOS->createMantenimiento($mantenimiento);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_mantenimiento) {
                    echo json_encode(['success' => true, 'message' => 'Mantenimiento registrado correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al registrar Mantenimiento']);
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

    public function actualizarMantenimiento()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $mantenimiento = new Mantenimiento();
                $mantenimiento->setid($_POST['id']);
                $mantenimiento->setid_desk_lap($_POST['edit_id_desklap']);
                $mantenimiento->setid_tipo_mantenimiento($_POST['edit_mantenimiento']);
                $mantenimiento->setid_proveedor($_POST['edit_proveedor']);
                $mantenimiento->setid_estado($_POST['edit_estado']);
                $mantenimiento->setdescripcion($_POST['edit_descripcion']);
                $mantenimiento->setobservacion($_POST['edit_observacion']);
                $mantenimiento->setfecha_fin($_POST['edit_fecha_fin']);
                $mantenimiento->setid_usuario_soporte($_POST['edit_usuario']);

                //llamando al insert de asignacion 
                $update_mantenimiento = $this->MANTENIMIENTOS->updateMantenimiento($mantenimiento);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_mantenimiento) {
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

 
     public function listarMantenimiento()
    {
        $mantenimiento = $this->HELPERS->ListarMantenimiento();

        echo json_encode($mantenimiento);
    }

    public function listaProveedores()
    {
        $proveedor = $this->HELPERS->ListarProveedor();

        echo json_encode($proveedor);
    }

      public function listaUsuarios()
    {
        $proveedor = $this->HELPERS->ListarUsuarioSoporte();

        echo json_encode($proveedor);
    }

        public function ListarEstadosMantenimiento()
    {
        $estado = $this->HELPERS->ListarEstadosMantenimiento();

        echo json_encode($estado);
    }
}
<?php
//MODEL
include_once('model/modelLicencias.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/licencia.php');

class ControlLicencias{
    //VARIABLE MODELO
    public $LICENCIAS;
    public $HELPERS;


    public function __construct()
    {
        $this->LICENCIAS = new ModeloLicencias();
        $this->HELPERS = new ModeloHelpers();
    }

    public function CreacionLicencias()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $proveedores_tra = $this->PROVEEDORES->readProveedores();
        $documentos_tra = $this->DOCUMENTOS->readDocumento();

        $usuario =  $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/licencias/creacion.php');
    }

    public function ListaLicencias()
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

        include_once('views/paginas/administrador/modulos/licencias/licencias.php');
    }

    public function registrarLicencia()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $licencia = new Licencia();
                $licencia->setsoftware($_POST['software']);
                $licencia->setversion($_POST['version']);
                $licencia->setcantidad($_POST['cantidad']);
                $licencia->settipo($_POST['tipo']);
                $licencia->setid_proveedor($_POST['proveedor']);
                $licencia->setid_documento($_POST['documento']);

                //llamando al insert de licencia 
                $create_licencia = $this->LICENCIAS->createLicencias($licencia);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_licencia) {
                    echo json_encode(['success' => true, 'message' => 'Licencia registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear Licencia']);
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

    public function actualizarLicencia()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $licencia = new Licencia();
                $licencia->setid($_POST['id']);
                $licencia->setsoftware($_POST['edit_software']);
                $licencia->setversion($_POST['edit_version']);
                $licencia->setcantidad($_POST['edit_cantidad']);
                $licencia->settipo($_POST['edit_tipo']);
                $licencia->setid_proveedor($_POST['edit_proveedor']);
                $licencia->setid_documento($_POST['edit_documento']);

                //llamando al insert de licencia 
                $update_licencia = $this->LICENCIAS->updateLicencias($licencia);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_licencia) {
                    echo json_encode(['success' => true, 'message' => 'Licencia actualizada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar Licencia']);
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

    

    public function vistaLicencia()
    {
        // Obtener valores desde la solicitud AJAX
        $licencia = $_POST['licencia'] ?? '';

        // Llama al modelo
        $resultados = $this->LICENCIAS->findLicencia($licencia);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function listaProveedor()
    {
        // Simula datos desde la BD
        $proveedores = $this->PROVEEDORES->readProveedores(); // Array de objetos con idcentro y centro_costo

        echo json_encode($proveedores);
    }

    public function ListaDocumento()
    {
        // Simula datos desde la BD
        $documentos = $this->DOCUMENTOS->readDocumento(); // Array de objetos con idcentro y centro_costo

        echo json_encode($documentos);
    }
}
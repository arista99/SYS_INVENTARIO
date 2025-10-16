<?php
//MODEL
require_once('model/modelProveedores.php');
require_once('model/modelHelpers.php');

//DATA
require_once('data/proveedor.php');

class ControlProveedores
{
    //VARIABLE MODELO
    public $HELPERS;
    public $PROVEEDORES;


    public function __construct()
    {
        $this->HELPERS = new ModeloHelpers();
        $this->PROVEEDORES = new ModeloProveedores();
    }

    public function CreacionProveedores()
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

        include_once('views/paginas/administrador/controlgestion/proveedores/creacion.php');
    }

    public function ListaGeneralProveedores()
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

        include_once('views/paginas/administrador/controlgestion/proveedores/proveedores.php');
    }

    public function findProveedores()
    {
        // Obtener valores desde la solicitud AJAX
        $proveedor = $_POST['proveedor'] ?? '';

        // Llama al modelo
        $resultados = $this->PROVEEDORES->findProveedor($proveedor);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarProveedor()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $proveedor = new Proveedor();
                $proveedor->setproveedor($_POST['proveedor']);
                $proveedor->setdireccion($_POST['direccion']);
                $proveedor->setcontacto($_POST['contacto']);
                $proveedor->setemail($_POST['correo']);
                $proveedor->settelefono($_POST['telefono']);
                $proveedor->setid_producto($_POST['filtrarProducto']);
                $proveedor->setid_documento($_POST['filtrarDocumento']);

                //llamando al insert de modelo proveedor
                $create_proveeedor = $this->PROVEEDORES->createProveedores($proveedor);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_proveeedor) {
                    echo json_encode(['success' => true, 'message' => 'Proveedor registrado correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear proveedor']);
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

    public function actualizarProveedor()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $proveedor = new Proveedor();
                $proveedor->setid($_POST['id']);
                $proveedor->setproveedor($_POST['edit_proveedor']);
                $proveedor->setdireccion($_POST['edit_direccion']);
                $proveedor->setcontacto($_POST['edit_contacto']);
                $proveedor->setemail($_POST['edit_email']);
                $proveedor->settelefono($_POST['edit_telefono']);
                $proveedor->setid_producto($_POST['edit_producto']);
                $proveedor->setid_documento($_POST['edit_documento']);

                //llamando al insert de modelo proveedor
                $update_proveeedor = $this->PROVEEDORES->updateProveedores($proveedor);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_proveeedor) {
                    echo json_encode(['success' => true, 'message' => 'Proveedor actualizado correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar proveedor']);
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

    public function eliminarProveedor()
    {
        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idproveedor = $_POST['id'] ?? '';

        $resultado = $this->PROVEEDORES->deleteProveedores($idproveedor);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }
}

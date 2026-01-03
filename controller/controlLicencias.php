<?php
//MODEL
include_once('model/modelLicencias.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/licencia.php');

class ControlLicencias
{
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

        $lista_proveedor = $this->HELPERS->ListarProveedor();
        $lista_categorias = $this->HELPERS->ListarCategoriaLicencia();

        $usuario =  $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/licencias/creacion.php');
    }

    public function ListaGeneralLicencias()
    {
        // Iniciar sesión
        session_start();
        
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
        //     Redirigir al login si no está autenticado
           header("Location: Index");
            exit;
        }

        $usuario =$this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/licencias/licencias.php');
    }

    public function registrarLicencia()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $licencia = new Licencia();
                $licencia->setsoftware($_POST['software']);
                $licencia->setversion($_POST['version']);
                $licencia->setcantidad_total($_POST['cantidad']);
                $licencia->setcantidad_disponible($_POST['disponible']);
                $licencia->settipo($_POST['tipo']);
                $licencia->setfecha_inicio_licencia($_POST['fecha_inicio_licencia']);
                $licencia->setfecha_fin_licencia($_POST['fecha_fin_licencia']);
                $licencia->setid_proveedor($_POST['proveedor']);
                $licencia->setid_documento(!empty($_POST['documento']) ? $_POST['documento'] : null);
                $licencia->setid_categoria($_POST['categoria']);
                $licencia->setid_fabricante(!empty($_POST['fabricante']) ? $_POST['fabricante'] : null);
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
                $licencia->setcantidad_total($_POST['edit_cantidad']);
                $licencia->setcantidad_disponible($_POST['edit_disponible']);
                $licencia->settipo($_POST['edit_tipo']);
                $licencia->setfecha_inicio_licencia($_POST['edit_fecha_inicio_licencia']);
                $licencia->setfecha_fin_licencia($_POST['edit_fecha_fin_licencia']);
                $licencia->setid_proveedor($_POST['edit_proveedor']);
                $licencia->setid_documento(!empty($_POST['edit_documento']) ? $_POST['edit_documento'] : null);
                $licencia->setid_categoria($_POST['edit_categoria']);
                $licencia->setid_fabricante(!empty($_POST['edit_fabricante']) ? $_POST['edit_fabricante'] : null);

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

    public function findLicencia()
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

    public function listaCategoriaLicencia()
    {
        $categoria = $this->HELPERS->ListarCategoriaLicencia();

        echo json_encode($categoria);
    }

     public function listaFabricanteEdit()
    {
        $fabricante = $this->HELPERS->ListarFabricantesEditLicencia();
        
        echo json_encode($fabricante);
    }

      public function listaProveedores()
    {
        $proveedor = $this->HELPERS->ListarProveedor();

        echo json_encode($proveedor);
    }
  

    public function listaDocumentos()
    {
        $id_proveedor = filter_input(INPUT_POST, 'dato_mandar_servidor');

        $documento = $this->HELPERS->ListarDocumentos($id_proveedor);

        echo json_encode($documento);
    }

    public function listaDocumentosEdit()
    {
        $documento = $this->HELPERS->ListarDocumentosEdit();

        echo json_encode($documento);
    }


}
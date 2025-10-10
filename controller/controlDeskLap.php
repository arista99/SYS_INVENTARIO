<?php
//MODEL
include_once('model/modelDeskLap.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/desklap.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class ControlDeskLap
{
    //VARIABLE MODELO
    public $DESKLAP;
    public $HELPERS;

    public function __construct()
    {
        $this->DESKLAP = new ModeloDeskLap();
        $this->HELPERS = new ModeloHelpers();
    }

    public function CreacionDeskLap()
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
        $lista_centro_costo = $this->HELPERS->ListarCentrosCosto();
        $lista_categorias = $this->HELPERS->ListarCategoriaDeskLap();
        $lista_proveedores = $this->HELPERS->ListarProveedor();
        $lista_condiciones = $this->HELPERS->ListarCondiciones();
        $lista_estados = $this->HELPERS->ListarEstados();
        $lista_documentos = $this->HELPERS->ListarDocumentos();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/desklap/creacion.php');
    }

    public function ListaDeskLap()
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

        include_once('views/paginas/administrador/controlactivos/desklap/desklap.php');
    }

    public function RegistrarDeskLap()
    {
        try {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $desklap = new DeskLap();

                // Datos simples
                $desklap->setnom_equipo($_POST['equipo']);
                $desklap->setns($_POST['serie']);
                $desklap->setnumero_part($_POST['part']);
                $desklap->setprocesador($_POST['procesador']);
                $desklap->setdisco($_POST['disco']);
                $desklap->setmemoria($_POST['memoria']);
                $desklap->setfecha_compra($_POST['fecha_compra']);
                $desklap->setip($_POST['ip']);

                // IDs que podrían ser NULL
                $desklap->setid_documento(!empty($_POST['documento']) ? $_POST['documento'] : null);
                $desklap->setid_centro_costo(!empty($_POST['centro']) ? $_POST['centro'] : null);
                $desklap->setid_categoria(!empty($_POST['categoria']) ? $_POST['categoria'] : null);
                $desklap->setid_fabricante(!empty($_POST['fabricante']) ? $_POST['fabricante'] : null);
                $desklap->setid_modelo(!empty($_POST['modelo']) ? $_POST['modelo'] : null);
                $desklap->setid_proveedor(!empty($_POST['proveedor']) ? $_POST['proveedor'] : null);
                $desklap->setid_condicion(!empty($_POST['condicion']) ? $_POST['condicion'] : null);
                $desklap->setid_estado(!empty($_POST['estado']) ? $_POST['estado'] : null);

                //llamando al insert de modelo DeskLap
                $create_desklap = $this->DESKLAP->createDeskLap($desklap);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_desklap) {
                    echo json_encode(['success' => true, 'message' => 'DeskLap registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear DeskLap']);
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

    public function ActualizarDeskLap()
    {
        try {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $desklap = new DeskLap();

                // Datos simples
                $desklap->setid($_POST['id']);
                $desklap->setnom_equipo(!empty($_POST['edit_equipo']) ? $_POST['edit_equipo'] : null);
                $desklap->setns(!empty($_POST['edit_serie']) ? $_POST['edit_serie'] : null);
                $desklap->setnumero_part(!empty($_POST['edit_part']) ? $_POST['edit_part'] : null);
                $desklap->setprocesador(!empty($_POST['edit_procesador']) ? $_POST['edit_procesador'] : null);
                $desklap->setdisco(!empty($_POST['edit_disco']) ? $_POST['edit_disco'] : null);
                $desklap->setmemoria(!empty($_POST['edit_memoria']) ? $_POST['edit_memoria'] : null);
                $desklap->setip(!empty($_POST['edit_ip']) ? $_POST['edit_ip'] : null);

                // IDs que podrían ser NULL
                $desklap->setid_categoria(!empty($_POST['edit_categoria']) ? $_POST['edit_categoria'] : null);
                $desklap->setid_centro_costo(!empty($_POST['edit_centro']) ? $_POST['edit_centro'] : null);
                $desklap->setid_fabricante(!empty($_POST['edit_fabricante']) ? $_POST['edit_fabricante'] : null);
                $desklap->setid_proveedor(!empty($_POST['edit_proveedor']) ? $_POST['edit_proveedor'] : null);
                $desklap->setid_condicion(!empty($_POST['edit_condicion']) ? $_POST['edit_condicion'] : null);
                $desklap->setid_estado(!empty($_POST['edit_estado']) ? $_POST['edit_estado'] : null);
                $desklap->setid_modelo(!empty($_POST['edit_modelo']) ? $_POST['edit_modelo'] : null);
                $desklap->setid_documento(!empty($_POST['edit_documento']) ? $_POST['edit_documento'] : null);

                //llamando al insert de modelo activopc
                $update_desklap = $this->DESKLAP->updateDeskLap($desklap);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_desklap) {
                    echo json_encode(['success' => true, 'message' => 'DeskLap actualizado correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar DeskLap']);
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

    public function ImportarExcelActivoPC()
    {
        if (isset($_FILES['archivoExcel'])) {
            $fileTmp = $_FILES['archivoExcel']['tmp_name'];

            $spreadsheet = IOFactory::load($fileTmp);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Procesar cada fila (saltando encabezado)
            for ($i = 1; $i < count($rows); $i++) {
                $insert_excel =  $this->DESKLAP->insertarFilaInventario($rows[$i]);
            }

            echo "Importación exitosa";
        } else {
            echo "No se recibió el archivo.";
        }
    }


    public function findDeskopLaptop()
    {
        // Obtener valores desde la solicitud AJAX
        $desklap = $_POST['desklap'] ?? '';

        // Llama al modelo
        $resultados = $this->DESKLAP->findDeskLap($desklap);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }


    public function listaUsuario()
    {
        $usuario = $this->HELPERS->ListarUsuario();

        echo json_encode($usuario);
    }

    public function listaCategoria()
    {
        $categoria = $this->HELPERS->ListarCategoriaDeskLap();

        echo json_encode($categoria);
    }

    public function listaCentro()
    {
        $centro = $this->HELPERS->ListarCentrosCosto();

        echo json_encode($centro);
    }

    public function listaFabricante()
    {
        $id_categoria = filter_input(INPUT_POST, 'dato_mandar_servidor');

        $fabricante = $this->HELPERS->ListarFabricantes($id_categoria);

        echo json_encode($fabricante);
    }

    public function listaModelo()
    {
        $id_fabricante = filter_input(INPUT_POST, 'dato_mandar_servidor');

        $modelo = $this->HELPERS->ListarModelos($id_fabricante);

        echo json_encode($modelo);
    }

    public function listaProveedores()
    {
        $proveedor = $this->HELPERS->ListarProveedor();

        echo json_encode($proveedor);
    }

    public function listaCondiciones()
    {
        $condicion = $this->HELPERS->ListarCondiciones();

        echo json_encode($condicion);
    }

    public function listaEstado()
    {
        $estado = $this->HELPERS->ListarEstados();

        echo json_encode($estado);
    }

    public function listaDocumentos()
    {
        $documento = $this->HELPERS->ListarDocumentos();

        echo json_encode($documento);
    }
}

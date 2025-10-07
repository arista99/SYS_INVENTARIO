<?php
//MODEL

include_once('model/modelActivosPc.php');
include_once('model/modelCuentas.php');
include_once('model/modelSede.php');
include_once('model/modelCategorias.php');
include_once('model/modelCentroCostos.php');
include_once('model/modelAreas.php');
include_once('model/modelFabricantes.php');
include_once('model/modelProveedores.php');
include_once('model/modelCondiciones.php');
include_once('model/modelEstados.php');
include_once('model/modelModelos.php');
include_once('model/modelDocumentos.php');

//DATA

include_once('data/activospc.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class ControlActivosPc
{
    //VARIABLE MODELO
    public $ACTIVOSPC;
    public $CUENTAS;
    public $SEDES;
    public $CATEGORIAS;
    public $CENTROCOSTO;
    public $AREAS;
    public $FABRICANTES;
    public $PROVEEDORES;
    public $CONDICIONES;
    public $ESTADOS;
    public $MODELOS;
    public $DOCUMENTOS;


    public function __construct()
    {
        $this->ACTIVOSPC = new ModeloActivosPC();
        $this->CUENTAS = new ModeloCuentas();
        $this->SEDES = new ModeloSedes();
        $this->CATEGORIAS = new ModeloCategorias();
        $this->CENTROCOSTO = new ModeloCentroCostos();
        $this->AREAS = new ModeloAreas();
        $this->FABRICANTES = new ModeloFabricantes();
        $this->PROVEEDORES = new ModeloProveedores();
        $this->CONDICIONES = new ModeloCondiciones();
        $this->ESTADOS = new ModeloEstados();
        $this->MODELOS = new ModeloModelos();
        $this->DOCUMENTOS = new ModeloDocumentos();
    }

    public function CreacionActivoPC()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //     Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $lista_usuarios = $this->CUENTAS->listUsuarios();
        $lista_sedes = $this->SEDES->readSedes();
        $lista_categorias = $this->CATEGORIAS->readCategoria();
        $lista_centros = $this->CENTROCOSTO->readCentro();
        $lista_areas = $this->AREAS->readAreas();
        $lista_fabricantes = $this->FABRICANTES->readFabricante();
        $lista_proveedores = $this->PROVEEDORES->readProveedores();
        $lista_condiciones = $this->CONDICIONES->readCondicion();
        $lista_estados = $this->ESTADOS->readEstado();
        $lista_modelos = $this->MODELOS->readModelo();
        $lista_documentos = $this->DOCUMENTOS->readDocumento();

        $usuario = $this->CUENTAS->readUsuario($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/desklap/creacion.php');
    }

    public function ListaActivoPC()
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

        include_once('views/paginas/administrador/activos/activospc.php');
    }

    public function registrarActivoPC()
    {
        try {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $activopc = new Activopc();

                // Datos simples
                $activopc->setnom_equipo($_POST['equipo']);
                $activopc->setns($_POST['serie']);
                $activopc->setnumero_part($_POST['part']);
                $activopc->setprocesador($_POST['procesador']);
                $activopc->setdisco($_POST['disco']);
                $activopc->setmemoria($_POST['memoria']);
                $activopc->setmac_ethernet($_POST['ethernet']);
                $activopc->setmac_wireless($_POST['wireless']);
                $activopc->setip($_POST['ip']);

                // IDs que podrían ser NULL
                $activopc->setid_usuario(!empty($_POST['usuario']) ? $_POST['usuario'] : null);
                $activopc->setid_sede(!empty($_POST['sede']) ? $_POST['sede'] : null);
                $activopc->setid_categoria(!empty($_POST['categoria']) ? $_POST['categoria'] : null);
                $activopc->setid_centro_costo(!empty($_POST['centro']) ? $_POST['centro'] : null);
                $activopc->setid_area(!empty($_POST['area']) ? $_POST['area'] : null);
                $activopc->setid_fabricante(!empty($_POST['fabricante']) ? $_POST['fabricante'] : null);
                $activopc->setid_proveedor(!empty($_POST['proveedor']) ? $_POST['proveedor'] : null);
                $activopc->setid_condicion(!empty($_POST['condicion']) ? $_POST['condicion'] : null);
                $activopc->setid_estado(!empty($_POST['estado']) ? $_POST['estado'] : null);
                $activopc->setid_modelo(!empty($_POST['modelo']) ? $_POST['modelo'] : null);
                $activopc->setid_documento(!empty($_POST['documento']) ? $_POST['documento'] : null);

                //llamando al insert de modelo activopc
                $create_activopc = $this->ACTIVOSPC->createActivosPC($activopc);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_activopc) {
                    echo json_encode(['success' => true, 'message' => 'Activo Pc registrada correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear Activo pc']);
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

    public function actualizarActivoPC()
    {
        try {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $activopc = new Activopc();

                // Datos simples
                $activopc->setid($_POST['id']);
                $activopc->setnom_equipo(!empty($_POST['edit_equipo']) ? $_POST['edit_equipo'] : null);
                $activopc->setns(!empty($_POST['edit_serie']) ? $_POST['edit_serie'] : null);
                $activopc->setnumero_part(!empty($_POST['edit_part']) ? $_POST['edit_part'] : null);
                $activopc->setprocesador(!empty($_POST['edit_procesador']) ? $_POST['edit_procesador'] : null);
                $activopc->setdisco(!empty($_POST['edit_disco']) ? $_POST['edit_disco'] : null);
                $activopc->setmemoria(!empty($_POST['edit_memoria']) ? $_POST['edit_memoria'] : null);
                $activopc->setmac_ethernet(!empty($_POST['edit_ethernet']) ? $_POST['edit_ethernet'] : null);
                $activopc->setmac_wireless(!empty($_POST['edit_wireless']) ? $_POST['edit_wireless'] : null);
                $activopc->setip(!empty($_POST['edit_ip']) ? $_POST['edit_ip'] : null);

                // IDs que podrían ser NULL
                $activopc->setid_usuario(!empty($_POST['edit_usuario']) ? $_POST['edit_usuario'] : null);
                $activopc->setid_sede(!empty($_POST['edit_sede']) ? $_POST['edit_sede'] : null);
                $activopc->setid_categoria(!empty($_POST['edit_categoria']) ? $_POST['edit_categoria'] : null);
                $activopc->setid_centro_costo(!empty($_POST['edit_centro']) ? $_POST['edit_centro'] : null);
                $activopc->setid_area(!empty($_POST['edit_area']) ? $_POST['edit_area'] : null);
                $activopc->setid_fabricante(!empty($_POST['edit_fabricante']) ? $_POST['edit_fabricante'] : null);
                $activopc->setid_proveedor(!empty($_POST['edit_proveedor']) ? $_POST['edit_proveedor'] : null);
                $activopc->setid_condicion(!empty($_POST['edit_condicion']) ? $_POST['edit_condicion'] : null);
                $activopc->setid_estado(!empty($_POST['edit_estado']) ? $_POST['edit_estado'] : null);
                $activopc->setid_modelo(!empty($_POST['edit_modelo']) ? $_POST['edit_modelo'] : null);
                $activopc->setid_documento(!empty($_POST['edit_documento']) ? $_POST['edit_documento'] : null);

                //llamando al insert de modelo activopc
                $update_activopc = $this->ACTIVOSPC->updateActivosPC($activopc);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_activopc) {
                    echo json_encode(['success' => true, 'message' => 'Activo Pc actualizado correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar Activo pc']);
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

    public function importarExcelActivoPC()
    {
        if (isset($_FILES['archivoExcel'])) {
            $fileTmp = $_FILES['archivoExcel']['tmp_name'];

            $spreadsheet = IOFactory::load($fileTmp);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Procesar cada fila (saltando encabezado)
            for ($i = 1; $i < count($rows); $i++) {
                $insert_excel =  $this->ACTIVOSPC->insertarFilaInventario($rows[$i]);
            }

            echo "Importación exitosa";
        } else {
            echo "No se recibió el archivo.";
        }
    }


    public function vistaActivoPC()
    {
        // Obtener valores desde la solicitud AJAX
        $activopc = $_POST['activopc'] ?? '';

        // Llama al modelo
        $resultados = $this->ACTIVOSPC->findActivopc($activopc);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }



    public function listaSede()
    {
        $sede = $this->SEDES->readSedes();

        echo json_encode($sede);
    }

    public function listaUsuario()
    {
        $usuario = $this->CUENTAS->listUsuarios();

        echo json_encode($usuario);
    }

    public function listaCategoria()
    {
        $categoria = $this->CATEGORIAS->readCategoria();

        echo json_encode($categoria);
    }

    public function listaCentro()
    {
        $centro = $this->CENTROCOSTO->readCentro();

        echo json_encode($centro);
    }

    public function listaArea()
    {
        $area = $this->AREAS->readAreas();

        echo json_encode($area);
    }

    public function listaFabricante()
    {
        $fabricante = $this->FABRICANTES->readFabricante();

        echo json_encode($fabricante);
    }

    public function listaProveedoresOP()
    {
        $proveedor = $this->PROVEEDORES->readProveedores();

        echo json_encode($proveedor);
    }

    public function listaCondiciones()
    {
        $condicion = $this->CONDICIONES->readCondicion();

        echo json_encode($condicion);
    }

    public function listaEstado()
    {
        $estado = $this->ESTADOS->readEstado();

        echo json_encode($estado);
    }

    public function listaModelo()
    {
        $modelo = $this->MODELOS->readModelo();

        echo json_encode($modelo);
    }

    public function listaDocumentosOP()
    {
        $documento = $this->DOCUMENTOS->readDocumento();

        echo json_encode($documento);
    }
}

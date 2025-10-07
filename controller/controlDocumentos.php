<?php
//MODEL
require_once('model/modelDocumentos.php');
require_once('model/modelCuentas.php');

//DATA
require_once('data/documento.php');

class ControlDocumentos
{
    //VARIABLE MODELO
    public $CUENTAS;
    public $DOCUMENTOS;

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
        $this->DOCUMENTOS = new ModeloDocumentos();
    }

    public function CreacionDocumentos()
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

        include_once('views/paginas/administrador/controlgestion/documentos/creacion.php');
    }

    public function registrarDocumento()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $documento = new Documento();
                $documento->setdocumento($_POST['documento']);
                $documento->setid_adjunto($_POST['filtrarAdjunto']);
                $documento->setfecha_inicio($_POST['fecha_inicio']);
                $documento->setfecha_termino($_POST['fecha_termino']);
                $documento->setid_usuario_create($_POST['idusuario']);

                if (isset($_FILES['formFileAdjunto']) && $_FILES['formFileAdjunto']['error'] === UPLOAD_ERR_OK) {
                    $nombreOriginal = $_FILES['formFileAdjunto']['name'];
                    $temporal = $_FILES['formFileAdjunto']['tmp_name'];

                    // Validar extensión
                    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'pdf'];
                    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

                    if (!in_array($extension, $extensionesPermitidas)) {
                        echo json_encode(['success' => false, 'message' => 'Tipo de archivo no permitido (solo JPG, PNG o PDF)']);
                        return;
                    }

                    $carpetaDestino = 'uploads/';

                    $nombreUnico = uniqid() . "_" . basename($nombreOriginal);
                    $rutaFinal = $carpetaDestino . $nombreUnico;

                    if (move_uploaded_file($temporal, $rutaFinal)) {
                        $documento->setruta_adjunto($rutaFinal);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al mover el archivo']);
                        return;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se recibió el archivo']);
                    return;
                }

                $create_documento = $this->DOCUMENTOS->createDocumentos($documento);

                if ($create_documento) {
                    echo json_encode(['success' => true, 'message' => 'Documento registrado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear documento']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function ListaDocumentos()
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

        include_once('views/paginas/administrador/controlgestion/documentos/documentos.php');
    }

    public function vistaDocumento()
    {
        // Obtener valores desde la solicitud AJAX
        $documento = $_POST['documento'] ?? '';

        // Llama al modelo
        $resultados = $this->DOCUMENTOS->findDocumento($documento);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function actualizarDocumento()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $documento = new Documento();
                $documento->setid($_POST['id']);
                $documento->setdocumento($_POST['edit_documento']);
                $documento->setid_adjunto($_POST['edit_adjunto']);
                $documento->setfecha_inicio($_POST['edit_fecha_ini']);
                $documento->setfecha_termino($_POST['edit_fecha_fin']);
                $documento->setid_usuario_update($_POST['idusuario']);
                
                
                //llamando al insert de modelo documento
                $update_documento = $this->DOCUMENTOS->updateDocumentos($documento);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_documento) {
                    echo json_encode(['success' => true, 'message' => 'Documento actualizado correctamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar documento']);
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
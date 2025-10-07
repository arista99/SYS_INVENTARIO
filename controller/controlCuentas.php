<?php
//MODEL
require_once('model/modelCuentas.php');
require_once('model/modelPerfiles.php');
require_once('model/modelSede.php');
require_once('model/modelCentroCostos.php');
require_once('model/modelAreas.php');
require_once('model/modelActivosPc.php');
//DATA
require_once('data/usuario.php');

class ControlCuentas
{
    //VARIABLE MODELO
    public $CUENTAS;
    public $PERFILES;
    public $SEDES;
    public $CENTRO;
    public $AREA;
    public $ACTIVO;

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
        $this->PERFILES = new ModeloPerfiles();
        $this->SEDES = new ModeloSedes();
        $this->CENTRO = new ModeloCentroCostos();
        $this->AREA = new ModeloAreas();
        $this->ACTIVO = new ModeloActivosPC();
    }

    public function CreacionUsuarios()
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
        
        $sedes_tra = $this->SEDES->readSedes();
        $centros_tra = $this->CENTRO->readCentro();
        $areas_tra = $this->AREA->readAreas();
        $perfiles_tra = $this->PERFILES->readPefiles();

        include_once('views/paginas/administrador/controlgestion/cuentas/creacion.php');
    }

    public function registrarUsuario()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario = new Usuario();
                $usuario->setusuario_red($_POST['usuarioRed']);
                $usuario->setusuario($_POST['usuario']);
                $usuario->setid_sede($_POST['filtrarSede']);
                $hash = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
                $usuario->setcontrasena($hash);
                $usuario->setid_centro_costo($_POST['filtrarCentro']);
                $usuario->setid_area($_POST['filtrarArea']);
                $usuario->setemail($_POST['correo']);
                $usuario->setid_perfil($_POST['filtrarPerfil']);
                $usuario->setcargo($_POST['cargo']);

                //llmando al inser de modelo solicitud
                $create_usuario = $this->CUENTAS->createUsuarios($usuario);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_usuario) {
                    echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear el usuario']);
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


    public function ListaUsuarios()
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

        include_once('views/paginas/administrador/controlgestion/cuentas/usuarios.php');
    }

    public function vistaUsuario()
    {
        // Obtener valores desde la solicitud AJAX
        $nombre = $_POST['nombre'] ?? '';

        // Llama al modelo
        $resultados = $this->CUENTAS->findUsuario($nombre);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function actualizarUsuario()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $usuario = new Usuario();
                $usuario->setid($_POST['id']);
                $usuario->setusuario($_POST['edit_usuario']);
                $usuario->setusuario_red($_POST['edit_usu_red']);
                $usuario->setid_centro_costo($_POST['edit_centro_costo']);
                $usuario->setemail($_POST['edit_email']);
                $usuario->setid_sede($_POST['edit_sede']);
                $usuario->setid_perfil($_POST['edit_perfil']);
                $usuario->setid_area($_POST['edit_area']);
            
                $update_usuario = $this->CUENTAS->updateUsuario($usuario);
                // var_dump($update_usuario);
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_usuario) {
                    echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario']);
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

    public function EliminarUsuarios()
    {
        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idusuario = $_POST['id'] ?? '';

        $resultado = $this->CUENTAS->deleteUsuario($idusuario);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }

    public function listaCentro()
    {
        // Simula datos desde la BD
        $centros = $this->CENTRO->readCentro(); // Array de objetos con idcentro y centro_costo

        echo json_encode($centros);
    }

    public function listaSede()
    {
        // Simula datos desde la BD
        $sedes = $this->SEDES->readSedes(); // Array de objetos con idcentro y centro_costo

        echo json_encode($sedes);
    }

    public function listaPerfil()
    {
        // Simula datos desde la BD
        $perfiles = $this->PERFILES->readPefiles(); // Array de objetos con idcentro y centro_costo

        echo json_encode($perfiles);
    }

    public function listaArea()
    {
        // Simula datos desde la BD
        $areas = $this->AREA->readAreas(); // Array de objetos con idcentro y centro_costo

        echo json_encode($areas);
    }


}
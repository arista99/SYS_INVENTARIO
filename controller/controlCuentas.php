<?php
//MODEL
require_once('model/modelCuentas.php');
require_once('model/modelPerfiles.php');
require_once('model/modelSede.php');
require_once('model/modelCentro.php');
require_once('model/modeloAreas.php');
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

    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
        $this->PERFILES = new ModeloPerfiles();
        $this->SEDES = new ModeloSedes();
        $this->CENTRO = new ModeloCentro();
        $this->AREA = new ModeloAreas();
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

        include_once('views/paginas/administrador/cuentas/creacion.php');
    }

    public function listaCentro()
    {
        // Simula datos desde la BD
        $centros = $this->CENTRO->readCentro(); // Array de objetos con idcentro y centro_costo

        echo json_encode($centros);
    }

    public function registrarUsuario()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario = new Usuario();
                $usuario->setusuario_red($_POST['usuarioRed']);
                $usuario->setusuario($_POST['usuario']);
                $usuario->setid_sede($_POST['filtrarSede']);
                $usuario->setcontrasena($_POST['contrasena']);
                $usuario->setid_centro_costo($_POST['filtrarCentro']);
                $usuario->setid_area($_POST['filtrarArea']);
                $usuario->setemail($_POST['correo']);
                $usuario->setid_perfil($_POST['filtrarPerfil']);
                $usuario->setcargo($_POST['cargo']);

                //llmando al inser de modelo solicitud
                $create_usuario = $this->CUENTAS->createUsuarios($usuario);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_usuario) {
                    echo json_encode(['success' => true, 'message' => 'Ticket actualizado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar el ticket']);
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

        include_once('views/paginas/administrador/cuentas/usuarios.php');
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

    public function EditarUsuarios()
    {
        // Iniciar sesión
        session_start();
        
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
        //     Redirigir al login si no está autenticado
           header("Location: Index");
            exit;
        }

        
    }

    public function EliminarUsuarios()
    {
        // Iniciar sesión
        session_start();
        
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
        //     Redirigir al login si no está autenticado
           header("Location: Index");
            exit;
        }
    }



}
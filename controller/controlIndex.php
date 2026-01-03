<?php
//MODEL
require_once('model/modelLogin.php');
//DATA
require_once('data/usuario.php');

class ControlIndex
{

    //VARIABLE MODELO
    public $LOGIN;


    public function __construct()
    {
        $this->LOGIN = new ModeloLogin();
    }
    public function Index()
    {
        include_once('views/paginas/login/login.php');
    }

    public function LoginUsuario()
    {
        try {
            //var_dump($_POST);
            $login = new Usuario();
            $login->setusuario_red($_POST['usuario_red']);
            $login->setcontrasena($_POST['contrasena']);

            $acceso = $this->LOGIN->logeo($login);

            // echo "<pre>";
            // var_dump($acceso);
            // echo "</pre>";
            if ($acceso) {
                session_start();
                $_SESSION["id"] = $acceso->id;
                $_SESSION["usuario_red"] = $acceso->usuario_red;
                $_SESSION["id_perfil"] = $acceso->id_perfil;

                // Definir la URL de redirección según el rol
                $redirectUrl = "";

                if ($_SESSION["id_perfil"] == 1) {
                    $redirectUrl = "DashboardControl"; // Administrador
                } elseif ($_SESSION["id_perfil"] == 2) {
                    $redirectUrl = "DashboardControl"; // Supervisor
                } elseif ($_SESSION["id_perfil"] == 3) {
                    $redirectUrl = "ControlMantenimientos"; // Soporte Técnico
                }

                // Devolver respuesta JSON para AJAX
                echo json_encode([
                    // "id" => $_SESSION["id"] ,
                    // "usuario red" => $_SESSION["usuario_red"] ,
                    // "perfil" => $_SESSION["id_perfil"],
                    "status" => "success",
                    "redirect" => $redirectUrl
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Credenciales incorrectas"
                ]);
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    public function Close()
    {
        try {
            // Iniciar sesión
            session_start();

            // Destruir todas las variables de sesión
            $_SESSION = [];

            // Destruir la sesión
            session_destroy();


            // Eliminar la cookie de sesión si se usa
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }

            // Redirigir al usuario a la página de login
            header("Location: Index");
            exit;
        } catch (Exception $th) {
            throw $th->getMessage();
        }
    }
}
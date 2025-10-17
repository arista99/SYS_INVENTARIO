<?php
//MODEL
include_once('model/modelAsignacionActivo.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/asignacion_activo.php');

class ControlAsignacionActivo
{
    //VARIABLE MODELO
   
    public $ASIGNACION;
    public $HELPERS;

    public function __construct()
    {
        $this->ASIGNACION = new ModeloAsignacionActivo();
        $this->HELPERS = new ModeloHelpers();
    }

    public function ControlAsignacionActivo()
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
        $lista_celular = $this->HELPERS->ListarCelulares();
        $lista_desklap = $this->HELPERS->ListarDeskLap();
        $lista_tipo_entrega = $this->HELPERS->ListarTipoEntregas();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionactivos/asignacion.php');
    }

}

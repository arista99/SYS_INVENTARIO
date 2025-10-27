<?php
//MODEL
include_once('model/modelAsignacionAccesorio.php');
include_once('model/modelHelpers.php');

//DATA
include_once('data/asignacion_accesorio.php');

class ControlAsignacionAccesorio
{
    //VARIABLE MODELO

    public $ASIGNACION;
    public $HELPERS;

    public function __construct()
    {
        $this->ASIGNACION = new ModeloAsignacionAccesorio();
        $this->HELPERS = new ModeloHelpers();
    }

    public function ControlAsignacionAccesorio()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
            //     Redirigir al login si no está autenticado
            header("Location: Index");
            exit;
        }

        $lista_accesorio = $this->HELPERS->ListarAccesorio();
        $lista_tipo_entrega = $this->HELPERS->ListarTipoEntregas();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionaccesorios/asignacion.php');
    }

    public function ListaGenerealAsignacionAccesorio()
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
        $lista_celular = $this->HELPERS->ListarCelularesDetalle();
        $lista_desklap = $this->HELPERS->ListarDeskLapDetalle();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlmovimientos/asignacionaccesorios/listaasignacion.php');
    }
}

<?php
//MODEL
require_once('model/modelInfraestructura.php');
require_once('model/modelHelpers.php');
//DATA
require_once('data/impresora.php');

class ControlInfraestructura
{
    //VARIABLE MODELO

    public $INFRAESTRUCTURA;
    public $HELPERS;

    public function __construct()
    {
        $this->INFRAESTRUCTURA = new ModeloInfraestructura();
        $this->HELPERS = new ModeloHelpers();
    }
    
    public function CreacionInfraestructura()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['id'])) {
        //     Redirigir al login si no está autenticado
           header("Location: Index");
            exit;
        }

        $lista_condiciones = $this->HELPERS->ListarCondiciones();
        $lista_estados = $this->HELPERS->ListarEstados();
        $lista_proveedores = $this->HELPERS->ListarProveedor();
        $lista_categorias= $this->HELPERS->ListarCategoriaInfraestructura();

        $usuario = $this->HELPERS->ListarUsuarioEncabezado($_SESSION['id']);

        include_once('views/paginas/administrador/controlactivos/infraestructura/creacion.php');
    }

    public function ListaGeneralInfraestructura()
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

        include_once('views/paginas/administrador/controlactivos/infraestructura/infraestructura.php');
    }

    public function findCelular()
    {
        // Obtener valores desde la solicitud AJAX
        $infraestructura = $_POST['modelo'] ?? '';

        // Llama al modelo
        $resultados = $this->INFRAESTRUCTURA->findInfraestructura($infraestructura);

        // var_dump($resultados);
        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }
}
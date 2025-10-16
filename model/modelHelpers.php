<?php

include_once('config/conexionMysql.php');

class ModeloHelpers
{

    public $MYSQL;

    public function __construct()
    {
        try {
            $this->MYSQL = new ClassConexion(); //INICIANDO LA CONEXION A LA BD
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*==============================USUARIOS=========================================*/
    /*USUARIO ENCABEZADO*/
    public function ListarUsuarioEncabezado($id)
    {
        try {
            $sql = "SELECT nombre FROM tbl_usuarios WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array($id),
            );
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*USUARIOS GENERAL*/
    public function ListarUsuario()
    {
        try {
            $sql = "SELECT * FROM tbl_usuarios";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*USUARIOS ADMINISTRADOR*/
    public function ListarUsuarioAdministrador()
    {
        try {
            $sql = "SELECT * FROM tbl_usuarios WHERE id_perfil = 1";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*USUARIOS SUPERVISOR*/
    public function ListarUsuarioSupervisor()
    {
        try {
            $sql = "SELECT * FROM tbl_usuarios WHERE id_perfil = 2";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*USUARIOS SOPORTE*/
    public function ListarUsuarioSoporte()
    {
        try {
            $sql = "SELECT * FROM tbl_usuarios WHERE id_perfil = 3";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*====================================CATEGORIAS=======================================*/
    /*PC - LAPTOP*/
    public function ListarCategoriaDeskLap()
    {
        try {
            $sql = "SELECT * FROM tbl_categorias WHERE id IN (1,2)";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*ACCESORIO*/
    public function ListarCategoriaAccesorio()
    {
        try {
            $sql = "SELECT * FROM tbl_categorias WHERE id = 3";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*CELULAR*/
    public function ListarCategoriaCelular()
    {
        try {
            $sql = "SELECT * FROM tbl_categorias WHERE id = 4";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    
    /*IMPRESORA*/
    public function ListarCategoriaImpresora()
    {
        try {
            $sql = "SELECT * FROM tbl_categorias WHERE id = 5";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*INFRAESTRUCTURA*/
    public function ListarCategoriaInfraestructura()
    {
        try {
            $sql = "SELECT * FROM tbl_categorias WHERE id = 6";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*LICENCIAS*/
    public function ListarCategoriaLicencia()
    {
        try {
            $sql = "SELECT * FROM tbl_categorias WHERE id = 7";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*====================================FABRICANTES=======================================*/
    /*FABRICANTES*/
    public function ListarFabricantes($id_categoria)
    {
        try {
            $sql = "SELECT * FROM tbl_fabricantes where id_categoria = ?";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute([$id_categoria]);

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*====================================FABRICANTES - EDITAR=======================================*/
    /*FABRICANTES - EDITAR*/
    public function ListarFabricantesEdit()
    {
        try {
            $sql = "SELECT * FROM tbl_fabricantes";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*====================================MODELOS=======================================*/
    /*MODELOS*/
    public function ListarModelos($id_fabricante)
    {
        try {
            $sql = "SELECT * FROM tbl_modelos where id_fabricante = ?";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute([$id_fabricante]);

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*====================================MODELOS - EDITAR=======================================*/
    /*MODELOS - EDITAR*/
    public function ListarModelosEdit()
    {
        try {
            $sql = "SELECT * FROM tbl_modelos";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*====================================AREAS==============================================*/
    /*AREAS*/
    public function ListarAreas()
    {
        try {
            $sql = "SELECT * FROM tbl_areas";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================CENTRO DE COSTO=========================================*/
    /*CENTRO DE COSTO*/
    public function ListarCentrosCosto()
    {
        try {
            $sql = "SELECT * FROM tbl_centro_costo";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================TIPO DE ADJUNTOS=========================================*/
    /*TIPO DE ADJUNTOS*/
    public function ListarTipoAdjuntos()
    {
        try {
            $sql = "SELECT * FROM tbl_tipo_adjuntos";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================TIPO DE PRODUCTO=========================================*/
    /*TIPO DE PRODUCTOS*/
    public function ListarProducto()
    {
        try {
            $sql = "SELECT * FROM tbl_productos WHERE id IN(1,2)";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================ACCESORIO=========================================*/
    /*ACCESORIO*/
    public function ListarAccesorio()
    {
        try {
            $sql = "SELECT * FROM tbl_accesorios";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================PROVEEDOR=========================================*/
    /*PROVEEDOR*/
    public function ListarProveedor()
    {
        try {
            $sql = "SELECT * FROM tbl_proveedores";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================CONDICION=========================================*/
    /*CONDICION*/
    public function ListarCondiciones()
    {
        try {
            $sql = "SELECT * FROM tbl_condiciones";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================ESTADO=========================================*/
    /*ESTADO*/
    public function ListarEstados()
    {
        try {
            $sql = "SELECT * FROM tbl_estados";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================DOCUMENTOS=========================================*/
    /*DOCUMENTOS*/
    public function ListarDocumentos($id_proveedor)
    {
        try {
            $sql = "SELECT * FROM tbl_documentos where id_proveedor=?";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute([$id_proveedor]);

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

     /*==============================DOCUMENTOS - EDITAR=========================================*/
    /*DOCUMENTOS - EDITAR*/
    public function ListarDocumentosEdit()
    {
        try {
            $sql = "SELECT * FROM tbl_documentos";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    
    /*==============================PERFILES=========================================*/
    /*PERFILES*/
    public function ListarPerfiles()
    {
        try {
            $sql = "SELECT * FROM tbl_perfiles";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

     /*==============================SEDES=========================================*/
    /*SEDES*/
    public function ListarSedes()
    {
        try {
            $sql = "SELECT * FROM tbl_sedes";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

}
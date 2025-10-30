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
            $sql = "SELECT tu.id,tu.nombre,tu.usuario_red,tu.contrasena,tu.email,ts.sede,tp.perfil,ta.`area`
                    FROM tbl_usuarios AS tu
                    INNER JOIN tbl_sedes AS ts ON tu.id_sede=ts.id
                    INNER JOIN tbl_perfiles AS tp ON tu.id_perfil=tp.id
                    INNER JOIN tbl_areas AS ta ON tu.id_area=ta.id
                    WHERE tu.id NOT IN (SELECT id_usuario FROM tbl_asignaciones)";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
     /*USUARIOS GENERAL ASIGNACIONES*/
     public function ListarUsuarioAsignaciones()
     {
         try {
             $sql = "SELECT tu.id,tu.nombre,tu.usuario_red,tu.contrasena,tu.email,ts.sede,tp.perfil,ta.`area`
                     FROM tbl_usuarios AS tu
                     INNER JOIN tbl_sedes AS ts ON tu.id_sede=ts.id
                     INNER JOIN tbl_perfiles AS tp ON tu.id_perfil=tp.id
                     INNER JOIN tbl_areas AS ta ON tu.id_area=ta.id
                     WHERE tu.id IN (SELECT id_usuario FROM tbl_asignaciones)";
 
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

            return $stm->fetchAll(PDO::FETCH_OBJ);
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
    public function ListarAccesoriosDetalle()
    {
        try {
            $sql = "SELECT
                    acc.id,
                    acc.nombre,
                    acc.ns,
                    cat.categoria,
                    fab.fabricante,
                    con.condicion,
                    est.estado,
                    pro.proveedor,
                    doc.titulo
                    FROM tbl_accesorios AS acc
                    INNER JOIN tbl_categorias AS cat ON cat.id=acc.id_categoria
                    INNER JOIN tbl_fabricantes AS fab ON fab.id=acc.id_fabricante
                    INNER JOIN tbl_condiciones AS con ON con.id=acc.id_condicion
                    INNER JOIN tbl_estados AS est ON est.id=acc.id_estado
                    INNER JOIN tbl_proveedores AS pro ON pro.id=acc.id_proveedor
                    LEFT JOIN tbl_documentos AS doc ON doc.id=acc.id_documento";

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

    /*==============================CELULARES=========================================*/
    /*CELULARES*/
    public function ListarCelulares()
    {
        try {
            $sql = "SELECT * FROM tbl_celulares";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================CELULARES CON DETALLES=========================================*/
    /*CELULARES CON DETALLES*/
    public function ListarCelularesDetalle()
    {
        try {
            $sql = "SELECT 
                    cel.id,
                    cel.imei,
                    cel.numero,
                    cel.ns,
                    cat.categoria,
                    fab.fabricante,
                    mo.modelo,
                    con.condicion,
                    est.estado,
                    pro.proveedor,
                    doc.titulo
                    FROM tbl_celulares AS cel
                    INNER JOIN tbl_categorias AS cat ON cat.id=cel.id_categoria
                    INNER JOIN tbl_fabricantes AS fab ON fab.id=cel.id_fabricante
                    INNER JOIN tbl_modelos AS mo ON mo.id=cel.id_modelo
                    INNER JOIN tbl_condiciones AS con ON con.id=cel.id_condicion
                    INNER JOIN tbl_estados AS est ON est.id=cel.id_estado
                    INNER JOIN tbl_proveedores AS pro ON pro.id=cel.id_proveedor
                    LEFT JOIN tbl_documentos AS doc ON doc.id=cel.id_documento
                    WHERE cel.id NOT IN (SELECT id_celular FROM tbl_asignaciones)";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================DESKLAP=========================================*/
    /*DESKLAP*/
    public function ListarDeskLap()
    {
        try {
            $sql = "SELECT * FROM tbl_desk_lap";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================DESKLAP CON DETALLE=========================================*/
    /*DESKLAP CON DETALLE*/
    public function ListarDeskLapDetalle()
    {
        try {
            $sql = "SELECT
                        tdl.id,
                        tdl.nom_equipo,
                        tdl.ns,
                        tdl.procesador,
                        tdl.disco,
                        tdl.memoria,
                        tdl.ip,
                        tdl.numero_part,
                        DATE_FORMAT(tdl.fecha_compra, '%Y-%m-%d') AS fecha_compra,
                        DATE_FORMAT(tdl.fecha_inicio_garantia, '%Y-%m-%d') AS fecha_inicio_garantia,
                        DATE_FORMAT(tdl.fecha_fin_garantia, '%Y-%m-%d') AS fecha_fin_garantia,
                        DATE_FORMAT(tdl.fecha_baja, '%Y-%m-%d') AS fecha_baja,
                        tp.proveedor,
                        tcc.centro_costo,
                        tco.condicion,
                        te.estado,
                        tc.categoria,
                        tf.fabricante,
                        tm.modelo,
                        CONCAT(td.id, ' ' ,td.titulo) AS documento
                        FROM tbl_desk_lap AS tdl
                        LEFT JOIN tbl_proveedores AS tp ON tp.id = tdl.id_proveedor
                        LEFT JOIN tbl_centro_costo AS tcc ON tcc.id = tdl.id_centro_costo
                        LEFT JOIN tbl_condiciones AS tco ON tco.id = tdl.id_condicion
                        LEFT JOIN tbl_estados AS te ON te.id = tdl.id_estado
                        LEFT JOIN tbl_categorias AS tc ON tc.id = tdl.id_categoria
                        LEFT JOIN tbl_fabricantes AS tf ON tf.id = tdl.id_fabricante
                        LEFT JOIN tbl_modelos AS tm ON tm.id = tdl.id_modelo
                        LEFT JOIN tbl_documentos AS td ON td.id = tdl.id_documento
                        WHERE tdl.id NOT IN (SELECT id_desk_lap FROM tbl_asignaciones)";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================ENTREGAS=========================================*/
    /*ENTREGAS*/
    public function ListarTipoEntregas()
    {
        try {
            $sql = "SELECT * FROM tbl_entregas";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

    /*==============================ENTREGAS DETALLE=========================================*/
    /*ENTREGAS*/
    public function ListarTipoEntregasDetalle()
    {
        try {
            $sql = "SELECT * FROM tbl_entregas WHERE id IN (3,4)";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/

     /*==============================LISTA LICENCIAS=========================================*/
    /*LICENCIAS*/
    public function ListarLicencias()
    {
        try {
            $sql = "SELECT * FROM tbl_licencias";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*=======================================================================================*/
}
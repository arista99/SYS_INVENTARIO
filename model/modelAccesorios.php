<?php

include_once('config/conexionMysql.php');

class ModeloAccesorios
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

    /*******************************************CREAR ACCESORIO********************************************/
    public function createAccesorios(Accesorio $accesorio)
    {
        try {
            $sql = "INSERT INTO tbl_accesorios(nombre,ns,id_categoria,id_fabricante,id_condicion,id_estado,id_proveedor,id_documento) values (?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $accesorio->getnombre(),
                    $accesorio->getns(),
                    $accesorio->getid_categoria(),
                    $accesorio->getid_fabricante(),
                    $accesorio->getid_condicion(),
                    $accesorio->getid_estado(),
                    $accesorio->getid_proveedor(),
                    $accesorio->getid_documento()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Accesorio*****************************************/
    public function findAccesorio($accesorio)
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
                    CONCAT(doc.id, ' - ',doc.titulo) AS documento
                    FROM tbl_accesorios AS acc
                    INNER JOIN tbl_categorias AS cat ON cat.id=acc.id_categoria
                    INNER JOIN tbl_fabricantes AS fab ON fab.id=acc.id_fabricante
                    INNER JOIN tbl_condiciones AS con ON con.id=acc.id_condicion
                    INNER JOIN tbl_estados AS est ON est.id=acc.id_estado
                    INNER JOIN tbl_proveedores AS pro ON pro.id=acc.id_proveedor
                    LEFT JOIN tbl_documentos AS doc ON doc.id=acc.id_documento";

            if (!empty($accesorio)) {
                $sql .= " WHERE LOWER(acc.nombre) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $accesorio . '%']);
            } else {
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute();
            }

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /******************************************************************************************************/

    /*******************************************CREAR ACCESORIO********************************************/
    public function updateAccesorios(Accesorio $accesorio)
    {
        try {
            $sql = "UPDATE tbl_accesorios SET nombre=?,ns=?,id_categoria=?,id_fabricante=?,id_condicion=?,id_estado=?,id_proveedor=?,id_documento=? WHERE id=?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $accesorio->getnombre(),
                    $accesorio->getns(),
                    $accesorio->getid_categoria(),
                    $accesorio->getid_fabricante(),
                    $accesorio->getid_condicion(),
                    $accesorio->getid_estado(),
                    $accesorio->getid_proveedor(),
                    $accesorio->getid_documento(),
                    $accesorio->getid(),
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/
}

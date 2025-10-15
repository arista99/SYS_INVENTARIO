<?php

include_once('config/conexionMysql.php');

class ModeloCelulares
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

    /*******************************************CREAR CELULAR********************************************/
    public function createCelulares(Celular $celular)
    {
        try {
            $sql = "INSERT INTO tbl_celulares(imei,numero,ns,id_categoria,id_fabricante,id_modelo,id_condicion,id_estado,id_proveedor,id_documento) values (?,?,?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $celular->getimei(),
                    $celular->getnumero(),
                    $celular->getns(),
                    $celular->getid_categoria(),
                    $celular->getid_fabricante(),
                    $celular->getid_modelo(),
                    $celular->getid_condicion(),
                    $celular->getid_estado(),
                    $celular->getid_proveedor(),
                    $celular->getid_documento()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Celular*****************************************/
    public function findCelular($celular)
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
                    CONCAT(doc.id, ' ', doc.titulo) AS documento
                    FROM tbl_celulares AS cel
                    INNER JOIN tbl_categorias AS cat ON cat.id=cel.id_categoria
                    INNER JOIN tbl_fabricantes AS fab ON fab.id=cel.id_fabricante
                    LEFT JOIN tbl_modelos AS mo ON mo.id=cel.id_modelo
                    INNER JOIN tbl_condiciones AS con ON con.id=cel.id_condicion
                    INNER JOIN tbl_estados AS est ON est.id=cel.id_estado
                    INNER JOIN tbl_proveedores AS pro ON pro.id=cel.id_proveedor
                    INNER JOIN tbl_documentos AS doc ON doc.id=cel.id_documento";

            if (!empty($celular)) {
                $sql .= " WHERE LOWER(cel.numero) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $celular . '%']);
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
}
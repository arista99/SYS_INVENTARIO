<?php

include_once('config/conexionMysql.php');

class ModeloImpresoras
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
    public function createImpresoras(Impresora $impresora)
    {
        try {
            $sql = "INSERT INTO tbl_impresoras(ip,ns,fecha_compra,id_categoria,id_fabricante,id_modelo,id_estado,id_condicion,id_proveedor,id_documento) values (?,?,?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $impresora->getip(),
                    $impresora->getns(),
                    $impresora->getfecha_compra(),
                    $impresora->getid_categoria(),
                    $impresora->getid_fabricante(),
                    $impresora->getid_modelo(),
                    $impresora->getid_condicion(),
                    $impresora->getid_estado(),
                    $impresora->getid_proveedor(),
                    $impresora->getid_documento()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Celular*****************************************/
    public function findImpresora($impresora)
    {
        try {
            $sql = "SELECT
                    imp.ip,
                    imp.ns,
                    DATE_FORMAT(imp.fecha_compra, '%Y-%m-%d') AS fecha_compra,
                    DATE_FORMAT(imp.fecha_instalacion, '%Y-%m-%d') AS fecha_instalacion,
                    DATE_FORMAT(imp.fecha_retiro, '%Y-%m-%d') AS fecha_retiro,
                    cat.categoria,
                    fab.fabricante,
                    mo.modelo,
                    are.`area`,
                    sed.sede,
                    est.estado,
                    con.condicion,
                    pro.proveedor,
                    doc.titulo
                    FROM tbl_impresoras AS imp
                    INNER JOIN tbl_categorias AS cat ON cat.id=imp.id_categoria
                    INNER JOIN tbl_fabricantes AS fab ON fab.id=imp.id_fabricante
                    INNER JOIN tbl_modelos AS mo ON mo.id=imp.id_modelo
                    LEFT JOIN tbl_areas AS are ON are.id=imp.id_area
                    LEFT JOIN tbl_sedes AS sed ON sed.id=imp.id_sede
                    INNER JOIN tbl_estados AS est ON est.id=imp.id_estado
                    INNER JOIN tbl_condiciones AS con ON con.id=imp.id_condicion
                    INNER JOIN tbl_proveedores AS pro ON pro.id=imp.id_proveedor
                    LEFT JOIN tbl_documentos AS doc ON doc.id=imp.id_documento";

            if (!empty($impresora)) {
                $sql .= " WHERE LOWER(mo.modelo) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $impresora . '%']);
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
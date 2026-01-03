<?php

include_once('config/conexionMysql.php');

class ModeloInfraestructura
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
    public function createInfraestructura(Infraestructura $infraestructura)
    {
        try {
            $sql = "INSERT INTO tbl_infraestructura(ip,ns,fecha_compra,id_categoria,id_fabricante,id_modelo,id_proveedor,id_documento) values (?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $infraestructura->getip(),
                    $infraestructura->getns(),
                    $infraestructura->getfecha_compra(),
                    $infraestructura->getid_categoria(),
                    $infraestructura->getid_fabricante(),
                    $infraestructura->getid_modelo(),
                    $infraestructura->getid_proveedor(),
                    $infraestructura->getid_documento()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Celular*****************************************/
    public function findInfraestructura($infraestructura)
    {
        try {
            $sql = "SELECT 
                    ti.id,
                    ti.ip,
                    ti.ns,
                    ti.dns,
                    ti.enlace,
                    ti.mac,
                    ti.fecha_compra,
                    ta.`area`,
                    ts.sede,
                    tc.categoria,
                    tf.fabricante,
                    tm.modelo,
                    tco.condicion,
                    te.estado,
                    tp.proveedor,
                    ti.id_documento,
                    td.titulo
                    FROM tbl_infraestructura AS ti
                    LEFT JOIN tbl_areas AS ta ON ta.id=ti.id_area
                    LEFT JOIN tbl_sedes AS ts ON ts.id=ti.id_sede
                    INNER JOIN tbl_categorias AS tc ON tc.id=ti.id_categoria
                    INNER JOIN tbl_fabricantes AS tf ON tf.id=ti.id_fabricante
                    INNER JOIN tbl_modelos AS tm ON tm.id=ti.id_modelo
                    INNER JOIN tbl_condiciones AS tco ON tco.id=ti.id_condicion
                    INNER JOIN tbl_estados AS te ON te.id=ti.id_estado
                    INNER JOIN tbl_proveedores AS tp ON tp.id=ti.id_proveedor
                    LEFT JOIN tbl_documentos AS td ON td.id=ti.id_documento";

            if (!empty($infraestructura)) {
                $sql .= " WHERE LOWER(ti.mac) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $infraestructura . '%']);
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
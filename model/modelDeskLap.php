<?php

include_once('config/conexionMysql.php');

class ModeloDeskLap
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

    /*******************************************INSERT MULTIPLE EXCEL*****************************************/
    public function insertarFilaInventario($data)
    {
        try {
            list(
                $id_sede,
                $nom_equipo,
                $id_categoria,
                $id_fabricante,
                $ns,
                $procesador,
                $disco,
                $memoria,
                $id_condicion
            ) = $data;

            $sql = "INSERT INTO tbl_desk_lap 
                (id_sede, nom_equipo, id_categoria, id_fabricante, ns, procesador, disco, memoria, id_condicion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $conexion = $this->MYSQL->ConectarBD();
            $stm = $conexion->prepare($sql);


            // Tipos de datos: todos string ('s'), ajustar si hay enteros ('i')
            $stm->execute([
                $id_sede,
                $nom_equipo,
                $id_categoria,
                $id_fabricante,
                $ns,
                $procesador,
                $disco,
                $memoria,
                $id_condicion
            ]);

            // $stm->execute();

            return true;
        } catch (Exception $e) {
            echo "Error al insertar: " . $e->getMessage();
            return false;
        }
    }
    /******************************************************************************************************/


    /*******************************************CREAR DESKLAP********************************************/
    public function createDeskLap(DeskLap $desklap)
    {
        try {
            $sql = "INSERT INTO tbl_desk_lap(nom_equipo,ns,numero_part,procesador,disco,memoria,fecha_compra,ip,id_proveedor,id_documento,id_categoria,id_fabricante,id_modelo,id_centro_costo,id_condicion,id_estado) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $desklap->getnom_equipo(),
                    $desklap->getns(),
                    $desklap->getnumero_part(),
                    $desklap->getprocesador(),
                    $desklap->getdisco(),
                    $desklap->getmemoria(),
                    $desklap->getfecha_compra(),
                    $desklap->getip(),
                    $desklap->getid_proveedor(),
                    $desklap->getid_documento(),
                    $desklap->getid_categoria(),
                    $desklap->getid_fabricante(),
                    $desklap->getid_modelo(),
                    $desklap->getid_centro_costo(),
                    $desklap->getid_condicion(),
                    $desklap->getid_estado()    
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda DeskLap*****************************************/
    public function findDeskLap($desklap)
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
                        LEFT JOIN tbl_documentos AS td ON td.id = tdl.id_documento";

            if (!empty($desklap)) {
                $sql .= " WHERE LOWER(tdl.nom_equipo) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $desklap . '%']);
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

    /*******************************************ACTUALIZAR DESKLAP********************************************/
    public function updateDeskLap(DeskLap $desklap)
    {
        try {
            $sql = "UPDATE tbl_desk_lap SET nom_equipo =?,ns =?,procesador =?,disco =?,memoria =?,ip =?,numero_part=?,fecha_compra=?,fecha_inicio_garantia=?,fecha_fin_garantia=?,fecha_baja=?,id_proveedor=?,id_centro_costo=?,id_condicion=?,id_estado=?,id_categoria =?,id_fabricante =?,id_modelo =?,id_documento =? WHERE id=?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $desklap->getnom_equipo(),
                    $desklap->getns(),
                    $desklap->getprocesador(),
                    $desklap->getdisco(),
                    $desklap->getmemoria(),
                    $desklap->getip(),
                    $desklap->getnumero_part(),
                    $desklap->getfecha_compra(),
                    $desklap->getfecha_inicio_garantia(),
                    $desklap->getfecha_fin_garantia(),
                    $desklap->getfecha_baja(),
                    $desklap->getid_proveedor(),
                    $desklap->getid_centro_costo(),
                    $desklap->getid_condicion(),
                    $desklap->getid_estado(),
                    $desklap->getid_categoria(),
                    $desklap->getid_fabricante(),
                    $desklap->getid_modelo(),
                    $desklap->getid_documento(),
                    $desklap->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/
}

<?php

include_once('config/conexionMysql.php');

class ModeloLicencias
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

    /*******************************************VER LISTA LICENCIAS********************************************/
    public function readLicencia()
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
    /*********************************************************************************************************/
    /*******************************************Lista - Busqueda licencia*****************************************/
    public function findLicencia($software)
    {
        try {
            $sql = "SELECT 
						  tl.id,
						  tl.software,
						  tl.nro_version,
						  tl.cantidad,
						  tl.tipo,
						  tp.proveedor,
						  tl.fecha_inicio_licencia,
						  tl.fecha_fin_licencia
                    FROM tbl_licencias AS tl
                    INNER JOIN tbl_proveedores AS tp ON tp.id=tl.id_proveedor";

            if (!empty($software)) {
                $sql .= " WHERE LOWER(tl.software) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $software . '%']);
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

    /*******************************************CREAR LICENCIAS********************************************/
    public function createLicencias(Licencia $licencia)
    {
        try {
            $fecha = date('Y-m-d H:i:s');
            $sql = "INSERT INTO tbl_licencias(software,`version`,cantidad,tipo,id_proveedor,id_documento,fecha_compra) values (?,?,?,?,?,?,?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $licencia->getsoftware(),
                    $licencia->getversion(),
                    $licencia->getcantidad(),
                    $licencia->gettipo(),
                    $licencia->getid_proveedor(),
                    $licencia->getid_documento(),
                    $fecha
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ACTUALIZAR LICENCIAS********************************************/
    public function updateLicencias(Licencia $licencia)
    {
        try {
            $sql = "UPDATE tbl_licencias SET software =?,`version` =?, cantidad =?,tipo =?,id_proveedor =?,id_documento =? WHERE id =? ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $licencia->getsoftware(),
                    $licencia->getversion(),
                    $licencia->getcantidad(),
                    $licencia->gettipo(),
                    $licencia->getid_proveedor(),
                    $licencia->getid_documento(),
                    $licencia->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ELIMINAR LICENCIAS********************************************/
    public function deleteLicencias($idlicencia)
    {
        try {
            $sql = "DELETE FROM tbl_licencias WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idlicencia
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/
}
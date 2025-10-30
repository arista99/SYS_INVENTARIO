<?php

include_once('config/conexionMysql.php');

class ModeloCentroCostos
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

    /*******************************************Lista - Busqueda Centro*****************************************/
    public function findCentroCosto($centro)
    {
        try {
            $sql = "SELECT * FROM tbl_centro_costo";

            if (!empty($centro)) {
                $sql .= " WHERE LOWER(centro_costo) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $centro . '%']);
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


    /*******************************************CREAR CENTRO********************************************/
    public function createCentros(CentroCosto $centrocosto)
    {
        try {
            $sql = "INSERT INTO tbl_centro_costo(centro_costo) values (?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $centrocosto->getcentro_costo()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************CREAR CENTRO********************************************/
    public function updateCentros(CentroCosto $centrocosto)
    {
        try {
            $sql = "UPDATE tbl_centro_costo SET centro_costo = ? WHERE id=?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $centrocosto->getcentro_costo(),
                    $centrocosto->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ELIMINAR CENTRO********************************************/
    public function deleteCentros($idcentro)
    {
        try {
            $sql = "DELETE FROM tbl_centro_costo WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idcentro
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/
}

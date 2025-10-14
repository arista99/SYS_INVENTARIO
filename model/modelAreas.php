<?php

include_once('config/conexionMysql.php');

class ModeloAreas
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

    /*******************************************Lista - Busqueda Area*****************************************/
    public function findArea($area)
    {
        try {
            $sql = "SELECT * FROM tbl_areas";

            if (!empty($area)) {
                $sql .= " WHERE LOWER(area) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $area . '%']);
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

    /*******************************************CREAR AREAS********************************************/
    public function createAreas(Area $area)
    {
        try {
            $sql = "INSERT INTO tbl_areas(area) values (?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $area->getarea()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************EDITAR AREAS********************************************/
    public function updateAreas(Area $area)
    {
        try {
            $sql = "UPDATE tbl_areas SET area = ? WHERE id=? ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $area->getarea(),
                    $area->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ELIMINAR AREAS********************************************/
    public function deleteAreas($idarea)
    {
        try {
            $sql = "DELETE FROM tbl_areas WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idarea
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/
}

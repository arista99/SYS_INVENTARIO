<?php

include_once('config/conexionMysql.php');

class ModeloFabricantes
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

    /*******************************************Lista Fabricante*****************************************/
    public function readFabricante()
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

    /******************************************************************************************************/

    /*******************************************Lista - Busqueda Area*****************************************/
    public function findFabricante($fabricante)
    {
        try {
            $sql = "SELECT * FROM tbl_fabricantes";

            if (!empty($fabricante)) {
                $sql .= " WHERE LOWER(fabricante) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $fabricante . '%']);
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

    /*******************************************CREAR FABRICANTES********************************************/
    public function createFabricantes(Fabricante $fabricante)
    {
        try {
            $sql = "INSERT INTO tbl_fabricantes(fabricante) values (?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $fabricante->getfabricante()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************EDITAR FABRICANTES********************************************/
    public function updateFabricantes(Fabricante $fabricante)
    {
        try {
            $sql = "UPDATE tbl_fabricantes SET fabricante = ? WHERE id=? ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $fabricante->getfabricante(),
                    $fabricante->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

     /*******************************************ELIMINAR FABRICANTES********************************************/
     public function deleteFabricantes($idfabricante)
     {
         try {
             $sql = "DELETE FROM tbl_fabricantes WHERE id = ?";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                 array(
                     $idfabricante
                 )
             );
             return $stm;
         } catch (Exception $th) {
             echo $th->getMessage();
         }
     }
 
     /*********************************************************************************************************/
}

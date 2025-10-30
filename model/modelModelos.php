<?php

include_once('config/conexionMysql.php');

class ModeloModelos
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
    public function findModelo($modelo)
    {
        try {
            $sql = "SELECT * FROM tbl_modelos";

            if (!empty($modelo)) {
                $sql .= " WHERE LOWER(modelo) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $modelo . '%']);
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
    public function createModelos(Modelo $modelo)
    {
        try {
            $sql = "INSERT INTO tbl_modelos(modelo) values (?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $modelo->getmodelo()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************EDITAR FABRICANTES********************************************/
    public function updateModelos(Modelo $modelo)
    {
        try {
            $sql = "UPDATE tbl_modelos SET modelo = ? WHERE id=? ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $modelo->getmodelo(),
                    $modelo->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ELIMINAR FABRICANTES********************************************/
    public function deleteModelos($idmodelo)
    {
        try {
            $sql = "DELETE FROM tbl_modelos WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idmodelo
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/
}

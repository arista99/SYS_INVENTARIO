<?php

include_once('config/conexionMysql.php');

class ModeloAdjuntos
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

    /*******************************************VER LISTA ADJUNTOS********************************************/
    public function readAdjunto()
    {
        try {
            $sql = "SELECT * FROM tbl_adjuntos";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

     /*******************************************Lista - Busqueda Adjunto*****************************************/
     public function findAdjunto($adjunto)
     {
         try {
             $sql = "SELECT * FROM tbl_adjuntos";
 
             if (!empty($adjunto)) {
                 $sql .= " WHERE LOWER(adjunto) LIKE LOWER(?)";
                 $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                 $stm->execute(['%' . $adjunto . '%']);
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

     /*******************************************CREAR ADJUNTOS********************************************/
    public function createAdjuntos(Adjunto $adjunto)
    {
        try {
            $sql = "INSERT INTO tbl_adjuntos(adjunto) values (?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $adjunto->getadjunto()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

     /*******************************************ACTUALIZAR ADJUNTOS********************************************/
     public function updateAdjuntos(Adjunto $adjunto)
     {
         try {
             $sql = "UPDATE tbl_adjuntos SET adjunto =? WHERE id =?";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql);
             $stm->execute(
                 array(
                     $adjunto->getadjunto(),
                     $adjunto->getid()
                 )
             );
             return $stm;
         } catch (Exception $th) {
             echo $th->getMessage();
         }
     }
     /*********************************************************************************************************/

      /*******************************************ELIMINAR ADJUNTOS********************************************/
    public function deleteAdjuntos($idadjunto)
    {
        try {
            $sql = "DELETE FROM tbl_adjuntos WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idadjunto
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/
}
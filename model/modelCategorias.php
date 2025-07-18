<?php

include_once('config/conexionMysql.php');

class ModeloCategorias
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

    /*******************************************Lista Categorias*****************************************/
    public function readCategoria()
    {
        try {
            $sql = "SELECT * FROM tbl_categorias";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
     /******************************************************************************************************/

    
     /*******************************************Lista - Busqueda Categoria*****************************************/
     public function findCategoria($categoria)
     {
         try {
             $sql = "SELECT * FROM tbl_categorias";
 
             if (!empty($categoria)) {
                 $sql .= " WHERE LOWER(categoria) LIKE LOWER(?)";
                 $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                 $stm->execute(['%' . $categoria . '%']);
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

    /*******************************************CREAR CATEGORIA********************************************/
    public function createCategorias(Categoria $categoria)
    {
        try {
            $sql = "INSERT INTO tbl_categorias(categoria) values (?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $categoria->getcategoria()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************CREAR CATEGORIA********************************************/
    public function updateCategorias(Categoria $categoria)
    {
        try {
            $sql = "UPDATE tbl_categorias SET categoria = ? WHERE id=?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $categoria->getcategoria(),
                    $categoria->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ELIMINAR CATEGORIA********************************************/
    public function deleteCategorias($idcategoria)
    {
        try {
            $sql = "DELETE FROM tbl_categorias WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idcategoria
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/
}
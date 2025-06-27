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
    
    /*******************************************VER LISTA AREAS********************************************/
    public function readAreas()
    {
        try {
            $sql = "SELECT * FROM tbl_areas";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

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
            $sql = "INSERT INTO tbl_areas(area) values(?) ";
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
  
}
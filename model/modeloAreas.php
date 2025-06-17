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

}
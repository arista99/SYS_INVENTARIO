<?php

include_once('config/conexionMysql.php');

class ModeloPerfiles
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
    
    /*******************************************VER LISTA PERFILES********************************************/
    public function readPefiles()
    {
        try {
            $sql = "SELECT * FROM tbl_perfiles";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

}
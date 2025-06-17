<?php

include_once('config/conexionMysql.php');

class ModeloSedes
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
    
    /*******************************************VER LISTA SEDES********************************************/
    public function readSedes()
    {
        try {
            $sql = "SELECT * FROM tbl_sedes";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

}
<?php

include_once('config/conexionMysql.php');

class ModeloCentro
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
    
    /*******************************************VER LISTA CENTRO DE COSTO********************************************/
    public function readCentro()
    {
        try {
            $sql = "SELECT * FROM tbl_centro_costo";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

}
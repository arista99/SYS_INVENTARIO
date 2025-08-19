<?php

include_once('config/conexionMysql.php');

class ModeloAccesorio
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

    public function readAccesorio()
    {
        try {
            $sql = "SELECT * FROM tbl_accesorios";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();


            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
}
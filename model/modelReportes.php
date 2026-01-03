<?php

include_once('config/conexionMysql.php');

class ModeloReportes
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

    /*******************************************ACTIVOS POR AREA*****************************************/
    public function activosAreas()
    {
        try {
            $sql = "SELECT
                    are.`area` AS area_usuario,
                    COUNT(*) AS total
                    FROM tbl_asignaciones AS asi
                    INNER JOIN tbl_usuarios AS usu ON usu.id = asi.id_usuario
                    LEFT JOIN tbl_areas AS are ON are.id=usu.id_area
                    GROUP BY area_usuario";

                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute();
        
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /******************************************************************************************************/

    
    /*******************************************ACTIVOS POR ESTADO*****************************************/
    public function activosEstados()
    {
        try {
            $sql = "SELECT 
                    te.estado,
                    COUNT(*) AS total 
                    FROM tbl_desk_lap AS tdl
                    INNER JOIN tbl_estados AS te ON te.id=tdl.id_estado
                    GROUP BY id_estado;";

                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute();
        
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /******************************************************************************************************/
    
}

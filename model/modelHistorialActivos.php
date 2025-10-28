<?php

include_once('config/conexionMysql.php');

class ModeloHistorialActivos
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

     /*******************************************Lista - BUSQUEDA HISTORIAL ACTIVOS*****************************************/
    public function findHistorialActivos()
    {
        try {
            $sql = "SELECT 
                    ha.id,
                    ha.tipo_activo,
                    usua.nombre AS usuario_anterior,
                    usun.nombre AS usuario_nuevo,
                    ent.entrega,
                    ha.fecha_movimiento,
                    ha.observacion
                    FROM tbl_historial_activos AS ha
                    INNER JOIN tbl_usuarios AS usua ON usua.id=ha.id_usuario_anterior
                    LEFT JOIN tbl_usuarios AS usun ON usun.id=ha.id_usuario_nuevo
                    INNER JOIN tbl_entregas AS ent ON ent.id=ha.id_entrega";

            // if (!empty($asignado)) {
            //     $sql .= " AND LOWER(equipo) LIKE LOWER(?)";
            //     $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            //     $stm->execute(['%' . $usuario . '%']);
            // } else {
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute();
            // }

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /******************************************************************************************************/

}
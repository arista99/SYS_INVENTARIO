<?php

include_once('config/conexionMysql.php');

class ModeloAsignacionAccesorio
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

     /*******************************************CREAR ASIGNACION ACTIVO********************************************/
     public function createAsignacionAccesorio(AsignacionAccesorio $asignacionaccesorio)
     {
         try {
             $sql = "INSERT INTO tbl_asignacion_accesorios (id_asignacion, id_accesorio, observacion, id_entrega) VALUES (?,?,?,?)";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql);
             $stm->execute(
                 array(
                     $asignacionaccesorio->getid_asignacion(),
                     $asignacionaccesorio->getid_accesorio(),
                     $asignacionaccesorio->getobservacion(),
                     $asignacionaccesorio->getid_entrega(),
                 )
             );
             return $stm;
         } catch (Exception $th) {
             echo $th->getMessage();
         }
     }
     /*********************************************************************************************************/

     /*******************************************Lista - BUSQUEDA ASIGNACION ACCESORIO*****************************************/
    public function findAsignacionAccesorio($asignado)
    {
        try {
            $sql = "SELECT
                    taa.id,
                    taa.id_asignacion,
                    usu.nombre AS nombre_usuario,
                    acc.nombre AS nombre_accesorio,
                    taa.observacion,
                    taa.fecha_moviento,
                    ent.entrega
                    FROM tbl_asignacion_accesorios AS taa
                    INNER JOIN tbl_asignaciones AS asi ON asi.id = taa.id_asignacion
                    LEFT JOIN tbl_usuarios AS usu ON usu.id=asi.id_usuario
                    INNER JOIN tbl_accesorios AS acc ON acc.id = taa.id_accesorio
                    INNER JOIN tbl_entregas AS ent ON ent.id = taa.id_entrega
                    WHERE ent.entrega <> '3'";

            if (!empty($asignado)) {
                $sql .= " AND LOWER(nombre_usuario) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $asignado . '%']);
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

}
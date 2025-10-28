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
             $sql = "INSERT INTO tbl_asignacion_accesorios (id_usuario, id_accesorio, observacion, id_entrega) VALUES (?,?,?,?)";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql);
             $stm->execute(
                 array(
                     $asignacionaccesorio->getid_usuario(),
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
                    taa.id_usuario,
                    usu.nombre,
                    taa.id_accesorio,
                    CONCAT(acc.nombre , ' - ' , acc.ns) AS equipo,
                    DATE_FORMAT(taa.fecha_asignacion, '%Y-%m-%d') AS fecha_asignacion,
                    taa.observacion,
                    taa.id_entrega,
                    ent.entrega
                    FROM tbl_asignacion_accesorios AS taa
                    INNER JOIN tbl_usuarios AS usu ON usu.id = taa.id_usuario
                    INNER JOIN tbl_accesorios AS acc ON acc.id = taa.id_accesorio
                    INNER JOIN tbl_entregas AS ent ON ent.id = taa.id_entrega
                    WHERE ent.entrega <> '3'";

            if (!empty($asignado)) {
                $sql .= " AND LOWER(equipo) LIKE LOWER(?)";
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
<?php

include_once('config/conexionMysql.php');

class ModeloAsignacionLicencia
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

     /*******************************************CREAR ASIGNACION LICENCIA********************************************/
     public function createAsignacionLicencia(AsignacionLicencia $asignacionlicencia)
     {
        try {

            $sql_stock = "UPDATE tbl_licencias SET cantidad_disponible = cantidad_disponible - 1 WHERE id = ? AND cantidad_disponible > 0";
            $stm_stock = $this->MYSQL->ConectarBD()->prepare($sql_stock);
            $stm_stock->execute([$asignacionlicencia->getid_licencia()]);

             // Si no se descontó (stock = 0), detener todo
            if ($stm_stock->rowCount() == 0) {
                $this->MYSQL->ConectarBD()->rollBack();
                return false; // NO hay stock disponible
            }

            $sql = "INSERT INTO tbl_licencias_asignada (id_desk_lap, id_licencia, fecha_asignacion) VALUES (?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $asignacionlicencia->getid_desk_lap(),
                    $asignacionlicencia->getid_licencia(),
                    $asignacionlicencia->getfecha_asignacion()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
     }
     /*********************************************************************************************************/

     /*******************************************Lista - BUSQUEDA ASIGNACION LICENCIA*****************************************/
    public function findAsignacionLicencia($equipo)
    {
        try {
            $sql = "SELECT 
                    tla.id,
                    tdl.nom_equipo,
                    tl.software,
                    tl.`version`,
                    tl.tipo,
                    DATE_FORMAT(tla.fecha_asignacion, '%Y-%m-%d') AS fecha_asignacion
                    FROM tbl_licencias_asignada AS tla
                    INNER JOIN tbl_desk_lap AS tdl ON tdl.id=tla.id_desk_lap
                    INNER JOIN tbl_licencias AS tl ON tl.id=tla.id_licencia";

            if (!empty($equipo)) {
                $sql .= " WHERE LOWER(tdl.nom_equipo) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $equipo . '%']);
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
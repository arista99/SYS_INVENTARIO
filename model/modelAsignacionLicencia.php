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

     /*******************************************CREAR ASIGNACION LICENCIA********************************************/
     public function createAsignacionLicencia(AsignacionLicencia $asignacionlicencia)
     {
         try {
             $sql = "INSERT INTO tbl_licencias_asignada (id_desk_lap, id_licencia, fecha_asignacion) VALUES (?,?,?)";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql);
             $stm->execute(
                 array(
                     $asignacionlicencia->getid_desk_lap(),
                     $asignacionlicencia->getid_licencia(),
                     $asignacionlicencia->getfecha_asignacion(),
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
                    man.id,
                    CONCAT(dl.nom_equipo, ' - ', dl.ns) AS equipo,
                    man.descripcion,
                    man.observacion,
                    man.fecha_inicio,
                    man.fecha_fin,
                    usu.nombre,
                    pro.proveedor,
                    esti.estado AS estado_inicial,
                    estf.estado AS estado_final
                    FROM tbl_mantenimientos AS man
                    INNER JOIN tbl_desk_lap AS dl ON dl.id=man.id_desk_lap
                    INNER JOIN tbl_tipos_mantenimiento AS tm ON tm.id=man.id_tipo_mantenimiento
                    INNER JOIN tbl_usuarios AS usu ON usu.id=man.id_usuario_soporte
                    LEFT JOIN tbl_proveedores AS pro ON pro.id=man.id_proveedor
                    INNER JOIN tbl_estados AS esti ON esti.id=man.id_estado_inicial
                    LEFT JOIN tbl_estados AS estf ON estf.id=man.id_estado_final";

            if (!empty($equipo)) {
                $sql .= " WHERE LOWER(equipo) LIKE LOWER(?)";
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
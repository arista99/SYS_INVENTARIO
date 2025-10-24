<?php

include_once('config/conexionMysql.php');

class ModeloAsignacionActivo
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

    /*******************************************CREAR CELULAR********************************************/
    public function createAsignacionActivo(AsignacionActivo $asignacionactivo)
    {
        try {
            $sql = "INSERT INTO tbl_asignaciones(id_usuario,id_celular,id_desk_lap,observacion,id_entrega) values (?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $asignacionactivo->getid_usuario(),
                    $asignacionactivo->getid_celular(),
                    $asignacionactivo->getid_desk_lap(),
                    $asignacionactivo->getobservacion(),
                    $asignacionactivo->getid_entrega(),
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Celular*****************************************/
    public function findAsignacionActivo($asignado)
    {
        try {
            $sql = "SELECT
                    asi.id,
                    asi.id_usuario,
                    are.`area` AS area_usuario,
                    usu.nombre AS nombre_usuario,
                    asi.id_celular,
                    fab.fabricante AS fabricante_celular,
                    mo.modelo AS modelo_celular,
                    cel.numero AS numero_celular,
                    cel.ns AS numero_serie_celular,
                    asi.id_desk_lap,
                    fabdl.fabricante AS fabricante_pc,
                    modl.modelo AS modelo_pc,
                    desk.ns AS numero_serie_pc,
                    asi.observacion,
                    DATE_FORMAT(asi.fecha_movimiento,'%Y-%m-%d') AS fecha_movimiento,
                    ent.entrega AS tipo_entrega
                    FROM tbl_asignaciones AS asi
                    INNER JOIN tbl_usuarios AS usu ON usu.id = asi.id_usuario
                    LEFT JOIN tbl_areas AS are ON are.id=usu.id_area
                    LEFT JOIN tbl_celulares AS cel ON cel.id = asi.id_celular
                    LEFT JOIN tbl_modelos AS mo ON mo.id = cel.id_modelo
                    LEFT JOIN tbl_fabricantes AS fab ON fab.id = mo.id_fabricante
                    LEFT JOIN tbl_desk_lap AS desk ON desk.id = asi.id_desk_lap
                    LEFT JOIN tbl_modelos AS modl ON modl.id = desk.id_modelo
                    LEFT JOIN tbl_fabricantes AS fabdl ON fabdl.id = modl.id_fabricante
                    INNER JOIN tbl_entregas AS ent ON ent.id = asi.id_entrega
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

    /*******************************************EDITAR ASIGNACION ACTIVO********************************************/
    public function updateAsignacionActivo(AsignacionActivo $asignacionactivo)
    {
        try {
            $sql = "UPDATE tbl_asignaciones SET id_usuario = ? , id_celular = ? , id_desk_lap = ? , observacion = ? , id_entrega = ? WHERE id = ? ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $asignacionactivo->getid_usuario(),
                    $asignacionactivo->getid_celular(),
                    $asignacionactivo->getid_desk_lap(),
                    $asignacionactivo->getobservacion(),
                    $asignacionactivo->getid_entrega(),
                    $asignacionactivo->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ELIMINAR ASIGNACION ACTIVO********************************************/
    public function deleteAsignacionActivo($idasignacion)
    {
        try {
            $sql = "DELETE FROM tbl_asignaciones WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idasignacion
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/
}
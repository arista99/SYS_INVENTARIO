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
                usu.nombre,
                cel.numero,
                mo.modelo,
                desk.nom_equipo,
                asi.observacion,
                asi.fecha_movimiento,
                ent.entrega
                FROM tbl_asignaciones AS asi
                INNER JOIN tbl_usuarios AS usu ON usu.id=asi.id_usuario
                LEFT JOIN tbl_celulares AS cel ON cel.id=asi.id_celular
                LEFT JOIN tbl_modelos AS mo ON mo.id=cel.id_modelo
                LEFT JOIN tbl_desk_lap AS desk ON desk.id=asi.id_desk_lap
                INNER JOIN tbl_entregas AS ent ON ent.id=asi.id_entrega";

            if (!empty($asignado)) {
                $sql .= " WHERE LOWER(usu.nombre) LIKE LOWER(?)";
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
<?php

use Illuminate\Support\Arr;

include_once('config/conexionMysql.php');

class ModeloMantenimientos
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
     public function createMantenimiento(Mantenimiento $mantenimiento)
     {
        try {

            $sql_desk = "UPDATE tbl_desk_lap SET id_estado = 3 WHERE id = ?";
            $stm_desk = $this->MYSQL->ConectarBD()->prepare($sql_desk);
            $stm_desk->execute([$mantenimiento->getid_desk_lap()]);

            $sql = "INSERT INTO tbl_mantenimientos(id_desk_lap,id_tipo_mantenimiento,descripcion,observacion,fecha_inicio,id_usuario_soporte,id_proveedor,id_estado) VALUES (?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $mantenimiento->getid_desk_lap(),
                    $mantenimiento->getid_tipo_mantenimiento(),
                    $mantenimiento->getdescripcion(),
                    $mantenimiento->getobservacion(),
                    $mantenimiento->getfecha_inicio(),
                    $mantenimiento->getid_usuario_soporte(),
                    $mantenimiento->getid_proveedor(),
                    $mantenimiento->getid_estado()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda licencia*****************************************/
    public function findMantenimiento($mantenimiento)
    {
        try {
            $sql = "SELECT
                    tm.id,
                    tm.id_desk_lap,
                    tdl.nom_equipo,
                    tf.fabricante,
                    tbm.modelo,
                    tdl.ns,
                    ttm.tipo,
                    tm.descripcion,
                    tm.observacion,
                    DATE_FORMAT(tm.fecha_inicio, '%Y-%m-%d') AS fecha_inicio,
                    DATE_FORMAT(tm.fecha_fin, '%Y-%m-%d') AS fecha_fin,
                    tu.nombre,
                    tm.id_proveedor,
                    tp.proveedor,
                    tei.estado
                    FROM tbl_mantenimientos AS tm
                    INNER JOIN tbl_desk_lap AS tdl ON tdl.id=tm.id_desk_lap
                    INNER JOIN tbl_fabricantes AS tf ON tf.id=tdl.id_fabricante
                    INNER JOIN tbl_modelos AS tbm ON tbm.id=tdl.id_modelo
                    INNER JOIN tbl_tipos_mantenimiento AS ttm ON ttm.id=tm.id_tipo_mantenimiento
                    INNER JOIN tbl_usuarios AS tu ON tu.id=tm.id_usuario_soporte
                    INNER JOIN tbl_proveedores AS tp ON tp.id=tm.id_proveedor
                    INNER JOIN tbl_estados AS tei ON tei.id=tm.id_estado
            ";

            if (!empty($mantenimiento)) {
                $sql .= " WHERE LOWER(tdl.nom_equipo) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $mantenimiento . '%']);
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
    
    /*******************************************EDITAR MANTENIMIENTO********************************************/
    public function updateMantenimiento(Mantenimiento $mantenimiento)
    {
        try {
             if ($mantenimiento->getid_estado() == 5) { // Operativo
                $sql_desk = "UPDATE tbl_desk_lap SET id_estado = 2 WHERE id = ?";
                $stm_desk = $this->MYSQL->ConectarBD()->prepare($sql_desk);
                $stm_desk->execute([$mantenimiento->getid_desk_lap()]);
            }

            $sql = "UPDATE tbl_mantenimientos SET id_desk_lap = ?,id_tipo_mantenimiento  = ?, id_proveedor = ? ,id_estado = ?,descripcion  = ?,observacion  = ?,fecha_fin  = ?,id_usuario_soporte  = ? WHERE id = ? ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $mantenimiento->getid_desk_lap(),
                    $mantenimiento->getid_tipo_mantenimiento(),
                    $mantenimiento->getid_proveedor(),
                    $mantenimiento->getid_estado(),
                    $mantenimiento->getdescripcion(),
                    $mantenimiento->getobservacion(),
                    $mantenimiento->getfecha_fin(),
                    $mantenimiento->getid_usuario_soporte(),
                    $mantenimiento->getid()
                )
            );

            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

     /*******************************************Da - Busqueda licencia*****************************************/
    public function dataPDFMantenimiento(Mantenimiento $mantenimiento)
    {
        try {
            $sql = "SELECT
                    tm.id,
                    tdl.id AS id_equipo,
                    tdl.nom_equipo,
                    tf.fabricante,
                    tbm.modelo,
                    tdl.disco,
                    tdl.procesador,
                    tdl.memoria,
                    tdl.ns,
                    ttm.tipo,
                    tm.descripcion,
                    tm.observacion,
                    DATE_FORMAT(tm.fecha_inicio, '%Y-%m-%d') AS fecha_inicio,
                    DATE_FORMAT(tm.fecha_fin, '%Y-%m-%d') AS fecha_fin,
                    tu.nombre,
                    tp.proveedor,
                    tei.estado,
                    (
                        SELECT tcel.numero
                        FROM tbl_asignaciones AS tasig
                        INNER JOIN tbl_celulares AS tcel 
                            ON tcel.id = tasig.id_celular
                        WHERE tasig.id_usuario = tm.id_usuario_soporte
                        ORDER BY tasig.id DESC
                        LIMIT 1
                    ) AS numero,
                    ( 
						  		SELECT tblusu.nombre FROM tbl_asignaciones AS asi
								INNER JOIN tbl_usuarios AS tblusu ON tblusu.id=asi.id_usuario
								WHERE asi.id_desk_lap=tdl.id
								ORDER BY asi.id DESC
								LIMIT 1
							) AS usuario_responsable,
							(
								SELECT tblcel.numero FROM tbl_asignaciones AS asi
								INNER JOIN tbl_celulares AS tblcel ON tblcel.id=asi.id_celular
								WHERE asi.id_desk_lap=tdl.id
								ORDER BY asi.id DESC
								LIMIT 1
							) AS numero_usuario
                FROM tbl_mantenimientos AS tm
                INNER JOIN tbl_desk_lap AS tdl ON tdl.id = tm.id_desk_lap
                INNER JOIN tbl_fabricantes AS tf ON tf.id = tdl.id_fabricante
                INNER JOIN tbl_modelos AS tbm ON tbm.id = tdl.id_modelo
                INNER JOIN tbl_tipos_mantenimiento AS ttm ON ttm.id = tm.id_tipo_mantenimiento
                INNER JOIN tbl_usuarios AS tu ON tu.id = tm.id_usuario_soporte
                INNER JOIN tbl_proveedores AS tp ON tp.id = tm.id_proveedor
                INNER JOIN tbl_estados AS tei ON tei.id = tm.id_estado
            ";

            $sql .= " WHERE tm.id = ?";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(array(
                $mantenimiento->getid()
            ));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /******************************************************************************************************/
}



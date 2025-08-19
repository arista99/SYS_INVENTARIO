<?php

include_once('config/conexionMysql.php');

class ModeloActivosPC
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

    /*******************************************Lista - Busqueda Activos PC*****************************************/
    public function readActivoPC()
    {
        try {
            $sql = "SELECT * FROM tbl_desk_lap";

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();


            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /******************************************************************************************************/

    /*******************************************INSERT MULTIPLE EXCEL*****************************************/
    public function insertarFilaInventario($data)
    {
        try {
            list(
                $id_sede,
                $nom_equipo,
                $id_categoria,
                $id_fabricante,
                $ns,
                $procesador,
                $disco,
                $memoria,
                $id_condicion
            ) = $data;

            $sql = "INSERT INTO tbl_desk_lap 
                (id_sede, nom_equipo, id_categoria, id_fabricante, ns, procesador, disco, memoria, id_condicion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $conexion = $this->MYSQL->ConectarBD();
            $stm = $conexion->prepare($sql);


            // Tipos de datos: todos string ('s'), ajustar si hay enteros ('i')
            $stm->execute([
                $id_sede,
                $nom_equipo,
                $id_categoria,
                $id_fabricante,
                $ns,
                $procesador,
                $disco,
                $memoria,
                $id_condicion
            ]);

            // $stm->execute();

            return true;
        } catch (Exception $e) {
            echo "Error al insertar: " . $e->getMessage();
            return false;
        }
    }
    /******************************************************************************************************/


    /*******************************************CREAR ACTIVOS PC********************************************/
    public function createActivosPC(Activopc $activopc)
    {
        try {
            $sql = "INSERT INTO tbl_desk_lap(nom_equipo,ns,numero_part,procesador,disco,memoria,mac_ethernet,mac_wireless,ip,id_usuario,id_sede,id_categoria,id_centro_costo,id_area,id_fabricante,id_proveedor,id_condicion,id_estado,id_modelo,id_documento) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $activopc->getnom_equipo(),
                    $activopc->getns(),
                    $activopc->getnumero_part(),
                    $activopc->getprocesador(),
                    $activopc->getdisco(),
                    $activopc->getmemoria(),
                    $activopc->getmac_ethernet(),
                    $activopc->getmac_wireless(),
                    $activopc->getip(),
                    $activopc->getid_usuario(),
                    $activopc->getid_sede(),
                    $activopc->getid_categoria(),
                    $activopc->getid_centro_costo(),
                    $activopc->getid_area(),
                    $activopc->getid_fabricante(),
                    $activopc->getid_proveedor(),
                    $activopc->getid_condicion(),
                    $activopc->getid_estado(),
                    $activopc->getid_modelo(),
                    $activopc->getid_documento()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Activopc*****************************************/
    public function findActivopc($activopc)
    {
        try {
            $sql = "SELECT 
                        tdl.id,
                        ts.sede,
                        tu.usuario,
                        tdl.nom_equipo,
                        tc.categoria,
                        tcc.centro_costo,
                        ta.area,
                        tf.fabricante,
                        tdl.ns,
                        tdl.procesador,
                        tp.proveedor,
                        tdl.mac_ethernet,
                        tdl.mac_wireless,
                        tdl.disco,
                        tdl.memoria,
                        tdl.ip,
                        tdl.numero_part, 
                        tco.condicion,
                        te.estado,
                        tm.modelo,
                        td.documento
                        FROM tbl_desk_lap AS tdl
                        LEFT JOIN tbl_sedes AS ts ON ts.id = tdl.id_sede
                        LEFT JOIN tbl_usuarios AS tu ON tu.id = tdl.id_usuario
                        LEFT JOIN tbl_categorias AS tc ON tc.id = tdl.id_categoria
                        LEFT JOIN tbl_centro_costo AS tcc ON tcc.id = tdl.id_centro_costo
                        LEFT JOIN tbl_areas AS ta ON ta.id = tdl.id_area
                        LEFT JOIN tbl_fabricantes AS tf ON tf.id = tdl.id_fabricante
                        LEFT JOIN tbl_proveedores AS tp ON tp.id = tdl.id_proveedor
                        LEFT JOIN tbl_condiciones AS tco ON tco.id = tdl.id_condicion
                        LEFT JOIN tbl_estados AS te ON te.id = tdl.id_estado
                        LEFT JOIN tbl_modelos AS tm ON tm.id = tdl.id_modelo
                        LEFT JOIN tbl_documentos AS td ON td.id = tdl.id_documento";

            if (!empty($activopc)) {
                $sql .= " WHERE LOWER(tdl.nom_equipo) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $activopc . '%']);
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

    /*******************************************ACTUALIZAR ACTIVOS PC********************************************/
    public function updateActivosPC(Activopc $activopc)
    {
        try {
            $sql = "UPDATE tbl_desk_lap SET nom_equipo =?,ns =?,numero_part =?,procesador =?,disco =?,memoria =?,mac_ethernet =?,mac_wireless =?,ip =?,id_usuario =?,id_sede =?,id_categoria =?,id_centro_costo =?,id_area =?,id_fabricante =?,id_proveedor =?,id_condicion =?,id_estado =?,id_modelo =?,id_documento =? WHERE id=?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $activopc->getnom_equipo(),
                    $activopc->getns(),
                    $activopc->getnumero_part(),
                    $activopc->getprocesador(),
                    $activopc->getdisco(),
                    $activopc->getmemoria(),
                    $activopc->getmac_ethernet(),
                    $activopc->getmac_wireless(),
                    $activopc->getip(),
                    $activopc->getid_usuario(),
                    $activopc->getid_sede(),
                    $activopc->getid_categoria(),
                    $activopc->getid_centro_costo(),
                    $activopc->getid_area(),
                    $activopc->getid_fabricante(),
                    $activopc->getid_proveedor(),
                    $activopc->getid_condicion(),
                    $activopc->getid_estado(),
                    $activopc->getid_modelo(),
                    $activopc->getid_documento(),
                    $activopc->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/
}

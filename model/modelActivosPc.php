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
}
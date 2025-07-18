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
}
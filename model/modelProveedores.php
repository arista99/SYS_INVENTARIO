<?php

include_once('config/conexionMysql.php');

class ModeloProveedores
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

    /*******************************************Lista - Busqueda Proveedor*****************************************/
    public function findProveedor($proveedor)
    {
        try {
            $sql = "SELECT 
                    tpro.id,
                    tpro.proveedor,
                    tpro.direccion,
                    tpro.contacto,
                    tpro.email,
                    tpro.telefono
                    FROM tbl_proveedores AS tpro";

            if (!empty($proveedor)) {
                $sql .= " WHERE LOWER(tpro.proveedor) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $proveedor . '%']);
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

    /*******************************************CREAR PROVEEDORES********************************************/
    public function createProveedores(Proveedor $proveedor)
    {
        try {
            $sql = "INSERT INTO tbl_proveedores(proveedor,direccion,contacto,email,telefono) values (?,?,?,?,?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $proveedor->getproveedor(),
                    $proveedor->getdireccion(),
                    $proveedor->getcontacto(),
                    $proveedor->getemail(),
                    $proveedor->gettelefono()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ACTUALIZAR PROVEEDOR********************************************/
    public function updateProveedores(Proveedor $proveedor)
    {
        try {
            $sql = "UPDATE tbl_proveedores SET proveedor =?, direccion =?, contacto =?, email =?, telefono =? WHERE id =?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $proveedor->getproveedor(),
                    $proveedor->getdireccion(),
                    $proveedor->getcontacto(),
                    $proveedor->getemail(),
                    $proveedor->gettelefono(),
                    $proveedor->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

     /*******************************************ELIMINAR ADJUNTOS********************************************/
   public function deleteProveedores($idproveedor)
   {
       try {
           $sql = "DELETE FROM tbl_proveedores WHERE id = ?";
           $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
               array(
                   $idproveedor
               )
           );
           return $stm;
       } catch (Exception $th) {
           echo $th->getMessage();
       }
   }

   /*********************************************************************************************************/
}

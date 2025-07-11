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

    /*******************************************VER LISTA PROVEEDORES********************************************/
    public function readProveedores()
    {
        try {
            $sql = "SELECT * FROM tbl_proveedores";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Proveedor*****************************************/
    public function findProveedor($proveedor)
    {
        try {
            $sql = "SELECT tpro.id,tpro.proveedor,tpro.direccion,tpro.contacto,tpro.email,tpro.telefono,tpru.producto,td.documento
                        FROM tbl_proveedores AS tpro
                        INNER JOIN tbl_productos AS tpru ON tpru.id=tpro.id_producto
                        LEFT JOIN tbl_documentos AS td ON td.id=tpro.id_documento";

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
            $sql = "INSERT INTO tbl_proveedores(proveedor,direccion,contacto,email,telefono,id_producto,id_documento) values (?,?,?,?,?,?,?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $proveedor->getproveedor(),
                    $proveedor->getdireccion(),
                    $proveedor->getcontacto(),
                    $proveedor->getemail(),
                    $proveedor->gettelefono(),
                    $proveedor->getid_producto(),
                    $proveedor->getid_documento()
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
            $sql = "UPDATE tbl_proveedores SET proveedor =?, direccion =?, contacto =?, email =?, telefono =?, id_producto =?, id_documento=? WHERE id =?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $proveedor->getproveedor(),
                    $proveedor->getdireccion(),
                    $proveedor->getcontacto(),
                    $proveedor->getemail(),
                    $proveedor->gettelefono(),
                    $proveedor->getid_producto(),
                    $proveedor->getid_documento(),
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

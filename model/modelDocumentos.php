<?php

include_once('config/conexionMysql.php');

class ModeloDocumentos
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

    /*******************************************Lista - Busqueda Documento*****************************************/
    public function findDocumento($documento)
    {
        try {
            $sql = "SELECT 
                    td.id,
                    td.titulo,
                    ta.adjunto,
                    DATE_FORMAT(td.fecha_inicio,'%Y-%m-%d') AS fecha_inicio,
                    DATE_FORMAT(td.fecha_termino,'%Y-%m-%d') AS fecha_termino,
                    pr.producto,
                    pro.proveedor
                    FROM tbl_documentos AS td 
                    INNER JOIN tbl_tipo_adjuntos AS ta ON ta.id=td.id_tipo_adjunto
                    INNER JOIN tbl_productos AS pr ON pr.id=td.id_producto
                    INNER JOIN tbl_proveedores AS pro ON pro.id=td.id_proveedor";

            if (!empty($documento)) {
                $sql .= " WHERE LOWER(td.titulo) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $documento . '%']);
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

    /*******************************************CREAR DOCUMENTOS********************************************/
    public function createDocumentos(Documento $documento)
    {
        try {
            // $fecha = date('Y-m-d H:i:s');
            $sql = "INSERT INTO tbl_documentos(titulo,id_tipo_adjunto,fecha_inicio,fecha_termino,id_producto,id_proveedor) values (?,?,?,?,?,?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array( 
                    $documento->gettitulo(),
                    $documento->getid_tipo_adjunto(),
                    $documento->getfecha_inicio(),
                    $documento->getfecha_termino(),
                    $documento->getid_producto(),
                    $documento->getid_proveedor()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ACTUALIZAR DOCUMENTOS********************************************/
    public function updateDocumentos(Documento $documento)
    {
        try {
            $sql = "UPDATE tbl_documentos SET titulo =?, id_tipo_adjunto =?, fecha_inicio =?, fecha_termino =?, id_producto =?, id_proveedor =? WHERE id=?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $documento->gettitulo(),
                    $documento->getid_tipo_adjunto(),
                    $documento->getfecha_inicio(),
                    $documento->getfecha_termino(),
                    $documento->getid_producto(),
                    $documento->getid_proveedor(),
                    $documento->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/
}

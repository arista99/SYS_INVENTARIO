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

    /*******************************************VER LISTA DOCUMENTOS********************************************/
    public function readDocumento()
    {
        try {
            $sql = "SELECT * FROM tbl_documentos";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Documento*****************************************/
    public function findDocumento($documento)
    {
        try {
            $sql = "SELECT td.id,td.documento,ta.adjunto,td.ruta_adjunto,td.fecha_registro,DATE_FORMAT(td.fecha_inicio,'%Y-%m-%d') AS fecha_ini,DATE_FORMAT(td.fecha_termino,'%Y-%m-%d') AS fecha_fin
                    FROM tbl_documentos AS td 
                    INNER JOIN tbl_adjuntos AS ta ON ta.id=td.id_adjunto";

            if (!empty($documento)) {
                $sql .= " WHERE LOWER(td.documento) LIKE LOWER(?)";
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
            $fecha = date('Y-m-d H:i:s');
            $sql = "INSERT INTO tbl_documentos(documento,id_adjunto,ruta_adjunto,fecha_registro,fecha_inicio,fecha_termino) values (?,?,?,?,?,?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $documento->getdocumento(),
                    $documento->getid_adjunto(),
                    $documento->getruta_adjunto(),
                    $fecha,
                    $documento->getfecha_inicio(),
                    $documento->getfecha_termino()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/
}

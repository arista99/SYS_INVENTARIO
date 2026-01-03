<?php

include_once('config/conexionMysql.php');

class ModeloLicencias
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

    /*******************************************Lista - Busqueda licencia*****************************************/
    public function findLicencia($software)
    {
        try {
            $sql = "SELECT
                    lic.software,
                    lic.`version`,
                    lic.cantidad_total,
                    lic.cantidad_disponible,
                    lic.tipo,
                    DATE_FORMAT(lic.fecha_inicio_licencia, '%Y-%m-%d') AS fecha_inicio_licencia,
                    DATE_FORMAT(lic.fecha_fin_licencia, '%Y-%m-%d') AS fecha_fin_licencia,
                    pro.proveedor,
                    lic.id_documento,
                    doc.titulo,
                    lic.id_categoria,
                    cat.categoria,
                    lic.id_fabricante,
                    fab.fabricante,
                    tmod.modelo
                    FROM tbl_licencias AS lic
                    INNER JOIN tbl_proveedores AS pro ON pro.id=lic.id_proveedor
                    LEFT JOIN tbl_documentos AS doc ON doc.id=lic.id_documento
                    INNER JOIN tbl_categorias AS cat ON cat.id=lic.id_categoria
                    LEFT JOIN tbl_fabricantes AS fab ON fab.id=lic.id_fabricante
                    LEFT JOIN tbl_modelos AS tmod ON tmod.id=lic.id_modelo
                    ";

            if (!empty($software)) {
                $sql .= " WHERE LOWER(lic.software) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $software . '%']);
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

    /*******************************************CREAR LICENCIAS********************************************/
    public function createLicencias(Licencia $licencia)
    {
        try {
            // $fecha = date('Y-m-d H:i:s');
            $sql = "INSERT INTO tbl_licencias(software,`version`,cantidad_total,cantidad_disponible,tipo,fecha_inicio_licencia,fecha_fin_licencia,id_proveedor,id_documento,id_categoria,id_fabricante) values (?,?,?,?,?,?,?,?,?,?,?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $licencia->getsoftware(),
                    $licencia->getversion(),
                    $licencia->getcantidad_total(),
                    $licencia->getcantidad_disponible(),
                    $licencia->gettipo(),
                    $licencia->getfecha_inicio_licencia(),
                    $licencia->getfecha_fin_licencia(),
                    $licencia->getid_proveedor(),
                    $licencia->getid_documento(),
                    $licencia->getid_categoria(),
                    $licencia->getid_fabricante()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ACTUALIZAR LICENCIAS********************************************/
    public function updateLicencias(Licencia $licencia)
    {
        try {
            $sql = "UPDATE tbl_licencias SET software =?,`version` =?, cantidad_total =?, cantidad_disponible =?,tipo =?,id_proveedor =?,id_documento =? WHERE id =? ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $licencia->getsoftware(),
                    $licencia->getversion(),
                    $licencia->getcantidad_total(),
                    $licencia->getcantidad_disponible(),
                    $licencia->gettipo(),
                    $licencia->getid_proveedor(),
                    $licencia->getid_documento(),
                    $licencia->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ELIMINAR LICENCIAS********************************************/
    public function deleteLicencias($idlicencia)
    {
        try {
            $sql = "DELETE FROM tbl_licencias WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idlicencia
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/
}
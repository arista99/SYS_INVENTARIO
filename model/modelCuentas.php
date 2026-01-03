<?php

include_once('config/conexionMysql.php');

class ModeloCuentas
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

    /*******************************************Lista - Busqueda Usuario*****************************************/
    public function findUsuario($nombre)
    {
        try {
            $sql = "SELECT tu.id,tu.nombre,tu.usuario_red,tu.contrasena,tu.email,ts.sede,tp.perfil,ta.`area`
                    FROM tbl_usuarios AS tu
                    INNER JOIN tbl_sedes AS ts ON tu.id_sede=ts.id
                    INNER JOIN tbl_perfiles AS tp ON tu.id_perfil=tp.id
                    INNER JOIN tbl_areas AS ta ON tu.id_area=ta.id";
            
            if (!empty($nombre)) {
                $sql .= " WHERE LOWER(tu.nombre) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $nombre . '%']);
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

    /*******************************************CREAR USUARIOS********************************************/
    public function createUsuarios(Usuario $usuario)
    {
        try {
            $sql = "INSERT INTO tbl_usuarios(nombre,usuario_red,contrasena,email,id_sede,id_perfil,id_area) values(?,?,?,?,?,?,?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $usuario->getnombre(),
                    $usuario->getusuario_red(),
                    $usuario->getcontrasena(),
                    $usuario->getemail(),
                    $usuario->getid_sede(),
                    $usuario->getid_perfil(),
                    $usuario->getid_area()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************ACTUALIZAR USUARIOS********************************************/
    public function updateUsuario(Usuario $usuario)
    {
        try {
            $sql = "UPDATE tbl_usuarios SET usuario = ? , usuario_red = ? , id_centro_costo = ? , email = ?, id_sede = ?, id_perfil = ?, id_area = ? WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $usuario->getnombre(),
                    $usuario->getusuario_red(),
                    $usuario->getemail(),
                    $usuario->getid_sede(),
                    $usuario->getid_perfil(),
                    $usuario->getid_area(),
                    $usuario->getid()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/

    /*******************************************ELIMINAR USUARIOS********************************************/
    public function deleteUsuario($idusuario)
    {
        try {
            $sql = "DELETE FROM tbl_usuarios WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idusuario
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*********************************************************************************************************/

}
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

    /*******************************************VER USUARIOS - ENCABEZADO********************************************/
    public function readUsuario($id)
    {
        try {
            $sql = "SELECT usuario FROM tbl_usuarios WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array($id),
            );
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista - Busqueda Usuario*****************************************/
    public function findUsuario($nombre)
    {
        try {
            $sql = "SELECT tu.id,tu.usuario,tu.usuario_red,tcc.id AS idcentro,tcc.centro_costo,tu.email,ts.id AS idsede,ts.sede,tp.id AS idperfil,tp.perfil,ta.id AS idarea,ta.area
							FROM tbl_usuarios AS tu
							INNER JOIN tbl_centro_costo AS tcc ON tu.id_centro_costo=tcc.id
							INNER JOIN tbl_sedes AS ts ON tu.id_sede=ts.id
							INNER JOIN tbl_perfiles AS tp ON tu.id_perfil=tp.id
							INNER JOIN tbl_areas AS ta ON tu.id_area=ta.id";
            
            if (!empty($nombre)) {
                $sql .= " WHERE LOWER(tu.usuario) LIKE LOWER(?)";
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
            $sql = "INSERT INTO tbl_usuarios(usuario,usuario_red,contrasena,id_centro_costo,email,cargo,id_sede,id_perfil,id_area) values(?,?,?,?,?,?,?,?,?) ";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(
                array(
                    $usuario->getusuario(),
                    $usuario->getusuario_red(),
                    $usuario->getcontrasena(),
                    $usuario->getid_centro_costo(),
                    $usuario->getemail(),
                    $usuario->getcargo(),
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
            $sql = "UPDATE usuario SET usuario = ? , usuario_red = ? , id_centro_costo = ? , cargo = ? , email = ?, id_sede = ?, id_perfil = ?, id_area = ? WHERE id = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $usuario->getusuario(),
                    $usuario->getusuario_red(),
                    $usuario->getid_centro_costo(),
                    $usuario->getcargo(),
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

    /*********************************************************************************************************/

}
<?php

class Usuario
{

    private $id;
    private $nombre;
    private $usuario_red;
    private $contrasena;
    private $email;
    private $id_sede;
    private $id_perfil;
    private $id_area;


    public function __construct()
    {
        $this->id = "";
        $this->nombre = "";
        $this->usuario_red = "";
        $this->contrasena = "";
        $this->email = "";
        $this->id_sede = "";
        $this->id_perfil = "";
        $this->id_area = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setnombre($nombre)
    {
        $this->nombre= $nombre;
    }

    function getnombre()
    {
        return $this->nombre;
    }

    function setusuario_red($usuario_red)
    {
        $this->usuario_red= $usuario_red;
    }

    function getusuario_red()
    {
        return $this->usuario_red;
    }

    function setcontrasena($contrasena)
    {
        $this->contrasena= $contrasena;
    }

    function getcontrasena()
    {
        return $this->contrasena;
    }

    function setemail($email)
    {
        $this->email= $email;
    }

    function getemail()
    {
        return $this->email;
    }

    function setid_sede($id_sede)
    {
        $this->id_sede= $id_sede;
    }

    function getid_sede()
    {
        return $this->id_sede;
    }

    function setid_perfil($id_perfil)
    {
        $this->id_perfil= $id_perfil;
    }

    function getid_perfil()
    {
        return $this->id_perfil;
    }

    function setid_area($id_area)
    {
        $this->id_area= $id_area;
    }

    function getid_area()
    {
        return $this->id_area;
    }
}
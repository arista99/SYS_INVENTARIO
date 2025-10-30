<?php

class Proveedor
{

    private $id;
    private $proveedor;
    private $direccion;
    private $contacto;
    private $email;
    private $telefono;

    public function __construct()
    {
        $this->id = "";
        $this->proveedor = "";
        $this->direccion = "";
        $this->contacto = "";
        $this->email = "";
        $this->telefono = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setproveedor($proveedor)
    {
        $this->proveedor= $proveedor;
    }

    function getproveedor()
    {
        return $this->proveedor;
    }

    function setdireccion($direccion)
    {
        $this->direccion= $direccion;
    }

    function getdireccion()
    {
        return $this->direccion;
    }
    
    function setcontacto($contacto)
    {
        $this->contacto= $contacto;
    }

    function getcontacto()
    {
        return $this->contacto;
    }

    function setemail($email)
    {
        $this->email= $email;
    }

    function getemail()
    {
        return $this->email;
    }

    function settelefono($telefono)
    {
        $this->telefono= $telefono;
    }

    function gettelefono()
    {
        return $this->telefono;
    }
}
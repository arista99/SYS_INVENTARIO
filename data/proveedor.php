<?php

class Proveedor
{

    private $id;
    private $proveedor;
    private $direccion;
    private $contacto;
    private $email;
    private $telefono;
    private $id_producto;
    private $id_documento;

    public function __construct()
    {
        $this->id = "";
        $this->proveedor = "";
        $this->direccion = "";
        $this->contacto = "";
        $this->email = "";
        $this->telefono = "";
        $this->id_producto = "";
        $this->id_documento = "";
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

    function setid_producto($id_producto)
    {
        $this->id_producto= $id_producto;
    }

    function getid_producto()
    {
        return $this->id_producto;
    }

    function setid_documento($id_documento)
    {
        $this->id_documento= $id_documento;
    }

    function getid_documento()
    {
        return $this->id_documento;
    }
}
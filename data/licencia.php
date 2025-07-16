<?php

class Licencia
{

    private $id;
    private $software;
    private $version;
    private $cantidad;
    private $tipo;
    private $id_proveedor;
    private $id_documento;
    private $fecha_compra;

    public function __construct()
    {
        $this->id = "";
        $this->software = "";
        $this->version = "";
        $this->cantidad = "";
        $this->tipo = "";
        $this->id_proveedor = "";
        $this->id_documento = "";
        $this->fecha_compra = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setsoftware($software)
    {
        $this->software= $software;
    }

    function getsoftware()
    {
        return $this->software;
    }

    function setversion($version)
    {
        $this->version= $version;
    }

    function getversion()
    {
        return $this->version;
    }

    function setcantidad($cantidad)
    {
        $this->cantidad= $cantidad;
    }

    function getcantidad()
    {
        return $this->cantidad;
    }

    function settipo($tipo)
    {
        $this->tipo= $tipo;
    }

    function gettipo()
    {
        return $this->tipo;
    }

    function setid_proveedor($id_proveedor)
    {
        $this->id_proveedor= $id_proveedor;
    }

    function getid_proveedor()
    {
        return $this->id_proveedor;
    }

    function setid_documento($id_documento)
    {
        $this->id_documento= $id_documento;
    }

    function getid_documento()
    {
        return $this->id_documento;
    }

    function setfecha_compra($fecha_compra)
    {
        $this->fecha_compra= $fecha_compra;
    }

    function getfecha_compra()
    {
        return $this->fecha_compra;
    }
}
<?php

class Licencia
{

    private $id;
    private $software;
    private $version;
    private $cantidad_total;
    private $cantidad_disponible;
    private $tipo;
    private $id_proveedor;
    private $id_documento;
    private $id_categoria;
    private $id_fabricante;
    private $fecha_inicio_licencia;
    private $fecha_fin_licencia;

    public function __construct()
    {
        $this->id = "";
        $this->software = "";
        $this->version = "";
        $this->cantidad_total = "";
        $this->cantidad_disponible = "";
        $this->tipo = "";
        $this->id_proveedor = "";
        $this->id_documento = "";
        $this->id_categoria = "";
        $this->id_fabricante = "";
        $this->fecha_inicio_licencia = "";
        $this->fecha_fin_licencia = "";
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

    function setcantidad_total($cantidad_total)
    {
        $this->cantidad_total= $cantidad_total;
    }

    function getcantidad_total()
    {
        return $this->cantidad_total;
    }

    function setcantidad_disponible($cantidad_disponible)
    {
        $this->cantidad_disponible= $cantidad_disponible;
    }

    function getcantidad_disponible()
    {
        return $this->cantidad_disponible;
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

    function setid_categoria($id_categoria)
    {
        $this->id_categoria= $id_categoria;
    }

    function getid_categoria()
    {
        return $this->id_categoria;
    }
    function setid_fabricante($id_fabricante)
    {
        $this->id_fabricante= $id_fabricante;
    }

    function getid_fabricante()
    {
        return $this->id_fabricante;
    }

    function setfecha_inicio_licencia($fecha_inicio_licencia)
    {
        $this->fecha_inicio_licencia= $fecha_inicio_licencia;
    }

    function getfecha_inicio_licencia()
    {
        return $this->fecha_inicio_licencia;
    }

    function setfecha_fin_licencia($fecha_fin_licencia)
    {
        $this->fecha_fin_licencia= $fecha_fin_licencia;
    }

    function getfecha_fin_licencia()
    {
        return $this->fecha_fin_licencia;
    }
}
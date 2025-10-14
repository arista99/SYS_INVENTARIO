<?php

class Impresora
{

    private $id;
    private $id_area;
    private $id_categoria;
    private $id_fabricante;
    private $id_modelo;
    private $id_proveedor;
    private $id_documento;
    private $ip;
    private $ns;
    private $id_sede;
    private $id_estado;
    private $id_condicion;
    private $fecha_compra;
    private $fecha_instalacion;
    private $fecha_retiro;

    public function __construct()
    {
        $this->id = "";
        $this->id_area = "";
        $this->id_categoria = "";
        $this->id_fabricante = "";
        $this->id_modelo = "";
        $this->id_proveedor = "";
        $this->id_documento = "";
        $this->ip = "";
        $this->ns = "";
        $this->id_sede = "";
        $this->id_estado = "";
        $this->id_condicion = "";
        $this->fecha_compra = "";
        $this->fecha_instalacion = "";
        $this->fecha_retiro = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setid_area($id_area)
    {
        $this->id_area= $id_area;
    }

    function getid_area()
    {
        return $this->id_area;
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

    function setid_modelo($id_modelo)
    {
        $this->id_modelo= $id_modelo;
    }

    function getid_modelo()
    {
        return $this->id_modelo;
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

    function setip($ip)
    {
        $this->ip= $ip;
    }

    function getip()
    {
        return $this->ip;
    }

    function setns($ns)
    {
        $this->ns= $ns;
    }

    function getns()
    {
        return $this->ns;
    }

    function setid_sede($id_sede)
    {
        $this->id_sede= $id_sede;
    }

    function getid_sede()
    {
        return $this->id_sede;
    }

    function setid_estado($id_estado)
    {
        $this->id_estado= $id_estado;
    }

    function getid_estado()
    {
        return $this->id_estado;
    }

    function setid_condicion($id_condicion)
    {
        $this->id_condicion= $id_condicion;
    }

    function getid_condicion()
    {
        return $this->id_condicion;
    }

    function setfecha_compra($fecha_compra)
    {
        $this->fecha_compra= $fecha_compra;
    }

    function getfecha_compra()
    {
        return $this->fecha_compra;
    }

    function setfecha_instalacion($fecha_instalacion)
    {
        $this->fecha_instalacion= $fecha_instalacion;
    }

    function getfecha_instalacion()
    {
        return $this->fecha_instalacion;
    }

    function setfecha_retiro($fecha_retiro)
    {
        $this->fecha_retiro= $fecha_retiro;
    }

    function getfecha_retiro()
    {
        return $this->fecha_retiro;
    }
}
<?php

class Infraestructura
{

    private $id;
    private $ip;
    private $ns;
    private $dns;
    private $enlace;
    private $mac;
    private $id_area;
    private $id_sede;
    private $id_proveedor;
    private $id_documento;
    private $id_categoria;
    private $id_fabricante;
    private $id_modelo;
    private $id_condicion;
    private $id_estado;
    private $fecha_compra;

    public function __construct()
    {
        $this->id = "";
        $this->ip = "";
        $this->ns = "";
        $this->dns = "";
        $this->enlace = "";
        $this->mac = "";
        $this->id_area = "";
        $this->id_sede = "";
        $this->id_proveedor = "";
        $this->id_documento = "";
        $this->id_categoria = "";
        $this->id_fabricante = "";
        $this->id_modelo = "";
        $this->id_condicion = "";
        $this->id_estado = "";
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

    function setdns($dns)
    {
        $this->dns= $dns;
    }

    function getdns()
    {
        return $this->dns;
    }

    function setenlace($enlace)
    {
        $this->enlace= $enlace;
    }

    function getenlace()
    {
        return $this->enlace;
    }

    function setmac($mac)
    {
        $this->mac= $mac;
    }

    function getmac()
    {
        return $this->mac;
    }

    function setid_area($id_area)
    {
        $this->id_area= $id_area;
    }

    function getid_area()
    {
        return $this->id_area;
    }

    function setid_sede($id_sede)
    {
        $this->id_sede= $id_sede;
    }

    function getid_sede()
    {
        return $this->id_sede;
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

    function setid_modelo($id_modelo)
    {
        $this->id_modelo= $id_modelo;
    }

    function getid_modelo()
    {
        return $this->id_modelo;
    }

    function setid_condicion($id_condicion)
    {
        $this->id_condicion= $id_condicion;
    }

    function getid_condicion()
    {
        return $this->id_condicion;
    }

    function setid_estado($id_estado)
    {
        $this->id_estado= $id_estado;
    }

    function getid_estado()
    {
        return $this->id_estado;
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
<?php

class Activopc
{

    private $id;
    private $id_sede;
    private $id_usuario;
    private $nom_equipo;
    private $id_categoria;
    private $id_centro_costo;
    private $id_area;
    private $id_fabricante;
    private $ns;
    private $procesador;
    private $id_proveedor;
    private $mac_ethernet;
    private $mac_wireless;
    private $disco;
    private $memoria;
    private $ip;
    private $numero_part;
    private $id_condicion;
    private $id_estado;
    private $id_modelo;
    private $id_documento;
    private $fecha_compra;

    public function __construct()
    {
        $this->id = "";
        $this->id_sede = "";
        $this->id_usuario = "";
        $this->nom_equipo = "";
        $this->id_categoria = "";
        $this->id_centro_costo = "";
        $this->id_area = "";
        $this->id_fabricante = "";
        $this->ns = "";
        $this->procesador = "";
        $this->id_proveedor = "";
        $this->mac_ethernet = "";
        $this->mac_wireless = "";
        $this->disco = "";
        $this->memoria = "";
        $this->ip = "";
        $this->numero_part = "";
        $this->id_condicion = "";
        $this->id_estado = "";
        $this->id_modelo = "";
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

    function setid_sede($id_sede)
    {
        $this->id_sede= $id_sede;
    }

    function getid_sede()
    {
        return $this->id_sede;
    }

    function setid_usuario($id_usuario)
    {
        $this->id_usuario= $id_usuario;
    }

    function getid_usuario()
    {
        return $this->id_usuario;
    }

    function setnom_equipo($nom_equipo)
    {
        $this->nom_equipo= $nom_equipo;
    }

    function getnom_equipo()
    {
        return $this->nom_equipo;
    }

    function setid_categoria($id_categoria)
    {
        $this->id_categoria= $id_categoria;
    }

    function getid_categoria()
    {
        return $this->id_categoria;
    }

    function setid_centro_costo($id_centro_costo)
    {
        $this->id_centro_costo= $id_centro_costo;
    }

    function getid_centro_costo()
    {
        return $this->id_centro_costo;
    }

    function setid_area($id_area)
    {
        $this->id_area= $id_area;
    }

    function getid_area()
    {
        return $this->id_area;
    }

    function setid_fabricante($id_fabricante)
    {
        $this->id_fabricante= $id_fabricante;
    }

    function getid_fabricante()
    {
        return $this->id_fabricante;
    }

    function setns($ns)
    {
        $this->ns= $ns;
    }

    function getns()
    {
        return $this->ns;
    }

    function setprocesador($procesador)
    {
        $this->procesador= $procesador;
    }

    function getprocesador()
    {
        return $this->procesador;
    }

    function setid_proveedor($id_proveedor)
    {
        $this->id_proveedor= $id_proveedor;
    }

    function getid_proveedor()
    {
        return $this->id_proveedor;
    }

    function setmac_ethernet($mac_ethernet)
    {
        $this->mac_ethernet= $mac_ethernet;
    }

    function getmac_ethernet()
    {
        return $this->mac_ethernet;
    }

    function setmac_wireless($mac_wireless)
    {
        $this->mac_wireless= $mac_wireless;
    }

    function getmac_wireless()
    {
        return $this->mac_wireless;
    }

    function setdisco($disco)
    {
        $this->disco= $disco;
    }

    function getdisco()
    {
        return $this->disco;
    }

    function setmemoria($memoria)
    {
        $this->memoria= $memoria;
    }

    function getmemoria()
    {
        return $this->memoria;
    }
    
    function setip($ip)
    {
        $this->ip= $ip;
    }

    function getip()
    {
        return $this->ip;
    }

    function setnumero_part($numero_part)
    {
        $this->numero_part= $numero_part;
    }

    function getnumero_part()
    {
        return $this->numero_part;
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

    function setid_modelo($id_modelo)
    {
        $this->id_modelo= $id_modelo;
    }

    function getid_modelo()
    {
        return $this->id_modelo;
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
<?php

class DeskLap
{

    private $id;
    private $nom_equipo;
    private $ns;
    private $procesador;
    private $disco;
    private $memoria;
    private $ip;
    private $numero_part;
    private $fecha_compra;
    private $fecha_inicio_garantia;
    private $fecha_fin_garantia;
    private $fecha_baja;
    private $id_proveedor;
    private $id_centro_costo;
    private $id_condicion;
    private $id_estado;
    private $id_categoria;
    private $id_fabricante;
    private $id_modelo;
    private $id_documento;

    public function __construct()
    {
        $this->id = "";
        $this->nom_equipo = "";
        $this->ns = "";
        $this->procesador = "";
        $this->disco = "";
        $this->memoria = "";
        $this->ip = "";
        $this->numero_part = "";
        $this->fecha_compra = "";
        $this->fecha_inicio_garantia = "";
        $this->fecha_fin_garantia = "";
        $this->fecha_baja = "";
        $this->id_proveedor = "";
        $this->id_centro_costo = "";
        $this->id_condicion = "";
        $this->id_estado = "";
        $this->id_categoria = "";
        $this->id_fabricante = "";
        $this->id_modelo = "";
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

    function setnom_equipo($nom_equipo)
    {
        $this->nom_equipo= $nom_equipo;
    }

    function getnom_equipo()
    {
        return $this->nom_equipo;
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

    function setfecha_compra($fecha_compra)
    {
        $this->fecha_compra= $fecha_compra;
    }

    function getfecha_compra()
    {
        return $this->fecha_compra;
    }

    function setfecha_inicio_garantia($fecha_inicio_garantia)
    {
        $this->fecha_inicio_garantia= $fecha_inicio_garantia;
    }

    function getfecha_inicio_garantia()
    {
        return $this->fecha_inicio_garantia;
    }

    function setfecha_fin_garantia($fecha_fin_garantia)
    {
        $this->fecha_fin_garantia= $fecha_fin_garantia;
    }

    function getfecha_fin_garantia()
    {
        return $this->fecha_fin_garantia;
    }

    function setfecha_baja($fecha_baja)
    {
        $this->fecha_baja= $fecha_baja;
    }

    function getfecha_baja()
    {
        return $this->fecha_baja;
    }

    function setid_proveedor($id_proveedor)
    {
        $this->id_proveedor= $id_proveedor;
    }

    function getid_proveedor()
    {
        return $this->id_proveedor;
    }

    function setid_centro_costo($id_centro_costo)
    {
        $this->id_centro_costo= $id_centro_costo;
    }

    function getid_centro_costo()
    {
        return $this->id_centro_costo;
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

    function setid_documento($id_documento)
    {
        $this->id_documento= $id_documento;
    }

    function getid_documento()
    {
        return $this->id_documento;
    }

}
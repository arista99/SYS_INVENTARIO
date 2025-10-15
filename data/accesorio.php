<?php 

class accesorio {
    private $id;
    private $nombre;
    private $ns;
    private $id_categoria;
    private $id_fabricante;
    private $id_condicion;
    private $id_estado;
    private $id_proveedor;
    private $id_documento;

    public function __construct()
    {
        $this->id = "";
        $this->nombre = "";
        $this->ns = "";
        $this->id_categoria = "";
        $this->id_fabricante = "";
        $this->id_condicion = "";
        $this->id_estado = "";
        $this->id_proveedor = "";
        $this->id_documento = "";
    }

    function setid($id)
    {
        $this->id = $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setnombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function getnombre()
    {
        return $this->nombre;
    }

    function setns($ns)
    {
        $this->ns = $ns;
    }

    function getns()
    {
        return $this->ns;
    }

    function setid_categoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    function getid_categoria()
    {
        return $this->id_categoria;
    }

    function setid_fabricante($id_fabricante)
    {
        $this->id_fabricante = $id_fabricante;
    }

    function getid_fabricante()
    {
        return $this->id_fabricante;
    }

    function setid_condicion($id_condicion)
    {
        $this->id_condicion = $id_condicion;
    }

    function  getid_condicion()
    {
        return $this->id_condicion;
    }

    function setid_estado($id_estado)
    {
        $this->id_estado = $id_estado;
    }

    function getid_estado()
    {
        return $this->id_estado;
    }

    function setid_proveedor($id_proveedor)
    {
        $this->id_proveedor = $id_proveedor;
    }

    function getid_proveedor()
    {
        return $this->id_proveedor;
    }
    
    function setid_documento($id_documento)
    {
        $this->id_documento = $id_documento;
    }

    function getid_documento()
    {
        return $this->id_documento;
    }
}
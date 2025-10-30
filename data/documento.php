<?php

class Documento
{

    private $id;
    private $titulo;
    private $id_tipo_adjunto;
    private $ruta_adjunto;
    private $fecha_inicio;
    private $fecha_termino;
    private $id_producto;
    private $id_proveedor;

    public function __construct()
    {
        $this->id = "";
        $this->titulo = "";
        $this->id_tipo_adjunto = "";
        $this->ruta_adjunto = "";
        $this->fecha_inicio = "";
        $this->fecha_termino = "";
        $this->id_producto = "";
        $this->id_proveedor = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function settitulo($titulo)
    {
        $this->titulo= $titulo;
    }

    function gettitulo()
    {
        return $this->titulo;
    }

    function setid_tipo_adjunto($id_tipo_adjunto)
    {
        $this->id_tipo_adjunto= $id_tipo_adjunto;
    }

    function getid_tipo_adjunto()
    {
        return $this->id_tipo_adjunto;
    }

    function setruta_adjunto($ruta_adjunto)
    {
        $this->ruta_adjunto= $ruta_adjunto;
    }

    function getruta_adjunto()
    {
        return $this->ruta_adjunto;
    }

    function setfecha_inicio($fecha_inicio)
    {
        $this->fecha_inicio= $fecha_inicio;
    }


    function getfecha_inicio()
    {
        return $this->fecha_inicio;
    }

    function setfecha_termino($fecha_termino)
    {
        $this->fecha_termino= $fecha_termino;
    }

    function getfecha_termino()
    {
        return $this->fecha_termino;
    }

    function setid_producto($id_producto)
    {
        $this->id_producto= $id_producto;
    }


    function getid_producto()
    {
        return $this->id_producto;
    }

    function setid_proveedor($id_proveedor)
    {
        $this->id_proveedor= $id_proveedor;
    }

    function getid_proveedor()
    {
        return $this->id_proveedor;
    }
}
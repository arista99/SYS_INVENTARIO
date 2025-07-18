<?php

class Documento
{

    private $id;
    private $documento;
    private $id_adjunto;
    private $ruta_adjunto;
    private $id_usuario_create;
    private $id_usuario_update;
    // private $fecha_registro;
    private $fecha_inicio;
    private $fecha_termino;

    public function __construct()
    {
        $this->id = "";
        $this->documento = "";
        $this->id_adjunto = "";
        $this->ruta_adjunto = "";
        // $this->fecha_registro = "";
        $this->fecha_inicio = "";
        $this->fecha_termino = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setdocumento($documento)
    {
        $this->documento= $documento;
    }

    function getdocumento()
    {
        return $this->documento;
    }

    function setid_adjunto($id_adjunto)
    {
        $this->id_adjunto= $id_adjunto;
    }

    function getid_adjunto()
    {
        return $this->id_adjunto;
    }

    function setruta_adjunto($ruta_adjunto)
    {
        $this->ruta_adjunto= $ruta_adjunto;
    }

    function getruta_adjunto()
    {
        return $this->ruta_adjunto;
    }

    function setid_usuario_create($id_usuario_create)
    {
        $this->id_usuario_create= $id_usuario_create;
    }

    function getid_usuario_create()
    {
        return $this->id_usuario_create;
    }

    function setid_usuario_update($id_usuario_update)
    {
        $this->id_usuario_update= $id_usuario_update;
    }

    function getid_usuario_update()
    {
        return $this->id_usuario_update;
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
}
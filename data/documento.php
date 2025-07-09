<?php

class Documento
{

    private $id;
    private $documento;
    private $id_adjunto;
    private $ruta_adjunto;
    // private $fecha_registro;
    // private $fecha_inicio;
    // private $fecha_termino;

    public function __construct()
    {
        $this->id = "";
        $this->documento = "";
        $this->id_adjunto = "";
        $this->ruta_adjunto = "";
        // $this->fecha_registro = "";
        // $this->fecha_inicio = "";
        // $this->fecha_termino = "";
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
}
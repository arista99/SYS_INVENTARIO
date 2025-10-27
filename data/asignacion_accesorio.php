<?php

class AsignacionAccesorio
{

    private $id;
    private $id_asignacion;
    private $id_accesorio;
    private $observacion;
    private $ruta_adjunto;
    private $fecha_moviento;
    private $id_entrega;

    public function __construct()
    {
        $this->id = "";
        $this->id_asignacion = "";
        $this->id_accesorio = "";
        $this->observacion = "";
        $this->ruta_adjunto = "";
        $this->fecha_moviento = "";
        $this->id_entrega = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setid_asignacion($id_asignacion)
    {
        $this->id_asignacion= $id_asignacion;
    }

    function getid_asignacion()
    {
        return $this->id_asignacion;
    }

    function setid_accesorio($id_accesorio)
    {
        $this->id_accesorio= $id_accesorio;
    }

    function getid_accesorio()
    {
        return $this->id_accesorio;
    }

    function setobservacion($observacion)
    {
        $this->observacion= $observacion;
    }

    function getobservacion()
    {
        return $this->observacion;
    }

    function setruta_adjunto($ruta_adjunto)
    {
        $this->ruta_adjunto= $ruta_adjunto;
    }

    function getruta_adjunto()
    {
        return $this->ruta_adjunto;
    }

    function setfecha_moviento($fecha_moviento)
    {
        $this->fecha_moviento= $fecha_moviento;
    }

    function getfecha_moviento()
    {
        return $this->fecha_moviento;
    }
    
    function setid_entrega($id_entrega)
    {
        $this->id_entrega= $id_entrega;
    }

    function getid_entrega()
    {
        return $this->id_entrega;
    }
}
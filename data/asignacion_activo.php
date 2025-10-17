<?php

class AsignacionActivo
{

    private $id;
    private $id_usuario;
    private $id_celular;
    private $id_desk_lap;
    private $observacion;
    private $ruta_adunto;
    private $fecha_moviento;
    private $id_entrega;
    
    public function __construct()
    {
        $this->id = "";
        $this->id_usuario = "";
        $this->id_celular = "";
        $this->id_desk_lap = "";
        $this->observacion = "";
        $this->ruta_adunto = "";
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

    function setid_usuario($id_usuario)
    {
        $this->id_usuario= $id_usuario;
    }

    function getid_usuario()
    {
        return $this->id_usuario;
    }

    function setid_celular($id_celular)
    {
        $this->id_celular= $id_celular;
    }

    function getid_celular()
    {
        return $this->id_celular;
    }

    function setid_desk_lap($id_desk_lap)
    {
        $this->id_desk_lap= $id_desk_lap;
    }

    function getid_desk_lap()
    {
        return $this->id_desk_lap;
    }

    function setobservacion($observacion)
    {
        $this->observacion= $observacion;
    }

    function getobservacion()
    {
        return $this->observacion;
    }

    function setruta_adunto($ruta_adunto)
    {
        $this->ruta_adunto= $ruta_adunto;
    }

    function getruta_adunto()
    {
        return $this->ruta_adunto;
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
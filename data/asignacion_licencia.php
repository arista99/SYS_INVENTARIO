<?php

class AsignacionLicencia
{

    private $id;
    private $id_desk_lap;
    private $id_licencia;
    private $fecha_asignacion;
    
    public function __construct()
    {
        $this->id = "";
        $this->id_desk_lap = "";
        $this->id_licencia = "";
        $this->fecha_asignacion = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setid_desk_lap($id_desk_lap)
    {
        $this->id_desk_lap= $id_desk_lap;
    }

    function getid_desk_lap()
    {
        return $this->id_desk_lap;
    }

    function setid_licencia($id_licencia)
    {
        $this->id_licencia= $id_licencia;
    }

    function getid_licencia()
    {
        return $this->id_licencia;
    }

    
    function setfecha_asignacion($fecha_asignacion)
    {
        $this->fecha_asignacion= $fecha_asignacion;
    }

    function getfecha_asignacion()
    {
        return $this->fecha_asignacion;
    }
}
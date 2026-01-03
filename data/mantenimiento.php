<?php

class Mantenimiento
{

    private $id;
    private $id_desk_lap;
    private $id_tipo_mantenimiento;
    private $descripcion;
    private $observacion;
    private $fecha_inicio;
    private $fecha_fin;
    private $ruta_adjunto;
    private $id_usuario_soporte;
    private $id_proveedor;
    private $id_estado;

    public function __construct()
    {
        $this->id = "";
        $this->id_desk_lap = "";
        $this->id_tipo_mantenimiento = "";
        $this->descripcion = "";
        $this->observacion = "";
        $this->fecha_inicio = "";
        $this->fecha_fin = "";
        $this->ruta_adjunto = "";
        $this->id_usuario_soporte = "";
        $this->id_proveedor = "";
        $this->id_estado = "";
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

    function setid_tipo_mantenimiento($id_tipo_mantenimiento)
    {
        $this->id_tipo_mantenimiento= $id_tipo_mantenimiento;
    }

    function getid_tipo_mantenimiento()
    {
        return $this->id_tipo_mantenimiento;
    }

    function setdescripcion($descripcion)
    {
        $this->descripcion= $descripcion;
    }

    function getdescripcion()
    {
        return $this->descripcion;
    }
    
    function setobservacion($observacion)
    {
        $this->observacion= $observacion;
    }

    function getobservacion()
    {
        return $this->observacion;
    }
    
    function setfecha_inicio($fecha_inicio)
    {
        $this->fecha_inicio= $fecha_inicio;
    }

    function getfecha_inicio()
    {
        return $this->fecha_inicio;
    }
    
    function setfecha_fin($fecha_fin)
    {
        $this->fecha_fin= $fecha_fin;
    }

    function getfecha_fin()
    {
        return $this->fecha_fin;
    }
    
    function setruta_adjunto($ruta_adjunto)
    {
        $this->ruta_adjunto= $ruta_adjunto;
    }

    function getruta_adjunto()
    {
        return $this->ruta_adjunto;
    }
    
    function setid_usuario_soporte($id_usuario_soporte)
    {
        $this->id_usuario_soporte= $id_usuario_soporte;
    }

    function getid_usuario_soporte()
    {
        return $this->id_usuario_soporte;
    }

    function setid_proveedor($id_proveedor)
    {
        $this->id_proveedor= $id_proveedor;
    }

    function getid_proveedor()
    {
        return $this->id_proveedor;
    }

    function setid_estado($id_estado)
    {
        $this->id_estado= $id_estado;
    }

    function getid_estado()
    {
        return $this->id_estado;
    }
    
}
<?php

class Modelo
{

    private $id;
    private $modelo;

    public function __construct()
    {
        $this->id = "";
        $this->modelo = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setmodelo($modelo)
    {
        $this->modelo= $modelo;
    }

    function getmodelo()
    {
        return $this->modelo;
    }
}
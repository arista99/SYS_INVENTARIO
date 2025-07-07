<?php

class CentroCosto
{

    private $id;
    private $centro_costo;

    public function __construct()
    {
        $this->id = "";
        $this->centro_costo = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setcentro_costo($centro_costo)
    {
        $this->centro_costo= $centro_costo;
    }

    function getcentro_costo()
    {
        return $this->centro_costo;
    }
}
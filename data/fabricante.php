<?php

class fabricante
{

    private $id;
    private $fabricante;

    public function __construct()
    {
        $this->id = "";
        $this->fabricante = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setfabricante($fabricante)
    {
        $this->fabricante= $fabricante;
    }

    function getfabricante()
    {
        return $this->fabricante;
    }
}
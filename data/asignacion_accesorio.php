<?php

class AsignacionAccesorio
{

    private $id;
    private $area;

    public function __construct()
    {
        $this->id = "";
        $this->area = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setarea($area)
    {
        $this->area= $area;
    }

    function getarea()
    {
        return $this->area;
    }
}
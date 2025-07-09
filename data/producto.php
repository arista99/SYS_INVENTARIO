<?php

class Producto
{

    private $id;
    private $producto;

    public function __construct()
    {
        $this->id = "";
        $this->producto = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setproducto($producto)
    {
        $this->producto= $producto;
    }

    function getproducto()
    {
        return $this->producto;
    }
}
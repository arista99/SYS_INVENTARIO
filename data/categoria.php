<?php

class Categoria
{

    private $id;
    private $categoria;

    public function __construct()
    {
        $this->id = "";
        $this->categoria = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setcategoria($categoria)
    {
        $this->categoria= $categoria;
    }

    function getcategoria()
    {
        return $this->categoria;
    }
}
<?php

class Adjunto
{

    private $id;
    private $adjunto;

    public function __construct()
    {
        $this->id = "";
        $this->adjunto = "";
    }

    function setid($id)
    {
        $this->id= $id;
    }

    function getid()
    {
        return $this->id;
    }

    function setadjunto($adjunto)
    {
        $this->adjunto= $adjunto;
    }

    function getadjunto()
    {
        return $this->adjunto;
    }
}
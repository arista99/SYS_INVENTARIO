<?php
//MODEL

include_once('model/modelCuentas.php');

//DATA


class ControlActivosPc{
    //VARIABLE MODELO
    public $CUENTAS;


    public function __construct()
    {
        $this->CUENTAS = new ModeloCuentas();
    }
}
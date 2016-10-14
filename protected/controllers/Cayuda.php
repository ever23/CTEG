<?php

/**
 * MOSTRARA LE MANUAL DE USUARIO DEL SISTEMA 
 * @package CTEG
 * @subpackage CONTROLADORES
 */

namespace Cc\Mvc;

class Cayuda extends Controllers
{

    public function __construct(TegHtml &$h)
    {
        echo $h->BotonAtras();
    }

    public function index()
    {
        $this->LoadView('ayuda/');
    }

    public function acercade()
    {
        $this->LoadView('ayuda/acercade');
    }

    public function confini()
    {
        $this->LoadView('ayuda/configini');
    }

    public function insertteg()
    {
        $this->LoadView('ayuda/insertteg');
    }

    public function respaldo()
    {
        $this->LoadView('ayuda/respaldo');
    }

    public function CargarRespaldo()
    {
        $this->LoadView('ayuda/CargarRespaldo');
    }

}

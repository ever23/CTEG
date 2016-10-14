<?php

/**
 * CONTROLADOR INDEX PODRA SER LLAMADO MEDIANTE EL LINK index.php?page=index
 * @package CTEG
 * @subpackage CONTROLADORES
 * 
 */

namespace Cc\Mvc;

class Cindex extends Controllers
{

    /**
     * pagina principal 
     * 
     * @example view/index.php ARCHIVO VIEW CARGADO
     * @return text/html 
     */
    public static function index()
    {
        self::LoadView('index');
    }

}

<?php

/**
 * EJECUCION DE LA APLICACION ES REALIZADA CON  CcMvc la documentacion del mismo se puede ver en {@link http://ccmvc.com.ve/documentacion/DocIframe}
 * 
 * 
 * @package CTEG
 * @subpackage MAIN
 * @uses CcMvc  Framework (Modelo, Vista, Controlador)
 * @uses tegconf.php CONFIGURACION DE CcMvc
 */
/**
 * Framework CcMvc  (Modelo, Vista, Controlador)
 * 
 */
include ("CcMvc/CcMvc.php");
/**
 * DEIFINICION DE LAS CONSTANTES DE INSTALACION 
 * @uses MysqlUser.php
 * 
 */
include ("protected/MysqlUser.php");
defined('__PROTOCOLO__') or define('__PROTOCOLO__', 'http');
define('__VERSION__', '1.1');
/**
 * archivo de configuracion
 */
$config = dirname(__FILE__) . "/protected/config/tegconf.php";
/**
 * titulo de la aplicacion 
 */
$name = "C.T.E.G " . __VERSION__;
/**
 * ejecucion de la aplicacion 
 */
CcMvc::Start($config, $name)->Run();





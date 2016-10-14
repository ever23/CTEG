<?php

/**
 * descarga CcMvc en http://ccMvc.com.ve y descomprime en este directorio sobreescribiendo los achivos
 * 
 */
$CcMvcPsth = realpath(dirname(__FILE__) . '/../../CcMvc') . '/CcMvc.php';
if (file_exists($CcMvcPsth))
{
    require_once $CcMvcPsth;
} else
{
    trigger_error("El Archivo " . $CcMvcPsth . " no existe descarga CcMvc en <a href='http://ccMvc.com.ve'>http://ccMvc.com.ve</a> y descomprime el archivo en el directorio " . dirname(__FILE__) . " sobreescribiendo todos los achivos", E_USER_ERROR);
    exit;
}


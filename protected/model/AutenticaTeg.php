<?php

/**
 * CLASE AUTENTICADORA 
 * SE ENCARGA DE ADMINISTRAR LA AUTENTICACION DE USUARIOS
 * @package CTEG
 * @subpackage Session
 */

namespace Cc\Mvc;

use Cc\Mvc;

class AutenticaTeg extends AuteticateUserDB
{

    protected function InfoUserDB()
    {
        return [
            self::TablaUsers => 'users', //nombre de la tabla de usuarios en la bd
            self::CollUser => 'user',
            self::CollPassword => 'clave',
            self::CollUserType => 'perm_user'
        ];
    }

    /**
     * SE EJECUTA CUANDO LA AUTENTICAION  FALLA
     */
    protected function OnFailed()
    {

        switch ($this->TypeFailed())
        {
            case self::FailedAuth:
                $this->Destroy();
                Mvc::Redirec('login');
                break;
            case self::DenyAccessForUser:
                return false;
        }
    }

    /**
     * SE EJECUTA CUANDO LA AUTENTICAION  SEA EXITOSA
     */
    protected function OnSuccess()
    {
        
    }

}

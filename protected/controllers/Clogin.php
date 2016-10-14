<?php

/**
 * CONTROLADOR LOGIN  ADMINISTRARA EL INICIO DE SESSION 
 * @package CTEG
 * @subpackage CONTROLADORES
 * 
 * @example layaut/login.php LAYAUT UTILIZADO PARA ESTE CONTROLADOR
 */

namespace Cc\Mvc;

class Clogin extends Controllers
{

    /**
     * SE EJECUTARA PARA CADA PETICION VERIFICARA SI EL SISTEMA ESTA INSTALADO CORRECTAMENTE
     * @param TegHtml $html
     * @param Cookie $cookie
     * @param UNEFA_DB $database
     */
    public function __construct(TegHtml $html, Cookie $cookie, UNEFA_DB $database)
    {

        if ($database->connect_errno != 2002 & ($database->connect_errno == 1044 || $database->connect_errno == 1045 || $database->connect_errno == 1049 || !$database->VerificaTables()))
        {
            $f = fopen("protected/MysqlUser.php", "w");
            fwrite($f, '<?php define("install",1);');
            fclose($f);
            $this->Redirec("install");
        }
        if (isset($cookie['error']))
        {
            $html->add_error($cookie['error']);
            unset($cookie['error']);
        }
        if (isset($cookie['install']))
        {
            $html->AddJsScript('$(document).ready(function(){error("INSTALADO","EL SISTEMA SE INSTALO CON EXITO");});');
            unset($cookie['install']);
        }
        $html->addlink_css("{src}login_form.min.css");
        $html->SetLayaut('login');
    }

    /**
     * MOSTRARA EL FORMULARIO DE INICIO DE SESSION
     * @example view/login.php VIEW MOSTRDADA
     * @param SESSION $session
     * @return text/html 
     */
    public function index(SESSION $session)
    {

        $session->Destroy();
        $this->LoadView('login');
    }

    /**
     * verificara si el usuario tiene acceso si no tiene redireccionara a login()
     * @param UNEFA_DB $database
     * @param AutenticaTeg $session
     * @param Cookie $cookie
     * @return Location:{href} SI LA VERIFICACION FUE EXITOSA REDIRECCIONARA HACIA {@link Cindex::index()} DE LO CONTRARIO REGREASAR A {@link index}
     */
    public function verificar(UNEFA_DB $database, AutenticaTeg $session, Cookie $cookie)
    {
        $path = realpath(dirname(__FILE__) . '/../tmp');

        $dir = dir($path);
        while ($file = $dir->read())
        {
            if ($file != '.' && $file != '..')
            {
                unlink($path . DIRECTORY_SEPARATOR . $file);
            }
        }
        if (!empty($_POST['user']) && !empty($_POST['password']))
        {
            if ($session->Login($_POST['user'], $_POST['password']))
            {
                $this->Redirec('index');
            } else
            {
                $cookie['error'] = "EL SISTEMA NO LE A AUTORIZADO EL ACCESO ";
                $this->Redirec('login');
            }
        } else
        {
            $cookie['error'] = "PORFAVOR LLENE EL FORMULARIO";
            $this->Redirec('login');
        }
    }

    public function ExportDB(\Cc\iDataBase &$db)
    {

        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=DbTeg.teg");
        header("Content-Transfer-Encoding: binary");
        echo $db->ExportDBGzip(__MYSQL_HOME_);
    }

}

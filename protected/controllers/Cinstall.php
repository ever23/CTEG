<?php

/**
 * CONTROLADOR INSTALL SI EL SISTEMA NO ESTA INSTALADO CORRECTAMENTE ESTE CONTROLADOR LO HARA 
 * @package CTEG
 * @subpackage CONTROLADORES
 *  @example layaut/login.php LAYAUT UTILIZADO PARA ESTE CONTROLADOR
 * 
 */

namespace Cc\Mvc;

use Cc\SqlFormat;
use Cc\Mvc;

class Cinstall extends Controllers
{

    /**
     * VERIFICARA SI EL SISTEMA ESTA INSTALADO CORRECTAMENTE 
     * @param ResponseConten $response
     * 
     */
    public function __construct(ResponseConten $response)
    {
        if (!defined('install'))
        {
            if ($response instanceof Json)
            {
                $response['redirec'] = '?page=login';
            } else
            {
                $this->Redirec('login');
            }
        }
    }

    /**
     * MOSTRARA EL FORMULARIO DE INSTALACION
     * @uses install.php
     * @param TegHtml $Html
     * @return text/html 
     */
    public function index(TegHtml $Html)
    {
        if (!empty($_SERVER['MYSQL_HOME']))
        {
            $dirmysql = $_SERVER['SystemRoot'] . "\\.." . $_SERVER['MYSQL_HOME'] . "\\";
        } else
        {
            $dirmysql = $_SERVER['DOCUMENT_ROOT'] . "/../bin/";
        }
        $Html->addlink_js("{src}jquery.FmtIdentificacion.min.js");
        $Html->addlink_js("{src}user.min.js");
        $Html->SetLayaut('login');
        $this->LoadView('install', ['MYSQL_HOME' => realpath($dirmysql)]);
    }

    /**
     * INSTALARA EL SISTEMA CARGANDO LA BASE DE DATOS E INICIALIZANDOLA 
     * @param Json $json
     * @return application/json
     */
    public function install(Json $json, AutenticaTeg $session)
    {

        $database = new MySQLi($_POST['host'], $_POST['user_mysql'], $_POST['pass_mysql']);
        if (!$database->connect_error)
        {
            $sqlformat = new SqlFormat($database);

            $_POST = $sqlformat->FilterSqlI($_POST);

            $DB = 'bd_teg';
            $pass = createpass(16);
            $database->query("drop USER '" . $DB . "'@'" . $_POST['host'] . "'");
            $database->consulta("GRANT USAGE ON *.* TO '" . $DB . "'@'" . $_POST['host'] . "' IDENTIFIED BY '" . $pass . "';");

            if ($database->error())
            {
                $json['error'] = $database->error();
                return;
            }

            $database->consulta("GRANT ALL PRIVILEGES  ON `" . $DB . "`.* TO '" . $DB . "'@'" . $_POST['host'] . "' WITH GRANT OPTION;");
            if ($database->error())
            {
                $json['error'] = $database->error();
                return;
            }
            $user = $DB;

            $root = str_replace("\\", "/", dirname($_SERVER['PHP_SELF']));
            $root.=$root == '/' ? '' : '/';
            $usage = "<?php define('__MYSQL_HOME_','" . $_POST['MYSQL_HOME'] . "');  define('USER','" . $user . "'); define('PASS','" . $pass . "'); define('HOST','" . $_POST['host'] . "'); define('DB','" . $DB . "');define('__PROTOCOLO__','" . (isset($_POST['secure']) ? 'https' : 'http') . "');";

            $database->consulta("CREATE DATABASE IF NOT EXISTS " . $DB . " DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;");
            $database->close();
            $file = 'protected/install-teg.teg';
            unset($database);
            $database = new MySQLi($_POST['host'], $user, $pass, $DB);
            if ($database->ImportDBFileGzip($file) && !$database->error)
            {
                $database->commit();
                $database->close();
                unset($database);
                // AutenticaTeg::SetParam(['user' => ' ', 'pass' => ' ', 'permisos' => ' ']);
                Mvc::App()->ConetDataBase([$_POST['host'], $user, $pass, $DB]);
                // $database = new UNEFA_DB($_POST['host'], $user, $pass, $DB);
                if ($_POST['pass1'] == $_POST['pass2'])
                {
                    //    if ($database->RegistrarUsuario($_POST + ['perm_user' => 'admi']))
                    $_POST['nomb_user'] = ucwords($_POST['nomb_user']);
                    $_POST['apel_user'] = ucwords($_POST['apel_user']);
                    if ($session->CreteUser($_POST['pass2'], $_POST + ['perm_user' => 'admi']))
                    {

                        $path = realpath(dirname(__FILE__) . '/../data');

                        $dir = dir($path);
                        while ($file = $dir->read())
                        {
                            if ($file != '.' && $file != '..')
                            {
                                unlink($path . DIRECTORY_SEPARATOR . $file);
                            }
                        }
                        $dir->close();
                        $f = fopen("protected/MysqlUser.php", "w");
                        fwrite($f, $usage);
                        fclose($f);
                        $json['redirec'] = '?page=login';
                        return;
                    } else
                    {
                        $json['error'] = $database->error();
                        return;
                    }
                } else
                {
                    $json['error'] = "LAS CONTRASEÑAS NO COINCIDEN";
                    return;
                }
            } else
            {
                $json['error'] = $database->error;
                return;
            }
        } else
        {
            $json['error'] = $database->connect_error . $_POST['pass_mysql'];
            return;
        }
    }

}

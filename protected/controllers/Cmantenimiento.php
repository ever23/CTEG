<?php

/**
 * CONTROLADOR INSTALL SI EL SISTEMA NO ESTA INSTALADO CORRECTAMENTE ESTE CONTROLADOR LO HARA 
 * @package CTEG
 * @subpackage CONTROLADORES
 * 
 * 
 */

namespace Cc\Mvc;

use Cc\CcException;

class Cmantenimiento extends Controllers implements AccessUserController
{

    public static function AccessUser()
    {
        return ['user' => ['NoAccess' => ['*']],];
    }

    /**
     * MOSTRARA LA PAGINA DE RESPALDO DE BASE DE DATOS
     * @uses RespaldoDb::LoadZip() para cargar un archivo de respaldo
     * @param TegHtml $html
     * @param UNEFA_DB $db
     * @param PostFiles $resp
     * @return text/html 
     */
    public function index(TegHtml &$html, UNEFA_DB &$db, PostFiles &$resp)
    {
        if ($resp->is_Uploaded())
        {
            if ($resp->getExtension() == 'zip')
            {

                $d = new RespaldoDb($db);
                if ($a = $d->LoadZip($resp))
                {
                    $html->AddJsScript("$(document).ready(function(){error('','SE IMPORTO LA BASE DE DATOS CON EXITO')});");
                } else
                {
                    $html->AddJsScript("$(document).ready(function(){error('ERROR','$a')});");
                }
            } else
            {
                if ($db->ImportDBFileGzip($resp['tmp_name']))
                {
                    $html->AddJsScript("$(document).ready(function(){error('','SE IMPORTO LA BASE DE DATOS CON EXITO')});");
                } else
                {
                    $html->AddJsScript("$(document).ready(function(){error('ERROR','')});");
                }
            }
        }
        $this->LoadView('mantenimiento/respaldo');
    }

    /**
     * CREARA UN RESPALDO DE LA BASE DE DATOS
     * @uses RespaldoDb::CreateZip() para crear el respaldo
     * @param RespaldoDb $db
     * @return application/zip 
     */
    public function ExportDB(RespaldoDb &$db)
    {
        $filename = $db->CreateZip();
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=DbTeg.zip");
        header("Content-Transfer-Encoding: binary");
        readfile($filename);
        unlink($filename);
    }

    /**
     * MOSTRARA EL FORMULARIO DE INSERTAR CARRERA E INSERTARA
     * @uses carrera.php VIEW MOSTRADO
     * @param TegHtml $html
     * @param UNEFA_DB $DB
     * @return text/html 
     */
    public function carrera(TegHtml &$html, UNEFA_DB &$DB)
    {
        $msj = '';

        if (!empty($_POST['desc_carr']))
        {
            if ($DB->InsertarCarrera($_POST['desc_carr']))
            {
                $msj = "SE INSERTO LA CARRERA $_POST[desc_carr] CON EXITO";
            } else
            {
                $html->add_error(CcException::GetExeptionS());
            }
        }
        $carrera = $DB->Tab('carrera')->Select();
        $this->LoadView("mantenimiento/carrera", ['msj' => $msj, 'carrera' => $carrera]);
    }

    /**
     * MOSTRARA EL FORMULARIO DE INSERTAR MENCION E INSERTARA
     * @uses mencion.php VIEW MOSTRADO
     * @param TegHtml $html
     * @param UNEFA_DB $DB
     */
    public function mencion(TegHtml &$html, UNEFA_DB &$DB)
    {
        $msj = '';
        if (!empty($_POST['desc_menc']))
        {
            if ($DB->InsertarMencion($_POST['desc_menc']))
            {
                $msj = "SE INSERTO LA MENCION " . $_POST['desc_menc'] . " CON EXITO";
            } else
            {
                $html->add_error(CcException::GetExeptionS());
            }
        }
        $this->LoadView("mantenimiento/mencion", ['msj' => $msj, 'mencion' => $DB->Tab('menciones')->Select()]);
    }

    /**
     *  MOSTRARA EL FORMULARIO DE INSERTAR USUARIO E INSERTARA
     * @uses usuarios.php VIEW UTILIZADO
     * @param TegHtml $Html
     * @param UNEFA_DB $db
     * @return text/html 
     */
    public function usuarios(TegHtml &$Html, UNEFA_DB &$db, AutenticaTeg $session)
    {
        $Html->addlink_js("{src}jquery.FmtIdentificacion.min.js");
        $Html->addlink_js("{src}user.min.js");
        if (!empty($_POST['user']) && !empty($_POST['pass1']) && !empty($_POST['pass2']))
        {
            if ($_POST['pass1'] == $_POST['pass2'])
            {
                $_POST['nomb_user'] = ucwords($_POST['nomb_user']);
                $_POST['apel_user'] = ucwords($_POST['apel_user']);
                if ($session->CreteUser($_POST['pass2'], $_POST))
                {
                    $Html->AddJsScript("$(document).ready(function(e) {error('EXITO','EL USUARIO SE A REGISTRADO CON EXITO');});");
                } else
                {
                    IF ($session->ErrnoDB === 1062)
                    {
                        $Html->add_error("ERROR EL NOMBRE DE USUARIO " . $_POST['user'] . " O LA CEDULA YA EXISTE");
                    } else
                    {
                        $Html->add_error("ERROR AL CREAR UN USUARIO");
                    }
                }
            } else
            {
                $Html->add_error("LAS CONTRASEÑAS NO COINCIDEN");
            }
        }
        $users = $db->Tab('users')->Select(["users.*", "permisos(perm_user) as permisos"]);
        $this->LoadView("mantenimiento/usuarios", ['usuarios' => $users]);
    }

    /**
     * ELIMINA UNA CARRERA
     * @param Json $json
     * @param DBtabla $carrera
     * @param int $codi_carr
     * @return application/json 
     */
    public function eliminacarrera(Json &$json, DBtabla &$carrera, $codi_carr = 0)
    {
        $carrera->Delete("codi_carr='" . $codi_carr . "'");
        if ($carrera->error())
        {
            $json->error = "ES IMPOSIBLE ELIMINAR ESTA CARRERA ";
        }
    }

    /**
     * ELIMINA UNA MENCION
     * @param Json $json
     * @param DBtabla $menciones
     * @param int $codi_menc
     * @return application/json 
     */
    public function eliminamencion(Json &$json, DBtabla &$menciones, $codi_menc = 0)
    {
        $menciones->Delete("codi_menc='" . $codi_menc . "'");
        if ($menciones->error())
        {
            $json->error = " ES IMPOSIBLE ELIMINAR ESTA MENCION ";
        }
    }

    /**
     * ELIMINA UN USUARIO
     * @param Json $json
     * @param DBtabla $users
     * @param string $ci_user
     * @return application/json
     */
    public function EliminaUser(Json $json, DBtabla $users, $ci_user = '')
    {

        $users->Select("ci_user='" . $ci_user . "'");
        $coll = $users->fetch();
        if ($coll['perm_user'] == 'user')
        {
            $coll->Delete();
            if ($coll->error())
            {
                $json->error = "ES IMPOSIBLE ELIMINAR ESTE USUARIO ";
            }
        } else
        {
            $json->error = "ES IMPOSIBLE ELIMINAR ESTE USUARIO YA QUE POSEE PRIVILEGIOS DE ADMINISTRADOR";
        }
    }

}

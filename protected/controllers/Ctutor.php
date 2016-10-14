<?php

/**
 * 
 */
/**
 * CONTROLADOR TUTOR ES RESPONSABLE DE ADMINISTRAR LOS DATOS DE LOS TUTORES
 * @package CTEG
 * @subpackage CONTROLADORES
 * @uses Personas.php
 * 
 */

namespace Cc\Mvc;

use Cc\CcException;

class Ctutor extends Controllers
{

    use Personas;

    /**
     * muestra la pagina de busqueda de tutores
     * @example view/tutores/index.php ARCHIVO VIEW
     * @param TegHtml $H
     * @return text/html 
     */
    public function index(TegHtml $H)
    {
        $H->addlink_js("{src}personas.min.js");
        $this->LoadView('tutores/index');
    }

    /**
     * muestra el formulario para insertar un tutor y una vez recibido los datos lo inserta
     * @uses form-tutor.php ARCHIVO VIEW QUE MUESTRA
     * @param Html $html
     * @param UNEFA_DB $DB
     * @return text/html 
     */
    public function insertar(Html $html, UNEFA_DB $DB)
    {
        if (isset($_POST['tutor']))
        {
            if ($DB->InsertarTutor($_POST))
            {
                $this->Redirec("tutor", ['ci_tutor' => $_POST['ci_tutor']]);
            }
        }
        $html->addlink_js(["{src}teg.min.js", "{src}jquery.FmtIdentificacion.min.js", "{src}jquery.FmtTelefono.min.js"]);
        $html->AddJsScript('$(document).ready(function(){var t= new TEG(); t.fmt_form();});');
        $this->LoadView("tutores/form-tutor");
    }

    /**
     * muestra el formulario de editar un tutor
     * @example view/tutores/editar.php ARCHIVO VIEW 
     * @param TegHtml $H
     * @param DBtabla $tutores
     * @param string $ci_tutor 
     * @return text/html
     */
    public function form_editar(TegHtml $H, DBtabla $tutores, $ci_tutor)
    {
        $H->addlink_js(["{src}teg.min.js", "{src}jquery.FmtIdentificacion.min.js", "{src}jquery.FmtTelefono.min.js"]);
        $tutores->Select("ci_tutor='" . $ci_tutor . "'");

        $this->LoadView('tutores/editar', ['tutor' => $tutores->fetch()]);
    }

    /**
     * EDITA UN TUTOR
     * @param Json $json
     * @param UNEFA_DB $DB
     * @return application/json
     */
    public function editar(Json $json, UNEFA_DB $DB)
    {
        $DB->EditarTutor($_POST);
        if ($DB->error())
        {
            $json->Set('error', CcException::GetExeptios());
        } else
        {
            $json->Set('ci_tutor', $_POST['ci_tutor']);
        }
    }

    /**
     * realiza una busqueda de tutores
     * @param Json $json
     * @param DBtabla $tutores
     * @param string $text
     * @param int $ini
     * @param int $end
     * @return application/json 
     */
    public function buscar(Json $json, DBtabla $tutores, $text)
    {
        if (!empty($text))
        {
            $tutores->Busqueda($text);
        } else
        {
            $tutores->Select();
        }
        $paginado = new PaginadoModel($tutores, 20);

        $json['result'] = $paginado->jsonSerialize()['ValueModel'];
        $json['num_rows'] = $tutores->num_rows;
        $json['next'] = $paginado->GetNext();
        $json['var'] = $paginado->GetVarRequest();
        $json->tpers = 'tutor';
    }

    /**
     * muestra un resumen del tutor
     * @param DBtabla $vteg
     * @param DBtabla $tutores
     * @param string $ci_tutor
     * @return text/html 
     */
    public function resumen(DBtabla $vteg, DBtabla $tutores, $ci_tutor)
    {
        $tutores->Select("ci_tutor='" . $ci_tutor . "'");
        $vteg->Select("ci_tutor='" . $ci_tutor . "'");
        $this->LoadView('tutores/resumen', ['Cteg' => $vteg, 'tutor' => $tutores->fetch()]);
    }

    /**
     * muestra una lista de tutores
     * @param DBtabla $tutores
     * @return application/pdf 
     */
    public function PDF(DBtabla $tutores)
    {

        $tutores->Select();
        $pdf = new UnefaPdf('P', 'mm', 'Letter');
        $pdf->titulo("LISTA DE TUTORES", 90, 'arial', 'B', 14);
        $pdf->AddPage();
        $pdf->Table($this->GetTablePdf($tutores, 'tutor'));
        $pdf->Output("tutores-teg.pdf", 'I');
    }

}

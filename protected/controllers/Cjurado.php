<?php

/**
 * CONTROLADOR AUTOR ES RESPONSABLE DE ADMINISTRAR LOS DATOS DE LOS JURADOS
 * @package CTEG
 * @subpackage CONTROLADORES
 * @uses personas.php
 * 
 */

namespace Cc\Mvc;

class Cjurado extends Controllers
{

    use Personas;

    /**
     * muestra la pagina de busqueda de jurados
     * @example view/jurados/index.php ARCHIVO VIEW
     * @param TegHtml &$h
     * @return text/html 
     */
    public function index(TegHtml &$h)
    {
        $h->addlink_js("{src}personas.min.js");
        $this->LoadView('jurados/index');
    }

    /**
     * muestra el formulario para insertar un jurado y una vez recibido los datos lo inserta
     * @uses form-jurado.php ARCHIVO VIEW QUE MUESTRA
     * @param Html $html
     * @param UNEFA_DB $DB
     * @param Request $request
     * @return text/html
     */
    public function insertar(Html &$html, UNEFA_DB &$DB, Request &$request)
    {
        if (isset($request['boton']))
        {
            $HTTP_VAR = [];
            foreach ($request as $i => $v)
            {
                if (is_array($v))
                    $HTTP_VAR[$i] = $v[0];
            }
            if ($DB->InsertarJurado($HTTP_VAR))
            {
                $this->Redirec("jurado", ['ci_jurado' => $HTTP_VAR['ci_jurado']]);
            }
        }
        $html->addlink_js(["{src}teg.min.js", "{src}jquery.FmtIdentificacion.min.js", "{src}jquery.FmtTelefono.min.js"]);
        $html->AddJsScript('$(document).ready(function(){var t= new TEG(); t.fmt_form();});');
        $this->LoadView("jurados/form-jurado", ['cant' => 1]);
    }

    /**
     * muestra el formulario de editar un jurado
     * @param TegHtml $h
     * @param DBtabla $jurados
     * @param type $ci_jurado
     * @return text/html 
     */
    public function form_editar(TegHtml &$h, DBtabla &$jurados, $ci_jurado)
    {

        $h->addlink_js(["{src}teg.min.js", "{src}jquery.FmtIdentificacion.min.js", "{src}jquery.FmtTelefono.min.js"]);
        $jurados->Select("ci_jurado='" . $ci_jurado . "'");
        //$jurado=$BD->result();
        $this->LoadView('jurados/editar', ['jurado' => $jurados->fetch()]);
    }

    /**
     * EDITA UN JURADO
     * @param Json $json
     * @param UNEFA_DB $DB
     * @return application/json
     */
    public function editar(Json &$json, UNEFA_DB &$DB)
    {
        $DB->EditarJurado($_POST);
        if ($DB->error())
        {
            $json->Set('error', CcException::GetExeptios());
        } else
        {
            $json->Set('ci_jurado', $_POST['ci_jurado']);
        }
    }

    /**
     * realiza una busqueda de jurados 
     * @param Json $json
     * @param DBtabla $jurados
     * @param string $text
     * @param int $ini
     * @param int $end
     * @return application/json 
     */
    public function buscar(Json &$json, DBtabla &$jurados, $text)
    {
        if (!empty($text))
        {
            $jurados->Busqueda($text);
        } else
        {
            $jurados->Select();
        }

        $json->tpers = 'jurado';
        $paginado = new PaginadoModel($jurados, 20);

        $json['result'] = $paginado->jsonSerialize()['ValueModel'];
        $json['num_rows'] = $jurados->num_rows;
        $json['next'] = $paginado->GetNext();
        $json['var'] = $paginado->GetVarRequest();
    }

    /**
     * muestra un resumen del jurado
     * @example view/jurados/resumen.php ARCHIVO VIEW 
     * @param DBtabla $vteg
     * @param DBtabla $jurados
     * @param string $ci_jurado
     * @return text/html 
     * 
     */
    public function resumen(DBtabla &$vteg, DBtabla &$jurados, $ci_jurado)
    {
        $jurados->Select("ci_jurado='" . $ci_jurado . "'");
        $vteg->Select("ci_jurado='" . $ci_jurado . "'", ['vjurado'], 'codi_teg');
        $this->LoadView('jurados/resumen', ['Cteg' => $vteg, 'jurado' => $jurados->fetch()]);
    }

    /**
     * muestra una lista de jurados
     * @uses UnefaPdf
     * @param DBtabla $jurados
     * @return application/pdf 
     */
    public function PDF(DBtabla &$jurados)
    {

        $jurados->Select();
        $pdf = new UnefaPdf('P', 'mm', 'Letter');
        $pdf->titulo("LISTA DE JURADOS", 90, 'arial', 'B', 14);
        $pdf->AddPage();
        $pdf->Table($this->GetTablePdf($jurados, 'jurado'));
        $pdf->Output("jurados-teg.pdf", 'I');
    }

}

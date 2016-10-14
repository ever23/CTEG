<?php

/**
 * CONTROLADOR AUTOR ES RESPONSABLE DE ADMINISTRAR LOS DATOS DE LOS AUTORES
 * @package CTEG
 * @subpackage CONTROLADORES
 * @uses Personas.php
 * 
 */

namespace Cc\Mvc;

class Cautor extends Controllers
{

    use Personas;

    /**
     * muestra la pagina de busqueda de autores
     * @example view/autores/index.php ARCHIVO VIEW
     * @param TegHtml $H
     * @return text/html 
     */
    public function index(Html $H)
    {

        $H->addlink_js("{src}personas.min.js");
        $this->LoadView('autores/');
    }

    /**
     * muestra el formulario para insertar un autor y una vez recibido los datos lo inserta
     * @uses form-autor.php ARCHIVO VIEW QUE MUESTRA
     * @param Html $html
     * @param UNEFA_DB $DB
     * @param Request $request
     * @return text/html 
     */
    public function insertar(Html $html, UNEFA_DB $DB, Request $request)
    {
        if (isset($request['autor']))
        {
            $HTTP_VAR = [];
            foreach ($request as $i => $v)
            {
                if (is_array($v))
                    $HTTP_VAR[$i] = $v[0];
            }
            if ($DB->InsertarAutor($HTTP_VAR))
            {
                $this->Redirec("autor", ['ci_autor' => $HTTP_VAR['ci_autor']]);
            }
        }
        $html->addlink_js(["{src}teg.min.js", "{src}jquery.FmtIdentificacion.min.js", "{src}jquery.FmtTelefono.min.js"]);
        $html->AddJsScript('$(document).ready(function(){var t= new TEG(); t.fmt_form();});');
        $this->LoadView("autores/form-autor", ['cant' => 1]);
    }

    /**
     * muestra el formulario de editar un autor
     * @example view/autores/editar.php ARCHIVO VIEW 
     * @param TegHtml $H
     * @param DBtabla $autores
     * @return text/html
     */
    public function form_editar(TegHtml $H, DBtabla $autores)
    {
        if (empty($_GET['ci_autor']))
            return;

        $H->addlink_js(["{src}teg.min.js", "{src}jquery.FmtIdentificacion.min.js", "{src}jquery.FmtTelefono.min.js"]);
        $autores->Select("ci_autor='" . $_GET['ci_autor'] . "'");
        $this->LoadView('autores/editar', ['autor' => $autores->fetch()]);
    }

    /**
     * EDITA UN AUTOR
     * @param Json $json
     * @param UNEFA_DB $DB
     * @return application/json
     */
    public function editar(Json $json, UNEFA_DB $DB)
    {
        $DB->EditarAutor($_POST);
        if ($DB->error())
        {
            $json->error = CcException::GetExeptionS();
        } else
        {
            $json->ci_autor = $_POST['ci_autor'];
        }
    }

    /**
     * realiza una busqueda de autores 
     * @param Json $json
     * @param DBtabla $autores
     * @param string $text
     * @param int $ini
     * @param int $end
     * @return application/json 
     */
    public function buscar(Json $json, DBtabla $autores, $text)
    {
        if (!empty($text))
        {
            $autores->Busqueda($text);
        } else
        {
            $autores->Select();
        }
        $paginado = new PaginadoModel($autores, 20);

        $json['result'] = $paginado->jsonSerialize()['ValueModel'];
        $json['num_rows'] = $autores->num_rows;
        $json['next'] = $paginado->GetNext();
        $json['var'] = $paginado->GetVarRequest();
        $json->tpers = 'autor';
    }

    /**
     * muestra un resumen del autor
     * @example view/autores/resumen.php ARCHIVO VIEW 
     * @param DBtabla $vteg
     * @param DBtabla $autores
     * @param string $ci_autor
     */
    public function resumen(DBtabla $vteg, DBtabla $autores, $ci_autor = '')
    {
        $autores->Select("ci_autor='" . $ci_autor . "'");
        $vteg->Select("ci_autor='" . $ci_autor . "'", ['vautor'], 'codi_teg');
        $this->LoadView('autores/resumen', ['Cteg' => $vteg, 'autor' => $autores->fetch()]);
    }

    /**
     * MUESTRA UNA LISTA DE AUTORES
     * @uses UnefaPdf
     * @param DBtabla $autores
     * @return application/pdf 
     */
    public function PDF(DBtabla $autores)
    {
        $autores->Select();
        $pdf = new UnefaPdf('P', 'mm', 'Letter');
        $pdf->titulo("LISTA DE AUTORES", 90, 'arial', 'B', 14);
        $pdf->add_pagina();
        $pdf->Table($this->GetTablePdf($autores, 'autor'));
        $pdf->Output("autores-teg.pdf", 'I');
    }

}

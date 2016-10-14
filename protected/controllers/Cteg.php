<?php

/**
 * CONTROLADOR TEG  ESTE CONTROLADOR SE ENCARGARA DE LOS TRABAJOS ESPECIALES DE GRADOS 
 * @package CTEG
 * @subpackage CONTROLADORES
 * 
 * @uses Personas 
 */

namespace Cc\Mvc;

use TablePdfIterator;
use Cc\CcException;
use Cc\Mvc;

class Cteg extends Controllers
{

    protected $data;
    protected $tmp;

    /**
     * se ejecutara en cada llamada 
     */
    public function __construct()
    {
        $this->data = realpath('protected/data/');
        $this->tmp = realpath('protected/tmp/');
    }

    /**
     * retornara la informacion de un trabajo especial de grado 
     * no sera accesible al navegador
     * @param UNEFA_DB $DB
     * @param int $codi_teg
     * @return array
     */
    protected function TegAll(UNEFA_DB $DB, $codi_teg = 0)
    {
        $vteg = $DB->Tab('vteg');
        $where = "codi_teg='" . $codi_teg . "'";
        $vteg->Select($where, 'codi_teg');
        $Dautor = $DB->Tab("vautor")->Select($where);
        $Dtutor = $DB->Tab("vtutor")->Select($where);
        $Djurado = $DB->Tab("vjurado")->Select($where);
        return ['teg' => $vteg->fetch(), 'Dautor' => &$Dautor, 'Dtutor' => $Dtutor->fetch(), 'Djurado' => &$Djurado];
    }

    /**
     * pagina principal del controlador 
     * 
     *
     * @uses consulta MUESTRA EL MISMO CONTENIDO DEL METODO CONSULTA 
     * @return text/html 
     * 
     */
    public function index(SelectorControllers $Cteg)
    {
        $Cteg->consulta();
    }

    /**
     * MUESTRA LA PAGINA PARA CONSULTAR Y REALIZAR BUSQUEDAS DE LOS TRABAJOS ESPECIALES DE GRADO 
     * 
     * @param TegHtml $html
     * @param UNEFA_DB $DB
     * @uses consulta_teg.php ARCHIVO VIEW 
     * @return text/html 
     */
    public function consulta(TegHtml $html, UNEFA_DB $DB)
    {
        $html->addlink_js("{src}teg.min.js");
        $carrera = $DB->Tab('carrera')->Select(); //consulta("SELECT * FROM carrera");
        $menciones = $DB->Tab('menciones')->Select(); //consulta("SELECT * FROM menciones");
        $periodo = $DB->Tab('trabajo_eg')->Select(['peri_acad'], NULL, 'peri_acad');
        $this->LoadView('teg/consulta_teg', ['carrera' => &$carrera, 'menciones' => &$menciones, 'periodo' => &$periodo]);
    }

    /**
     * MUESTRA EL FORMULARIO DE INSERTAR TRABAJO ESPECIAL DE GRADO
     * @param TegHtml $html
     *  @uses insertar_teg.php ARCHIVO VIEW 
     * @return text/html 
     */
    public function insertar(TegHtml $html)
    {
        $html->addlink_js(["{src}teg.min.js", "{src}jquery.FmtIdentificacion.min.js", "{src}jquery.FmtTelefono.min.js"]);
        $this->LoadView('teg/insertar_teg');
    }

    /**
     * MUESTRA EL FORMULARIO DE EDITAR TRABAJO ESPECIAL DE GRADO 
     * @uses $_POST['codi_teg']|$_GET['codi_teg'] SE DEVE ENVIAR EL CODIGO DEL TRABAJO ESPECIAL DE GRADO 
     * @param TegHtml $html
     * @param UNEFA_DB $DB
     * @param int $codi_teg
     *  @uses editar_teg.php ARCHIVO VIEW 
     * @return text/html 
     */
    public function FormEditar(TegHtml $html, UNEFA_DB $DB, $codi_teg)
    {
        $html->addlink_js([ "{src}jquery.FmtIdentificacion.min.js"]);
        $carrera = $DB->Tab('carrera')->Select();
        $mencion = $DB->Tab('menciones')->Select();
        $this->LoadView('teg/editar_teg', $this->TegAll($DB, $codi_teg), ['carreras' => $carrera, 'menciones' => $mencion]);
    }

    /**
     * EDITA EL TRABAJO ESPECIAL DE GRADO DEVE SER LLAMADO MEDIANTE AJAX
     * RESPONDERA CON {codi_teg:'value'} SI LA EDICION FUE EXITOSA DE LO CONTRARIO {error:'msjerror'}
     * @param Json $json
     * @param UNEFA_DB $DB
     * @param Request $request
     * @param PostFiles $TegPdf
     * @return application/json
     */
    public function Editar(Json $json, UNEFA_DB $DB, Request $request, PostFiles $TegPdf)
    {
        if ($DB->EditarTeg($request))
        {
            if ($TegPdf->is_Uploaded())
                $TegPdf->Copy($this->data . '/' . $request['codi_teg'] . '.pdf');

            $json['codi_teg'] = $request['codi_teg'];
        } else
        {
            $json['error'] = CcException::GetExeptionS();
        }
    }

    /**
     * MOSTRARA TODOS LOS DATOS DE UN TRABAJO ESPECIAL DE GRADO 
     * @param UNEFA_DB $db
     * @param int $codi_teg
     * @uses resumen_teg.php ARCHIVO VIEW
     * @return text/html
     */
    public function resumen(UNEFA_DB $db, $codi_teg = 0)
    {
        $this->LoadView('teg/resumen_teg', $this->TegAll($db, $codi_teg));
    }

use Personas;

    /**
     * GENERA UN ARCHIVO PDF CON LA INFORMACION  DEL TRABAJO ESPECIAL DE GRADO QUE SE PASE EN LA VARIABLE codi_teg DE GET O POST
     * @param UNEFA_DB $db
     * @param int $codi_teg
     * @uses UnefaPdf 
     * @uses Personas.php 
     * @return application/pdf
     */
    public function PDF(UNEFA_DB $db, $codi_teg = 0)
    {
        $TegAll = $this->TegAll($db, $codi_teg);
        $teg = &$TegAll['teg'];
        $titulo = new TablePdfIterator(5, [90, 90, 90], 'arial', 12);
        $titulo->AddCollHead('t', 'TITULO', 190, 'C');
        $titulo->AddRowArray(['t' => $teg['titulo_teg']], 5, 'arial', 12);


        $row2 = new TablePdfIterator(5, [90, 90, 90], 'arial', 12);
        $row2->AddCollHead('c', 'CARRERA', 63, 'C');
        $row2->AddCollHead('p', 'PERIODO ACADEMICO', 63, 'C');
        $row2->AddCollHead('m', 'MENCION', 64, 'C');
        $Vrow2 = ['c' => $teg['desc_carr'], 'p' => $teg['peri_acad'], 'm' => $teg['desc_menc']];
        $row2->AddRowArray($Vrow2, 5, 'arial', 12);

        $obs = new TablePdfIterator(5, [90, 90, 90], 'arial', 12);
        $obs->AddCollHead('t', 'OBSERVACIONES', 190, 'C');
        $obs->AddRowArray(['t' => $teg['obse_teg']], 5, 'arial', 12);

        $pdf = new UnefaPdf('P', 'mm', 'Letter');
        $pdf->titulo("TRABAJO ESPECIAL DE GRADO", 90, 'arial', 'B', 14);
        $pdf->AddPage();
        $pdf->Table($titulo);
        $pdf->Table($row2);
        $pdf->Table($obs);
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Ln();
        $pdf->MultiCell(190, 5, "DATOS " . ($TegAll['Dautor']->num_rows > 1 ? "DE LOS AUTORES " : "DEL AUTOR"), 0, 'C');

        $pdf->Table($this->GetTablePdf($TegAll['Dautor'], 'autor'));
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Ln();
        $pdf->MultiCell(190, 5, "DATOS DEL TUTOR", 0, 'C');

        $pdf->Table($this->GetTablePdf([$TegAll['Dtutor']], 'tutor'));

        $pdf->SetFont('arial', 'B', 12);
        $pdf->Ln();
        $pdf->MultiCell(190, 5, "DATOS " . ($TegAll['Djurado']->num_rows > 1 ? "DE LOS JURADOS " : "DEL JURADO"), 0, 'C');

        $pdf->Table($this->GetTablePdf($TegAll['Djurado'], 'jurado'));
        $pdf->Output($teg['titulo_teg'] . '.pdf', 'I');
    }

    /**
     * respondera a varias peticiones segun el contenido de la variable GET o Post 'request' 
     * @param TegHtml $H
     * @param DBtabla $menciones
     * @param DBtabla $carrera
     * @param string $request
     * @param int $cant
     * @uses form-autor.php request=form-autor
     * @uses form-jurado.php request=form-jurado
     * @uses form-tutor.php request=form-jurado
     * @uses CargarPdf.php request=CargarPdf
     * @uses form-teg.php request=form-teg
     * @uses verificar-teg.php request=verificar-teg
     * @return text/html
     */
    public function XMLHttpRequest(TegHtml $H, DBtabla $menciones, DBtabla $carrera, $request, $cant)
    {
        $H->SetLayaut(null);

        switch ($request)
        {
            case 'form-autor':
                $this->LoadView('autores/form-autor', ['cant' => $cant]);
                break;
            case 'form-jurado':
                $this->LoadView('jurados/form-jurado', ['cant' => $cant]);
                break;
            case 'form-tutor':
                $this->LoadView('tutores/form-tutor');
                break;
            case 'CargarPdf':
                $this->LoadView('teg/CargarPdf');
                break;
            case 'form-teg':
                $menciones->Select();
                $carrera->Select();

                $this->LoadView('teg/form-teg', ['carrera' => $carrera, 'menciones' => $menciones, 'titulo' => $_POST['titulo']]);
                break;
            case 'verificar-teg':
                $carrera->Select("codi_carr='" . $_POST['codi_carr'] . "'");
                $menciones->Select("codi_menc='" . $_POST['codi_menc'] . "'");
                $this->LoadView('teg/verificar-teg', ['carrera' => $carrera->fetch(), 'mecion' => $menciones->fetch()]);
                break;
        }
    }

    /**
     * RECIBIRA TODOS LOS DATOS DE UN TRABAJO ESPECIAL DE GRADO Y LO INSERTARA EN LA BASE DE DATOS 
     * @depends isertar()
     * @param Json $json
     * @param UNEFA_DB $DB
     * @return application/json
     */
    public function Guardar(Json $json, UNEFA_DB $DB)
    {

        if ($codi_teg = $DB->InsertarTeg($_POST))
        {
            $json->codi_teg = $codi_teg;
            if (!empty($_POST['pdf_name']) && preg_match("/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/", $_POST['pdf_name']))
            {
                copy($this->tmp . '/' . $_POST['pdf_name'] . '.tmp', $this->data . '/' . $codi_teg . '.pdf');
                unlink($this->tmp . '/' . $_POST['pdf_name'] . '.tmp');
            }
        } else
        {
            $json->error = CcException::GetExeptionS();
        }
    }

    /**
     * MUESTRA EL ARCHIVO PDF DEL TRABAJO ESPECIAL DE GRADO 
     * @param SelectorControllers $This
     * @param DBtabla $trabajo_eg
     * @param int $codi_teg
     * @return application/pdf
     */
    public function ViewTegPdf(SelectorControllers $This, DBtabla $trabajo_eg, $codi_teg = 0)
    {
        if (file_exists($this->data . '/' . $codi_teg . '.pdf'))
        {
            $trabajo_eg->Select("codi_teg='" . $codi_teg . "'");

            $teg = $trabajo_eg->fetch();
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $teg['titulo_teg'] . '.pdf"');
            echo file_get_contents($this->data . '/' . $codi_teg . '.pdf');
        } else
        {
            $This->PDF();
        }
    }

    /**
     * CARGA UN ARCHIVO Y LO ALMACENA TEMPORALMENTE 
     * @param PostFiles $TegPdf
     * @param Json $json
     * @return application/json 
     */
    public function CargarPdf(PostFiles $TegPdf, Json $json, \Cc\Config $config)
    {
        $name = 'a' . createpass(6);
        if ($TegPdf->is_Uploaded())
        {

            switch ($TegPdf->getExtension())
            {
                case 'pdf':
                    $TegPdf->Copy($this->tmp . '/' . $name . ".tmp");
                    break;
                case 'doc':
                case 'docx':
                    // $json['error'] = "PORFAVOR CARGE UN ARCHIVO .PDF VALIDO ";
                    $word = \PhpOffice\PhpWord\IOFactory::load($TegPdf);
                    \PhpOffice\PhpWord\Settings::setPdfRenderer(\PhpOffice\PhpWord\Settings::PDF_RENDERER_DOMPDF, $config['App']['extern'] . 'dompdf-master/autoload.inc.php');

                    IF (!$word->save($this->tmp . '/' . $name . ".tmp", 'PDF'))
                    {
                        $json['error'] = "ERROR PHPOffice ";
                    } else
                    {
                        
                    }
                    break;
                default:
                    $json['error'] = "PORFAVOR CARGE UN ARCHIVO .PDF VALIDO ";
            }


            $json['pdf_name'] = $name;
        } else
        {
            $json['error'] = "no se cargo el archivo ";
        }
    }

    /**
     * MUESTRA UN ARCHIVO PDF TEMPORAL 
     * @param string $pdf_name
     * @return application/pdf
     */
    public function PreviewPdf($pdf_name = '')
    {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $pdf_name . '"');

        echo file_get_contents($this->tmp . '/' . ValidFilename::ValidName($pdf_name) . '.tmp');
    }

    /**
     * VERIFICA SI UN TITULO  DE TRABAJO ESPECIAL DE GRADO SE ENCUENTRA COMPLETO O EN PARTE EN LA BASE DE DATOS 
     * @param Json $json
     * @param DBtabla $vteg
     * @param string $titulo_teg
     * @return application/json
     */
    public function verificate(Json $json, DBtabla $vteg, $titulo_teg)
    {
        $vteg->Busqueda($titulo_teg, ['titulo_teg']);
        $json->Copy($vteg->ResultJson());
    }

    /**
     * busca un autor, jurado, tutor segun $_POST['tform']
     * @param Json $json
     * @param UNEFA_DB $DB
     * @return application/json
     */
    public function BuscarTform(Json $json, UNEFA_DB $DB)
    {
        switch ($_POST['tform'])
        {
            case 'autor':
                $table = 'autores';
                break;
            case 'tutor':
                $table = 'tutores';
                break;
            case 'jurado':
                $table = 'jurados';
                break;
        }
        $tab = $DB->Tab($table);
        $tab->Select("ci_" . $_POST['tform'] . "='" . $_POST['ci_b'] . "'");
        if (!$tab->error())
        {
            $json->Copy($tab->ResultJson());
        } else
        {
            $json->Set('error', CcException::GetExeptionS());
        }
    }

    /**
     * CONSULTA Y REALIZA UNA BUSQUEDA DE LOS TRABAJOS ESPECIALES DE GRADO 
     * @param Json $json
     * @param DBtabla $vtegall
     * @param int $ini
     * @param int $end
     * @return application/json
     */
    public function ConsultaTeg(Json $json, DBtabla $vtegall)
    {
        $coll = [
            'codi_teg',
            'titulo_teg',
            'desc_carr',
            'desc_menc',
            'peri_acad',
            'nom1_tutor',
            'ape1_tutor',
        ];
        if (!empty($_POST['codi_teg']))
        {
            $vtegall->Select($coll, "codi_teg='" . $_POST['codi_teg'] . "'", "codi_teg");
        } elseif (empty($_POST['text']))
        {
            $vtegall->Select($coll, NULL, 'codi_teg');
        } elseif (!empty($_POST['option']))
        {

            switch ($_POST['option'])
            {
                case 'carrera':
                    $vtegall->Busqueda($_POST['text'], NULL, $coll, "codi_carr='" . $_POST['codi_carr'] . "'", "codi_teg");
                    break;
                case 'mencion':
                    $vtegall->Busqueda($_POST['text'], NULL, $coll, "codi_menc='" . $_POST['codi_menc'] . "'", "codi_teg");
                    break;

                case 'peri_acad':
                    $vtegall->Busqueda($_POST['text'], NULL, $coll, "peri_acad='" . $_POST['peri_acad'] . "'", "codi_teg");
                    break;
                case 'tutor':
                case 'autor':
                case 'jurado':
                    $campos = array(
                        'ci_' . $_POST['option'],
                        'nom1_' . $_POST['option'],
                        'nom2_' . $_POST['option'],
                        'ape1_' . $_POST['option'],
                        'ape2_' . $_POST['option']
                    );
                    $vtegall->Busqueda($_POST['text'], $campos, $coll, NULL, "codi_teg");
                    break;
            }
        } else
        {
            $vtegall->Busqueda($_POST['text'], NULL, $coll, NULL, "codi_teg");
            //$DB->busquedas_sql($sql,$_POST['text'],$all,"GROUP BY codi_teg",30);
        }

        $paginado = new PaginadoModel($vtegall, 20);

        $json['result'] = $paginado->jsonSerialize()['ValueModel'];
        $json['num_rows'] = $vtegall->num_rows;
        $json['next'] = $paginado->GetNext();
        $json['var'] = $paginado->GetVarRequest();

        /// var_dump(\Cc\Mvc::App()->Response);
    }

}

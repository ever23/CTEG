<?php
/**
 * CLASE EXTENDIDA DE FPDF 
 * @package CTEG
 * @subpackage MODEL
 */
namespace Cc\Mvc;
class UnefaPdf extends \ExtendsFpdf 
{
    /**
     * REDEFINIDO PARA AGREGAR EL LOGO DE LA UNIVERSIDAD EN LA CABECERA DE CADA PAGINA PDF
     */
	public function Header()
	{
		parent::Header();
		$this->Image(dirname(__FILE__)."/../../img/logo_unefa.png",15,4,17,17);
		$this->SetCompression(true);
	}
  

}

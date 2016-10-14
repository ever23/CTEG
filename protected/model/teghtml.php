<?php
/**
 * CLASE MANEJADORA DE RESPUESTA EXTENDIDA DE HTML FUNCIONALIDAD INTERNA DE CcMvc 
 * @package CTEG
 * @subpackage Response
 */
namespace  Cc\Mvc;
class TegHtml extends Html
{
    /**
     * 
     * @param bool $compress
     * @param bool $min
     */
	public function __construct($compress=true,$min=true)
	{
		parent::__construct($compress,$min);
		$this->set_ico('{root}favicon.ico');
		$this->SetSrc("{src_orig}",'{root}src_orig/');
		$this->SetSrc("{gzip}",'{root}src/gzip.php?f=');
		$this->script_error="$(document).ready(function(){ $( '#errores:ui-dialog' ).dialog('destroy' );
	$( '#errores' ).dialog( 'close' );
	$( '#errores' ).dialog({
		height: 350,
		width:300,
		modal: true,
		buttons: {
			'Cerrar': function() 
			{
				$( '#errores' ).dialog( 'close' );
			}
		}
	});});";
        
      // $this->EneableExtacJsCssFile(true,'{src}js/myjs.js','{src}css/mycss.css');
        
   
	}
	public function __destruct()
	{
		if(!empty($_SESSION[ 'error']))
		{
			$this->add_error($_SESSION[ 'error']);
			unset($_SESSION[ 'error']);
		}
		parent::__destruct();
	}
    /**
     * retorna una etiqueta <a> con el boton atras  
     * @param string $dir
     * @return string
     */
	public function BotonAtras($dir=NULL)
	{
		if(is_null($dir))
		{
			if(!empty($_SERVER['HTTP_REFERER']))
			{
				return '<a href="'.$_SERVER['HTTP_REFERER'].'"><div class="atras"></div></a>';
			}	
		}else
		{
			return '<a href="'.$dir.'" ><div class="atras"></div></a>';
		}
	}
}

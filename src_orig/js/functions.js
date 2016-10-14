
var popUpWin=0;
function popUpWindow(URLStr,w,h)
{
	if(popUpWin)
	{
		if(!popUpWin.closed) popUpWin.close();
	}
	popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=yes,width='+w+',height='+h+'');
}
function stop_load()
{
	$('.cargando').fadeOut();
}

function star_load()
{
	$('.cargando').css('top',200);
	$('.cargando').fadeIn();
}

function error(header,msj,funct)
{
	if(typeof funct!='function')
	{
		funct=function(){};
	}
	
	var w=300;
	var h=300;
	$( '#errores:ui-dialog' ).dialog('destroy' );
	$( '#errores' ).dialog( 'close' );
	$( '#errores' ).attr('title','<H2>'+header+'</H2>');
	
	$( '#error_div' ).html(msj);
	$( '#errores' ).dialog({
		height: w,
		width:h,
		modal: true,
		buttons: {
			'Cerrar': function() 
			{
				$( '#errores' ).dialog( 'close' );
				funct();
			}
		}
	});
}
/*
*	FUNCIONA IGUAL QUE LA VERSION DE PHP
*
*/
function str_replace(char,rem,str)
{
	if(str.indexOf(char)!=-1)
	{
		return str_replace(char,rem,str.replace(char,rem))
	}else
	{
		return str;
	}
}
function createpass($n)
{
	var pass='';
	var $t;
	var $l;
	for(var $i=0;$i<$n;$i++)
	{
		$t=Math.trunc(Math.random()/0.1)%3;
		if($t==0)
		{
			$l=(Math.trunc(Math.random()/0.1)%9)+48;
		}
		else
		{ 
			if(Math.trunc(Math.random()/0.1)%2==0)
				$l=(Math.trunc(Math.random()/0.1)%26)+97;
			else 
				$l=(Math.trunc(Math.random()/0.1)%26)+65;
		}
		pass+=String.fromCharCode($l);
	}
	return pass;
}



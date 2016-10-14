<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>
<script>
$(document).ready(function(e) {
	
	<?php
	if($msj!='')
	echo 'error("EXITO"," '.$msj.'");';
	
	?>
	$('.elimina_carr').click(function(e) {
        e.preventDefault();
		var codi_carr=$(this).attr('href');
		var desc_carr=$('#'+codi_carr).html();
	$( '#errores:ui-dialog' ).dialog('destroy' );
	$( '#errores' ).dialog( 'close' );
	$( '#errores' ).attr('title','<H2> </H2>');
	$( '#error_div' ).html("ESTA SEGURO DE ELIMINAR LA CARRERA "+desc_carr);
	$( '#errores' ).dialog({
		height: 300,
		width:300,
		modal: true,
		buttons: {
			'Aceptar': function() 
			{
				$().load_json('?page=mantenimiento::eliminacarrera',{"elimiar":true,"codi_carr":codi_carr},function(J){
					if(J.error)
					{
						$( '#errores:ui-dialog' ).dialog('destroy' );
						$( '#errores' ).dialog( 'close' );
						error('error',J.error)	;
					}else
					{
						$('#'+codi_carr).parent().fadeOut(function(){
							$(this).remove();
							$('.col_hov').removeClass('row_act').each(
							function(index, element) {
								if(index%2)
								{
								$(element).addClass('row_act');
								}
							});
						
						});
						
						
						$( '#errores' ).dialog( 'close' );
						
					}
					
					 });
			},
			'Cancelar': function() 
			{
				$( '#errores' ).dialog( 'close' );
				
			}
		}
	});
		
    });
});

</script>

<div align="center">
  <h1 align="center">INSERTAR CARRERA</h1>
  <div class="form">
    <form action=""   class="contact_form" method="post" >
      <ul>
        <li class="form_row">
          <label>CARRERA</label>
          <input type="text" name="desc_carr">
        </li>
        <li class="form_row">
          <button class="submit" type="submit" name="carrera" value="carrera">GUARDAR</button>
        </li>
      </ul>
    </form>
  </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div align="center">
  <table width="400">
    <thead>
      <TR>
        <TD>CARRERA</TD>
        <TD>&nbsp;</TD>
      </TR>
    </thead>
    <tbody>
      <?PHP
if($carrera)
foreach($carrera as $i=>$campo)
{
	echo "<TR class='col_hov ".($i%2?'row_act':'')."'><TD id='".$campo['codi_carr']."'>".$campo['desc_carr']."</TD><TD><a class='elimina_carr' href='".$campo['codi_carr']."'><div  class='elimina'></div></a></TD></TR>";
}
?>
    </tbody>
  </table>
</div>

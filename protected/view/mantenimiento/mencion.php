<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><script>
$(document).ready(function(e) {
	<?php
	if($msj!='')
	echo 'error("EXITO"," '.$msj.'");';
	
	?>
	$('.elimina_carr').click(function(e) {
        e.preventDefault();
		var codi_menc=$(this).attr('href');
		var desc_menc=$('#'+codi_menc).html();
	$( '#errores:ui-dialog' ).dialog('destroy');
	$( '#errores' ).dialog( 'close' );
	$( '#errores' ).attr('title','<H2> </H2>');
	$( '#error_div' ).html("ESTA SEGURO DE ELIMINAR LA CARRERA "+desc_menc);
	$( '#errores' ).dialog({
		height: 300,
		width:300,
		modal: true,
		buttons: {
			'Aceptar': function() 
			{
				$().load_json('?page=mantenimiento::eliminamencion',{"elimiar":true,"codi_menc":codi_menc},function(J){
					if(J.error)
					{
						$( '#errores:ui-dialog' ).dialog('destroy' );
						$( '#errores' ).dialog( 'close' );
						error('error',J.error)	;
					}else
					{
						$('#'+codi_menc).parent().fadeOut(function(){
							$(this).remove();
							$('.col_hov').removeClass('row_act').each(
							function(index, element) {
								
								if(index%2)
								$(element).addClass('row_act');
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
  <h1 align="center">INSERTAR MENCION</h1>
  <div class="form">
    <form action=""   class="contact_form" method="post" >
      <ul>
        <li class="form_row">
          <label>MENCION</label>
          <input type="text" name="desc_menc">
        </li>
        <li class="form_row">
          <button class="submit" type="submit" name="mencion" value="mencion">GUARDAR</button>
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
<thead><TR><TD>MENCION</TD><TD>&nbsp;</TD></TR></thead>
<tbody>
<?PHP
if($mencion)

foreach($mencion as $i=>$campo)
{
	echo "<TR class='col_hov ".($i%2?'row_act':'')."'><TD id='".$campo['codi_menc']."'>".$campo['desc_menc']."</TD><TD><a class='elimina_carr' href='".$campo['codi_menc']."'><div  class='elimina'></div></a></TD></TR>";
}
?>

</tbody>
</table>
</div>

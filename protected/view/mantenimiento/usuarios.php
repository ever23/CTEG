<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>﻿<script>
$(document).ready(function(e) {
   
	$('.elimina_user').click(function(e) {
        e.preventDefault();
		var obj=$(this);
		var ci_user=obj.attr('href');
		
	
	$( '#errores:ui-dialog' ).dialog('destroy');
	$( '#errores' ).dialog( 'close' );
	$( '#errores' ).attr('title','<H2> </H2>');
	$( '#error_div' ).html("ESTA SEGURO DE ELIMINAR EL USUARIO <BR><table width='200'><tr>"+obj.parent().parent().html()+"</tr></table>");
	$( '#errores' ).dialog({
		height: 300,
		width:300,
		modal: true,
		buttons: {
			'Aceptar': function() 
			{
				$().load_json('?page=mantenimiento::EliminaUser',{"elimiar":true,"ci_user":ci_user},function(J){
					if(J.error)
					{
						$( '#errores:ui-dialog' ).dialog('destroy' );
						$( '#errores' ).dialog( 'close' );
						error('error',J.error);
					}else
					{
						obj.parent().parent().fadeOut();
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
  <h1 align="center">REGISTRAR USUARIO</h1>
  <div class="form">
    <form action=""   class="contact_form" method="post" >
      <ul>
        <li class="form_row">
          <label>CI: </label>
          <input type="text" required name="ci_user">
        </li>
        <li class="form_row">
          <label>NOMBRE </label>
          <input type="text" required name="nomb_user">
        </li>
        <li class="form_row">
          <label>APELLIDO </label>
          <input type="text" required name="apel_user">
        </li>
        <li class="form_row">
          <label>NOMBRE DE USUARIO</label>
          <input type="text" required name="user">
        </li>
        <li class="form_row">
          <label>CONTRASEÑA</label>
          <input type="password"required name="pass1" maxlength="16">
        </li>
        <li class="form_row">
          <label>REPITA LA CONTRASEÑA</label>
          <input type="password"required name="pass2" maxlength="16">
        </li>
          <li class="form_row">
          <label>GENERAR CONTRASEÑA</label>
         <button class="submit"  name="generatepass" >GENERAR</button>
         <div id="passg"></div>
        </li>
        <li class="form_row">
          <label>PRIVILEGIOS</label>
          <select name="perm_user">
            <option value="user">USUARIO</option>
            <option value="admi">ADMINISTRADOR</option>
          </select>
        </li>
        <li class="form_row">
          <button class="submit" type="submit" >GUARDAR</button>
        </li>
      </ul>
    </form>
  </div>
</div>
<div align="center">
<?PHP
for($i=0;$i<45;$i++)
echo "<br>";
?>

<H1>USUARIOS</H1>
  <table width="400">
    <thead>
      <TR>
       <TD>CI</TD>
        <TD>NOMBRE</TD>
        <TD>APELLIDO</TD>
        <TD>PERMISOS</TD>
        <TD>&nbsp;</TD>
      </TR>
    </thead>
    <tbody>
      <?PHP
if($usuarios)

foreach($usuarios as $i=>$campo)
{
	echo "<TR class='col_hov ".($i%2?'row_act':'')."'>
	 <TD>".$campo['ci_user']."</TD>
        <TD>".$campo['nomb_user']."</TD>
        <TD>".$campo['apel_user']."</TD>
        <TD>".$campo['permisos']."</TD>
		<TD><a class='elimina_user' href='".$campo['ci_user']."'>
		<div  class='elimina'></div></a></TD></TR>";
}
?>
    </tbody>
  </table>
</div>

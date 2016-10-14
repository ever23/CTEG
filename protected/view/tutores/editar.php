<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */

echo $ObjResponse->BotonAtras();
?>
<script>
var teg= new TEG();
$(document).ready(function(e) {
    $('input[name=telf_tutor').FmtTelefono();
	$('input[name=ci_tutor]').data('CodiTide','C.I-');
	$('button[name=boton]').click(function(e) {
		e.preventDefault();
		if(!teg.Valid_form('.contact_form','tutor'))
		{
			return 1;
		}
		var form=$('.contact_form').serialize();
		$().load_json('?page=tutor::editar',form,function(json){
			if(json.error)
			{
				error('ERROR',json.error);
				return 1;
			}
			window.location.href="?page=tutor&ci_tutor="+json.ci_tutor;
			
		});

		
    });
});

</script>
<div class="form">
  <h2 align="center">EDITAR DATOS DEL TUTOR</h2>
  <form action=""   class="contact_form" method="post" id="form_tutor" >
    <ul>
      <li class="form_row">
        <label for="nom1_tutor">CI:</label>
        <div  class="input"><?php echo $tutor['ci_tutor']?></div>
        <input type="hidden"  required name="ci_tutor"   placeholder="CI" value="<?php echo $tutor['ci_tutor']?>"   class="input ci"/>
      </li>
     
      <li class="form_row">
        <label for="nom1_tutor">PRIMER NOMBRE:</label>
        <input type="text" required name="nom1_tutor"  placeholder="nombre" value="<?php echo $tutor['nom1_tutor']?>"  />
      </li>
      <li class="form_row">
        <label for="nom2_tutor">SEGUNDO NOMBRE:</label>
        <input type="text" required name="nom2_tutor" placeholder="seg nombre" value="<?php echo $tutor['nom2_tutor']?>" />
      </li>
      <li class="form_row">
        <label for="ape1_tutor"> PRIMER APELLIDO:</label>
        <input type="text" required name="ape1_tutor"  placeholder="apellido" value="<?php echo $tutor['ape1_tutor']?>"  />
      </li>
      <li class="form_row">
        <label for="ape2_tutor"> SEGUNDO APELLIDO:</label>
        <input type="text" required name="ape2_tutor"  placeholder="seg apellido" value="<?php echo $tutor['ape2_tutor']?>" />
      </li>
      <li class="form_row">
        <label for="emai_tutor"> CORREO:</label>
        <input type="email"  name="emai_tutor" placeholder="email" value="<?php echo $tutor['emai_tutor']?>"  />
      </li>
      <li class="form_row">
        <label for="telf_tutor"> TELEFONO:</label>
        <input type="tel"  name="telf_tutor" placeholder="telefono"  value="<?php echo $tutor['telf_tutor']?>" />
      <li class="form_row">
         <button class="submit" type="reset"  value="tutor">RESET</button>
        <button class="submit" type="submit" name="boton" value="tutor">GUARDAR</button>
      </li>
    </ul>
  </form>
</div>

<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 * @uses TegHtml
 * 
 */

/* @var $ObjResponse TegHtml */
echo $ObjResponse->BotonAtras();

?>
<script>
var teg= new TEG();
$(document).ready(function(e) {

    $('input[name=telf_jurado').FmtTelefono();
	$('input[name=ci_jurado]').data('CodiTide','C.I-');
	
	$('button[name=boton]').click(function(e) {
		e.preventDefault();
		if(!teg.Valid_form('.contact_form','jurado'))
		{
			return 1;
		}
		var form=$('.contact_form').serialize();
		$().load_json('?page=jurado::editar',form,function(json){
			if(json.error)
			{
					error('ERROR',json.error);
				return 1;
			}
			window.location.href="?page=jurado&ci_jurado="+json.ci_jurado;
			
		});
    });
});

</script>

<div class="form">
  <h2 align="center">EDITAR DATOS DEL JURADO</h2>
  <form action=""   class="contact_form" method="post" id="form_jurado" >
    <ul>
      <li class="form_row">
        <label for="nom1_jurado">CI:</label>
        <div  class="input"><?php echo $_GET['ci_jurado']?></div>
        <input type="hidden"  required name="ci_jurado"   placeholder="CI" value="<?php echo $_GET['ci_jurado']?>"   class="input ci"/>
      </li>
     
      <li class="form_row">
        <label for="nom1_jurado">PRIMER NOMBRE:</label>
        <input type="text" required name="nom1_jurado"  placeholder="nombre" value="<?php echo $jurado['nom1_jurado']?>"  />
      </li>
      <li class="form_row">
        <label for="nom2_jurado">SEGUNDO NOMBRE:</label>
        <input type="text" required name="nom2_jurado" placeholder="seg nombre" value="<?php echo $jurado['nom2_jurado']?>" />
      </li>
      <li class="form_row">
        <label for="ape1_jurado"> PRIMER APELLIDO:</label>
        <input type="text" required name="ape1_jurado"  placeholder="apellido" value="<?php echo $jurado['ape1_jurado']?>"  />
      </li>
      <li class="form_row">
        <label for="ape2_jurado"> SEGUNDO APELLIDO:</label>
        <input type="text" required name="ape2_jurado"  placeholder="seg apellido" value="<?php echo $jurado['ape2_jurado']?>" />
      </li>
      <li class="form_row">
        <label for="emai_jurado"> CORREO:</label>
        <input type="email"  name="emai_jurado" placeholder="email" value="<?php echo $jurado['emai_jurado']?>"  />
      </li>
      <li class="form_row">
        <label for="telf_jurado"> TELEFONO:</label>
        <input type="tel"  name="telf_jurado" placeholder="telefono"  value="<?php echo $jurado['telf_jurado']?>" />
      <li class="form_row">
          <button class="submit" type="reset"  value="tutor">RESET</button>
        <button class="submit" type="submit" name="boton" id="jurados" value="jurado">GUARDAR</button>
      </li>
    </ul>
  </form>
</div>

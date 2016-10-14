<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>

<input id='codi' type="hidden" value="J-">
<div class="form">
  <form action=""   class="contact_form" method="post" id="form_autor" >
    <ul>
      <?php 
	  for($i=0;$i<$cant;$i++)
	  {
		  ?>
      <li class="form_row">
        <h2 align="center">INGRESAR DATOS DEL AUTOR <?php echo $cant>1?"N&deg; ".($i+1):''; ?>
        </h2>
      </li>
      <li class="form_row">
        <label for="ci_autor">CI:</label>
        <input name="ci_autor[<?php echo $i?>]" type="text" required   class="main_input ci" id="ci_autor<?php echo $i?>" placeholder="CI" />
      </li>
      <li class="form_row">
        <label for="nom1_autor">PRIMER NOMBRE:</label>
        <input type="text" required name="nom1_autor[<?php echo $i?>]" id="nom1_autor<?php echo $i?>"  placeholder="nombre" />
      </li>
      <li class="form_row">
        <label for="nom2_autor">SEGUNDO NOMBRE:</label>
        <input type="text" required name="nom2_autor[<?php echo $i?>]" id="nom2_autor<?php echo $i?>"  placeholder="seg nombre"/>
      </li>
      <li class="form_row">
        <label for="ape1_autor"> PRIMER APELLIDO:</label>
        <input type="text" required name="ape1_autor[<?php echo $i?>]" id="ape1_autor<?php echo $i?>"  placeholder="apellido"/>
      </li>
      <li class="form_row">
        <label for="ape2_autor"> SEGUNDO APELLIDO:</label>
        <input type="text" required name="ape2_autor[<?php echo $i?>]" id="ape2_autor<?php echo $i?>"  placeholder="seg apellido"/>
      </li>
      <li class="form_row">
        <label for="emai_autor"> CORREO:</label>
        <input type="email" name="emai_autor[<?php echo $i?>]" id="emai_autor<?php echo $i?>"  placeholder="email"/>
      </li>
      <li class="form_row">
        <label for="telf_autor"> TELEFONO:</label>
        <input type="tel" name="telf_autor[<?php echo $i?>]" id="telf_autor<?php echo $i?>"  placeholder="telefono"/>
      </li>
      <?php }?>
      <li class="form_row">
        <button class="submit" type="submit" name="" id="regresar" value="">ATRAS</button>
        <button class="submit" type="submit" name="autor" id="autores" value="autor">SIGUIENTE</button>
      </li>
    </ul>
  </form>
</div>

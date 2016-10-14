<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>
<div class="form">
  <form action=""   class="contact_form" method="post" id="form_jurado" >
    <ul>
      <?php

	   for($i=0;$i<  $cant;$i++)
	  {
		  $array='['.$i.']';
		  ?>
      <li class="form_row">
        <h2 align="center">INGRESAR DATOS DEL JURADO <?php echo $cant>1?"N&deg; ".($i+1):''; ?></h2>
      </li>
      <li class="form_row">
        <label for="ci_jurado">CI:</label>
        <input type="text" required name="ci_jurado<?php echo $array?>" id="ci_jurado<?php echo $i?>"   placeholder="CI"   class="main_input ci"/>
      </li>
      <li class="form_row">
        <label for="nom1_jurado">PRIMER NOMBRE:</label>
        <input type="text" required name="nom1_jurado<?php echo $array?>" id="nom1_jurado<?php echo $i?>" placeholder="nombre"  />
      </li>
      <li class="form_row">
        <label for="nom2_jurado">SEGUNDO NOMBRE:</label>
        <input type="text" required name="nom2_jurado<?php echo $array?>" id="nom2_jurado<?php echo $i?>" placeholder="seg nombre" />
      </li>
      <li class="form_row">
        <label for="ape1_jurado"> PRIMER APELLIDO:</label>
        <input type="text" required name="ape1_jurado<?php echo $array?>" id="ape1_jurado<?php echo $i?>" placeholder="apellido"  />
      </li>
      <li class="form_row">
        <label for="ape2_jurado"> SEGUNDO APELLIDO:</label>
        <input type="text" required name="ape2_jurado<?php echo $array?>" id="ape2_jurado<?php echo $i?>" placeholder="seg apellido" />
      </li>
      <li class="form_row">
        <label for="emai_jurado"> CORREO:</label>
        <input type="email"  name="emai_jurado<?php echo $array?>" id="emai_jurado<?php echo $i?>" placeholder="email"  />
      </li>
      <li class="form_row">
        <label for="telf_jurado"> TELEFONO:</label>
        <input type="tel"  name="telf_jurado<?php echo $array?>" id="telf_jurado<?php echo $i?>" placeholder="telefono"  />
      </li>
      <?php
	  }
	  ?>
      <li class="form_row">
        <button class="submit" type="submit" name="" id="regresar" value="">ATRAS</button>
        <button class="submit" type="submit" name="boton" id="jurados" value="jurado">GUARDAR</button>
      </li>
    </ul>
  </form>
</div>

<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>
<div class="form" >
  <H2 align="center"><?PHP echo $titulo?></H2>
  <form action=""   class="contact_form" id="form_teg" method="post" enctype="multipart/form-data">
    <ul>
      <li class="form_row">
        <label for="nom2_tutor">CARRERA:</label>
        <select name="codi_carr">
        <option value="">CARRERA</option>
          <?php
		 if($carrera)
		  foreach($carrera as $campo)
		  {
			  echo "<option value='".$campo['codi_carr']."'>".$campo['desc_carr']."</option>";
		  }
		  ?>
        </select>
      </li>
      <li class="form_row">
        <label for="ape1_tutor">PERIODO ACADEMICO:</label>
        <select name="peri_acad">
          <?php
		$ano =date('Y');
        for($i=$ano -12;$i<=$ano;$i++)
		{
			echo "<option value='1-".($i+1)."'>1-".($i+1)."</option>";
            echo "<option value='2-".($i+1)."'>2-".($i+1)."</option>";
		}
		?>
        </select>
      </li>
      <li class="form_row">
        <label for="ape2_tutor"> MENCION:</label>
        <select name="codi_menc">
         <option value="">MENCION</option>
          <?php
		  if($menciones)
		  foreach($menciones  as $campo)
		  {
			  echo "<option value='".$campo['codi_menc']."'>".$campo['desc_menc']."</option>";
		  }
		  ?>
        </select>
      </li>
      <li class="form_row">
        <label >OBSERVACIONES:</label>
        <textarea name="obse_teg" cols="40" rows="6"  id="mensaje" class="main_input"></textarea>
      </li>
      <li class="form_row">
      <button class="submit" type="submit" name="" id="regresar" value="">ATRAS</button>
        <button class="submit" type="submit" name="teg" id="teg" value="teg">SIGUIENTE</button>
      </li>
    </ul>
  </form>
</div>

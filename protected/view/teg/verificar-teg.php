<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>
<style>
tr > td { text-align: center; }
</style>
<H2>VERIFICA LOS DATOS!!</H2>
<table width="900">
  <tr class="col_title">
    <td colspan="3" align="center">TITULO</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><?PHP echo $_POST['titulo_teg'] ?>
   </td>
  </tr>
  <tr class="col_title">
    <td >CARRERA</td>
    <td >PERIODO ACADEMICO</td>
    <td  >MENCION</td>
  </tr>
  <tr>
    <td><?PHP 
echo $carrera['desc_carr'] ?></td>
    <td><?PHP echo  $_POST['peri_acad']?></td>
    <TD><?PHP 

echo $mecion['desc_menc']
			?></TD>
  </tr>
  <tr  class="col_title">
    <td colspan="3">OBSERVACIONES</td>
  </tr>
  <tr  >
    <td colspan="3"><?php echo $_POST['obse_teg'];  ?></td>
  </tr>
</table>
<h2>DATOS 
   <?PHP echo count($_POST['ci_autor'])>1? "DE LOS AUTORES ":"DEL AUTOR";?>
</h2>
<table width="900">
 <thead>
      <tr>
        <td>CI</td>
        <td>NOMBRES</td>
        <td>APELLIDOS</td>
        <td>EMAIL</td>
        <td>TELEFONO</td>
      </tr>
    </thead>
     <tbody>
<?php 


foreach($_POST['ci_autor'] as $i=>$ci_autor)
{
	
	echo "<tr class='".($i%2?' row_act':'')."'>
				<td>".$_POST['ci_autor'][$i]."</td>
				<td>".$_POST['nom1_autor'][$i]." ".$_POST['nom2_autor'][$i]."</td>
				<td>".$_POST['ape1_autor'][$i]." ".$_POST['ape2_autor'][$i]."</td>
				<td>".$_POST['emai_autor'][$i]."</td>
				<td>".$_POST['telf_autor'][$i]."</td>
				
			</tr>
	";
}
?></tbody>
</table>

<h2>DATOS DEL TUTOR </h2>
<table width="900">
<thead>
      <tr>
        <td>CI</td>
        <td>NOMBRES</td>
        <td>APELLIDOS</td>
        <td>EMAIL</td>
        <td>TELEFONO</td>
      </tr>
    </thead>
    <tbody>
   
    <?php
	echo "<tr>
				<td>".$_POST['ci_tutor'][0]."</td>
				<td>".$_POST['nom1_tutor'][0]." ".$_POST['nom2_tutor'][0]."</td>
				<td>".$_POST['ape1_tutor'][0]." ".$_POST['ape2_tutor'][0]."</td>
				<td>".$_POST['emai_tutor'][0]."</td>
				<td>".$_POST['telf_tutor'][0]."</td>
				
			</tr>
	";
	?> </tbody>
  
</table>
<h2>DATOS 
  <?PHP echo count($_POST['ci_jurado'])>1? "DE LOS JURADOS ":"DEL JURADO";?>
</h2>
<table width="900">
<thead>
      <tr>
        <td>CI</td>
        <td>NOMBRES</td>
        <td>APELLIDOS</td>
        <td>EMAIL</td>
        <td>TELEFONO</td>
      </tr>
    </thead>
    <tbody>
<?php
foreach($_POST['ci_jurado'] as $i=>$ci_jurado)
{
	echo "<tr class='".($i%2?' row_act':'')."'>
				<td>".$_POST['ci_jurado'][$i]."</td>
				<td>".$_POST['nom1_jurado'][$i]." ".$_POST['nom2_jurado'][$i]."</td>
				<td>".$_POST['ape1_jurado'][$i]." ".$_POST['ape2_jurado'][$i]."</td>
				<td>".$_POST['emai_jurado'][$i]."</td>
				<td>".$_POST['telf_jurado'][$i]."</td>
				
			</tr>
	";
}
?></tbody></table>
<br><br>
<br>
<br>
<br>
<div align="center">
  <button class="submit" type="submit" name="" id="regresar" value="">ATRAS</button>
  <button class="submit" type="submit" name="" id="registrar" value="">GUARDAR</button>
</div>
<?php
if(!CcException::_Empty())
{
	?>
<script>
    error('ERROR','<?PHP echo CcException::GetExeptionS()?>');
    </script>
<?PHP
}
?>

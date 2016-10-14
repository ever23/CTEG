<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><?PHP
echo $ObjResponse->BotonAtras();
?>

<div align="center">
  <h1 align="center">JURADO</h1>
  <br>
  <br>
  <table width="900">
    <thead>
      <tr>
        <td>CI</td>
        <td>NOMBRES</td>
        <td>APELLIDOS</td>
        <td>EMAIL</td>
        <td>TELEFONO</td>
        <TD>&nbsp;</TD>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $jurado['ci_jurado'] ?></td>
        <td><?php echo $jurado['nom1_jurado'].' '.$jurado['nom2_jurado'] ?></td>
        <td><?php echo $jurado['ape1_jurado'].' '.$jurado['ape2_jurado'] ?></td>
        <td><?php echo $jurado['emai_jurado'] ?></td>
        <td><?php echo $jurado['telf_jurado'] ?></td>
        <TD>&nbsp;</TD>
      </tr>
    </tbody>
  </table>
  <h1 align="center">TRABAJO<?php if($Cteg)echo  $Cteg->num_rows>1?'S':''; ?> ESPECIAL DE GRADO</h1>
  <br>
  <br>
  <table width="900">
    <thead>
      <tr>
        <td>TITULO</td>
        <TD>PERIODO ACADEMICO</TD>
        <TD>CARRERA</TD>
        <TD>&nbsp;</TD>
      </tr>
    </thead>
    <tbody>
      <?php
	$fill=true;
if($Cteg)
	foreach($Cteg as $teg)
	{
		echo "  <tr class='".($fill=!$fill?'row_act':'')."'>
  	  <td>".$teg['titulo_teg']."</td>
    	<TD>".$teg['peri_acad']."</TD>
   		 <TD>".$teg['desc_carr']."</TD>
		  <td><a href='?page=teg::resumen&codi_teg=".$teg['codi_teg']."'><div class='buscar1'></div></a></td>
   		 </tr>";	
	}
	
	?>
    </tbody>
  </table>
</div>

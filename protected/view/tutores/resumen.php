<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><?PHP
echo $ObjResponse->BotonAtras();
?>
<div align="center">
  <h1 align="center">TUTOR</h1>
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
        <td><?php echo $tutor['ci_tutor'] ?></td>
        <td><?php echo $tutor['nom1_tutor'].' '.$tutor['nom2_tutor'] ?></td>
        <td><?php echo $tutor['ape1_tutor'].' '.$tutor['ape2_tutor'] ?></td>
        <td><?php echo $tutor['emai_tutor'] ?></td>
        <td><?php echo $tutor['telf_tutor'] ?></td>
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

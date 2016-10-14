<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><?PHP
echo $ObjResponse->BotonAtras();
?>

<div align="center">
  <h1 align="center">AUTOR</h1>
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
        <td><?php echo $autor['ci_autor'] ?></td>
        <td><?php echo $autor['nom1_autor'].' '.$autor['nom2_autor'] ?></td>
        <td><?php echo $autor['ape1_autor'].' '.$autor['ape2_autor'] ?></td>
        <td><?php echo $autor['emai_autor'] ?></td>
        <td><?php echo $autor['telf_autor'] ?></td>
        <TD>&nbsp;</TD>
      </tr>
    </tbody>
  </table>
  <h1 align="center">TRABAJO<?php if($Cteg)echo  $Cteg->num_rows>1?'S':''; ?> ESPECIAL DE GRADO DEL AUTOR</h1>
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

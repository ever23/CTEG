<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>
<style>
tr > td { text-align: center; }
</style>
<script>
    
    $(document).ready(function()
    {
       $('.pdf').tics("VISUALIZAR TRABAJO ESPECIAL DE GRADO");
        $('.printb').tics("IMPRIMIR");
    });
    </script>
<a id="pdf" title="?page=teg::ViewTegPdf&codi_teg=<?php echo  $teg['codi_teg']?>">
<div class="pdf"></div>
</a>
<a id="pdf" title="?page=teg::PDF&codi_teg=<?php echo  $teg['codi_teg']?>">
<div class="printb"></div>
</a>
  
<?PHP
echo $ObjResponse->BotonAtras();
?>
    
<iframe id="iframe" width="950" height="600" src="" style="display:none;"></iframe>
<div align="center" id="conten_html">
  <h1 align="center">TRABAJO ESPECIAL DE GRADO</h1>
  <table width="900">
    <tr class="col_title">
      <td colspan="3" align="center">TITULO   <a href="?page=teg::FormEditar&codi_teg=<?php echo  $teg['codi_teg']?>"> <div class="edit"></div></a></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><?PHP echo $teg['titulo_teg'] ?></td>
    </tr>
    <tr class="col_title">
      <td >CARRERA</td>
      <td >PERIODO ACADEMICO</td>
      <td  >MENCION</td>
    </tr>
    <tr>
      <td><?PHP echo $teg['desc_carr'] ?></td>
      <td><?PHP echo  $teg['peri_acad']?></td>
      <TD><?PHP echo $teg['desc_menc']?></TD>
    </tr>
    <tr  class="col_title">
      <td colspan="3">OBSERVACIONES</td>
    </tr>
    <tr  >
      <td colspan="3"><?php echo $teg['obse_teg'];  ?></td>
    </tr>
  </table>
  <?php 

$i=1;
?>
  <h2>DATOS <?PHP echo  count($Dautor)>1? " DE LOS AUTORES":"DEL AUTOR"?> </h2>
  <table width="900">
    <thead>
      <tr>
        <td>CI</td>
        <td>NOMBRES</td>
        <td>APELLIDOS</td>
        <td>EMAIL</td>
        <td>TELEFONO</td>
        <td>&nbsp;</td>
      </tr>
    </thead>
    <tbody>
      <?php
$fill=true;

foreach($Dautor as $autor)
{
	echo "<tr  class='".($fill=!$fill?'row_act':'')."'>
				<td>".$autor['ci_autor']."</td>
				<td>".$autor['nom1_autor']." ".$autor['nom2_autor']."</td>
				<td>".$autor['ape1_autor']." ".$autor['ape2_autor']."</td>
				<td>".$autor['emai_autor']."</td>
				<td>".$autor['telf_autor']."</td>
				<td><a href='?page=autor::resumen&ci_autor=".$autor['ci_autor']."'><div class='buscar1'></div></a></td>
				
			</tr>
	";
}

?>
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
        <td>&nbsp;</td>
      </tr>
    </thead>
    <tbody>
      <?PHP
		echo "<tr>
				<td>".$Dtutor['ci_tutor']."</td>
				<td>".$Dtutor['nom1_tutor']." ".$Dtutor['nom2_tutor']."</td>
				<td>".$Dtutor['ape1_tutor']." ".$Dtutor['ape2_tutor']."</td>
				<td>".$Dtutor['emai_tutor']."</td>
				<td>".$Dtutor['telf_tutor']."</td>
				<td><a href='?page=tutor::resumen&ci_tutor=".$Dtutor['ci_tutor']."'><div class='buscar1'></div></a></td>
				
			</tr>
	";
		?>
  </table>
  <?php

$i=1;
?>
  <h2>DATOS
    <?PHP if(count($Djurado)>1)echo "DE LOS JURADOS";else echo "DEL JURADO";?>
  </h2>
  <table width="900">
    <thead>
      <tr>
        <td>CI</td>
        <td>NOMBRES</td>
        <td>APELLIDOS</td>
        <td>EMAIL</td>
        <td>TELEFONO</td>
        <td>&nbsp;</td>
      </tr>
    </thead>
    <tbody>
    <tbody>
      <?PHP
	  $fill=true;

foreach($Djurado as $jurado)
{
	echo "<tr class='".($fill=!$fill?'row_act':'')."'>
				<td>".$jurado['ci_jurado']."</td>
				<td>".$jurado['nom1_jurado']." ".$jurado['nom2_jurado']."</td>
				<td>".$jurado['ape1_jurado']." ".$jurado['ape2_jurado']."</td>
				<td>".$jurado['emai_jurado']."</td>
				<td>".$jurado['telf_jurado']."</td>
				<td><a href='?page=jurado::resumen&ci_jurado=".$jurado['ci_jurado']."'><div class='buscar1'></div></a></td>
			</tr>
	";
}
		?>
    </tbody>
  </table>
</div>

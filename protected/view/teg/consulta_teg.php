<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><script>
$(document).ready(function(e) {
	var teg= new TEG();
teg.Consultar('#tbody',{consulta_teg:true<?php echo !empty($_GET['codi_teg'])?',codi_teg:"'.$_GET['codi_teg'].'"':''; ?>});
var buscar=function(e)
{
    var text=$('input[name=buscar]').val();
	var option=$('select[name=criterio]').val();
	switch(option)
	{
		case 'carrera':
		teg.Consultar('#tbody',{"consulta_teg":true,"text":text,"option":option,"codi_carr":$('select[name=codi_carr]').val()});
		break;
		case 'mencion':
		teg.Consultar('#tbody',{"consulta_teg":true,"text":text,"option":option,"codi_menc":$('select[name=codi_menc]').val()});
		break;
        case 'peri_acad':
		teg.Consultar('#tbody',{"consulta_teg":true,"text":text,"option":option,"peri_acad":$('select[name=peri_acad]').val()});
		break;
		case 'NULL':
		teg.Consultar('#tbody',{"consulta_teg":true,"text":text});
		break;
		default:
		 teg.Consultar('#tbody',{"consulta_teg":true,"text":text,"option":option});
		break;
	}
};
$('button[name=buscar]').click(buscar);
$('input[name=buscar]').keyup(function(e) {
	if(e.which==13)
	{
		buscar(e);
	}
});

$('select[name=criterio]').change(function(e) {
    var option=$(this).val();
	switch(option)
	{
		case 'carrera':
		$('select[name=codi_menc]').fadeOut(function(){$('select[name=codi_carr]').fadeIn();});
        $('select[name=peri_acad]').fadeOut(function(){$('select[name=codi_carr]').fadeIn();});
		break;
		case 'mencion':
		$('select[name=codi_carr]').fadeOut(function(){$('select[name=codi_menc]').fadeIn();});
        $('select[name=peri_acad]').fadeOut(function(){$('select[name=codi_menc]').fadeIn();});
		break;
        case 'peri_acad':
		$('select[name=codi_carr]').fadeOut(function(){$('select[name=peri_acad]').fadeIn();});
        $('select[name=codi_menc]').fadeOut(function(){$('select[name=peri_acad]').fadeIn();});
		break;
		default:
		$('select[name=codi_carr]').fadeOut();
		$('select[name=codi_menc]').fadeOut();
         $('select[name=peri_acad]').fadeOut();
		break;
	}
});


$('input[name=in_criterio]').click(function(e) {
    
	if(e.target.checked)
	{
		$('select[name=criterio]').fadeIn();
		
	}else
	{
		$('select[name=criterio]').val('NULL');
		$('select[name=criterio]').fadeOut();
		$('select[name=codi_carr]').fadeOut();
		$('select[name=codi_menc]').fadeOut();
        $('select[name=peri_acad]').fadeOut();
	}
	
});

});
</script>
<style>
.input_text
{
	width: 300px;
	height: 25px;
	border-radius: 5px;
}
</style>
<div align="center">
  <h1 align="center">CONSULTAR TRABAJO ESPECIAL DE GRADO </h1>
  <div >
    <select name="criterio" style="display:none;">
   <option value="NULL" seleted >FILTRO</option>
      <option value="carrera">CARRERA</option>
      <option value="peri_acad">PERIODO ACADEMICO</option>
      <option value="mencion">MENCION</option>
      <option value="tutor">TUTOR</option>
      <option value="autor">AUTOR</option>
      <option value="jurado">JURADO</option>
    </select>
    <select name='codi_carr' style="display:none;">
    <option>CARRERA</option>
    <?php
	if($carrera)
	foreach($carrera as $campo)
	{
		echo "<option value='".$campo['codi_carr']."'>".$campo['desc_carr']."</option>";
		
	}
	?>
    </select>
      <select name='peri_acad' style="display:none;">
    <option>PERIODO ACADEMICO</option>
    <?php
	if($periodo)
	foreach($periodo as $campo)
	{
		echo "<option value='".$campo['peri_acad']."'>".$campo['peri_acad']."</option>";
		
	}
	?>
    </select>
    <select name="codi_menc" style="display:none;">
    <option>MENCION</option>
     <?php
	if($menciones)
	foreach($menciones as $campo)
	{
		echo "<option value='".$campo['codi_menc']."'>".$campo['desc_menc']."</option>";
		
	}?>
    </select>
    <br>
    <input type="checkbox" name="in_criterio">
    <input name="buscar" type="search"  class="input_text" >
    <button class="buscar" type="submit" style="float:inherit; border-radius:5px;" name="buscar" id="" value=""></button>
  </div>
  <br>
  <br>
  <table width="900">
    <thead>
      <tr>
        <td>TITULO</td>
        <td>CARRERA</td>
        <td>MENCION</td>
        <td>TUTOR</td>
        <td>PERIODO ACADEMICO</td>
        <TD width="50">&nbsp;</TD>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
  </table>
</div>

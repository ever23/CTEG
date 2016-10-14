<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>
<style>
	.input_text
	{
		width: 300px;
		height: 25px;
		border-radius: 5px;
	}
</style>
<script>
	$(document).ready(function(e) {
		var autor= new PERS('index.php?page=autor::buscar');
		
		autor.Consultar('#tbody');
		$('button[name=buscar]').click(function(e) {
    var text=$('input[name=buscar]').val();
	autor.Consultar('#tbody',{tpers:'autor',text:text});
	
});
$('input[name=buscar]').keyup(function(e) {
	if(e.which===13)
	{
		autor.Consultar('#tbody',{"text":e.target.value});
	}
});
	});

</script>
<a id="pdf" title="?page=autor::PDF"><div class="pdf"></div></a>
<a href="?page=tutor::insertar">
    <div class="new2"></div></a>
<iframe id="iframe" width="950" height="600" src="" style="display:none;"></iframe>

<div align="center" id="conten_html">
	<h1 align="center">CONSULTAR AUTOR</h1>
	<div >
		<input name="buscar" type="search"  class="input_text" >
		<button class="buscar" type="submit" style="float:inherit; border-radius:5px;" name="buscar" ></button>
	</div>
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
		<tbody id="tbody">
		</tbody>
	</table>
</div>

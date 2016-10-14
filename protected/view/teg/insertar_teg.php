<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>
<style>
.formularios
{
	padding: 20px;
	margin-bottom: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-left: 0px;
	margin-left: 30px;
	margin-right: 30px;
}
</style>
<script>
	var teg= new TEG();
		teg.Insertar();
</script>
<h1 align="center">INSERTAR DATOS DEL <BR>
  TRABAJO ESPECIAL DE GRADO</h1>
<div>
  <div class="pasos p1"> </div>
  <div class="formularios">
    <div align="center">
      <H2>INGRESAR EL TITULO DEL TRABAJO ESPECIAL DE GRADO </H2>
      <input type="search" style="width: 400px;height: 30px;border-radius: 5px;" name="titulo_teg" value=" <?php echo !empty($_GET['titulo'])?$_GET['titulo']:''; ?>" class="input_text">
      <br>
      <button class="submit" type="submit" name="verif_teg" id="verif_teg" value="titulo_teg">VERIFICAR</button>
    </div>
    <br>
    <br>
    <br>
    <div align="center">
      <table width="500">
        <thead>
          <tr>
            <td>TITULO</td>
          
          </tr>
        </thead>
        <tbody id="coin">
        </tbody>
      </table>
      <br>
      <button class="submit" type="submit" name="SIGIENTE" id="SIGIENTE" value="0">SIGIENTE</button>
    </div>
  </div>
</div>

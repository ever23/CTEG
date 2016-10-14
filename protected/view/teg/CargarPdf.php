<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>

<div align="center">
<div class="form">
<h1>CARGAR TRABAJO ESPECIAL DE GRADO DIGITALIZADO</h1>
<form action=""   class="contact_form" method="post" ENCTYPE="multipart/form-data" id="FormTegPdf" >
      <ul>
        <li class="form_row">
          <label>CARGAR ARCHIVO</label>
          <input type="file" name="TegPdf"   accept="text/x-teg">
        </li>
        <li class="form_row">
            <button class="submit"  name="" id="regresar" value="">ATRAS</button>
          <button class="submit"  name="cargar_pdf" >GUARDAR</button>
        </li>
      </ul>
    </form>
  </div>
    <div id="PreviewPdf">
       
    </div>
</div>
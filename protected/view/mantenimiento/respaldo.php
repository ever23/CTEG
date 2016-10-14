<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><div align="center" >
    <h1>RESPALDO DE LA BASE DE DATOS </h1>

    <form action="index.php"   class="contact_form" method="get" ENCTYPE="multipart/form-data" >
        <input type="hidden" name="page" value="mantenimiento::ExportDB">
        <button class="submit" type="submit" name="respaldo" >RESPALDAR</button>
    </form>

</div>

<div align="center">
    <div class="form">
        <h1>CARGAR ARCHIVO DE RESPALDO </h1>
        <form action=""   class="contact_form" method="post" ENCTYPE="multipart/form-data" >
            <ul>
                <li class="form_row">
                    <label>CARGAR ARCHIVO</label>

                    <input type="file" name="resp"  required accept="text/x-teg">
                </li>
                <li class="form_row">
                    <button class="submit" type="submit" name="guardar" >GUARDAR</button>
                </li>
            </ul>
        </form>
    </div>
</div>

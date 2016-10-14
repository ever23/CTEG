<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><BR>
<br>
<br>
<br>
<H1 align="center" style="font-family: airstrike; font-size: 50px;">INGRESA AL SISTEMA</H1>
<form class="form-1"  action="?page=login::verificar" METHOD="post" enctype="application/jsonenctype"   name="frmentrada" target="_self" id="frmDatos">
    <p class="field">
        <input autocomplete="off" required type="text" name="user"  placeholder="Nombre de usuario" >
        <i class="icon-user icon-large"></i> </p>
    <p class="field">
        <input 	autocomplete="off" 	type="password" name="password" maxlength="16" min="8"   placeholder="contraseña">
        <i class="icon-lock icon-large"></i> </p>
    <p class="submit">
        <button type="submit" name="submit"> <i 	class="icon-arrow-right icon-large"></i> </button>
    </p>
</form>
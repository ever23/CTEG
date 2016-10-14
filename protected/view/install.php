<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><script>
    $(document).ready(function () {

        //  $('input[name=is_user]').tics("SI NO SELECCIONA ESTA OPCION EL SISTEMA CREARA UN USUARIO POR DEFECTO POR LO TANTO EL USUARIO INGRESADO DEVERA TENER PERMISOS GRANT CREATE USER  EN MYSQL <BR>NOTA: EL USUSRAIO POR DEFECTO SOLO TENDRA PRIVILEGIOS PARA LA BASE DE DATOS DEL SISTEMA ");
        $('input[name=MYSQL_HOME]').tics("DIRECTORIO DONDE SE ENCUENTRAN LOS BINARIOS DE MYSQL ES IMPORTANTE PARA LA FUNCION DE RESPALDO DE BASE DE DATOS");
        $('form').bind('submit', function (e)
        {
            e.preventDefault();
            if (!ValidaUser(e))
            {
                return;
            }
            var OBJ = $('input[name=ci_user]');
            if (OBJ.val().length > 0 && !OBJ.ValidIdentificacion())
            {
                OBJ.IdentificacionInvalida();
                return;
            }
            $().load_json('?page=install::install', $(this).serialize(), function (json)
            {
                if (json.error)
                {
                    error('', json.error);
                } else {
                    error('EXITO!', 'LA CONFIGURACION SE REALIZO EXITOSAMENTE ESPERE MIENTRAS ES REDIRECCIONADO A LA PAGINA DE INGRESO');
                    window.location.href = json.redirec;
                }
            });
        });
    });

</script>
<div align="center">
    <a href="?page=ayuda::acercade">Acerca de C.T.E.G</a><br>
    <a href="?page=ayuda::confini">COMO CONFIGURO?</a><br>
</div>
<div align="center">

    <div class="form">
        <h1>CONFIGURAR EL SISTEMA </h1>
        <form action=""   class="contact_form" method="post"  >
            <ul>
                <li class="form_row">
                    <label>USAR UNA CONEXION SEGURA HTTPS</label>
                    <input type="checkbox" name="secure"<?php echo Cc\Mvc\Server::Protocol() == 'https://' ? 'checked' : ''; ?>    >
                </li>
                <li class="form_row">
                    <label> MYSQL </label>
                    <input type="TEXT" name="MYSQL_HOME" value="<?php echo $MYSQL_HOME ?>">
                </li>
                <li class="form_row">
                    <label>USUARIO MYSQL</label>
                    <input type="text" name="user_mysql"  required >
                </li>
                <li class="form_row">
                    <label>CLAVE MYSQL</label>
                    <input type="password" name="pass_mysql" >
                </li>
                <!-- <li class="form_row">
                     <label>UTILIZAR ESTE USUARIO PARA EL SISTEMA</label>
                     <input type="checkbox" name="is_user" >
                 </li>-->
                <li class="form_row">
                    <label>HOST</label>
                    <input type="TEXT" name="host" value="<?php echo $_SERVER['HTTP_HOST'] ?>">
                </li>
                <!-- <li class="form_row">
                     <label>UTILIZAR UN ARCHIVO DE RESPALDO</label>
                     <input type="checkbox" name="cargar_r" >
                 </li>-->
                <li class="form_row" id="file"> </li>
                <li class="form_row us">
                    <h1>USUARIO ADMINISTRADOR DEL SISTEMA</h1>
                </li>
                <li class="form_row us">
                    <label>CI: </label>
                    <input type="text" required name="ci_user">
                </li>
                <li class="form_row us">
                    <label>NOMBRE </label>
                    <input type="text" required name="nomb_user">
                </li>
                <li class="form_row us">
                    <label>APELLIDO </label>
                    <input type="text" required name="apel_user">
                </li>
                <li class="form_row us">
                    <label>NOMBRE DE USUARIO</label>
                    <input type="text" required name="user">
                </li>
                <li class="form_row us">
                    <label>CONTRASEÑA</label>
                    <input type="password" required name="pass1" maxlength="16">
                </li>
                <li class="form_row us">
                    <label>REPITA LA CONTRASEÑA</label>
                    <input type="password" required name="pass2" maxlength="16">
                </li>
                <li class="form_row us">
                    <label>GENERAR CONTRASEÑA</label>
                    <button class="submit"  name="generatepass" >GENERAR</button>
                    <div id="passg"></div>
                </li>
                <li class="form_row">
                    <button class="submit" type="submit" name="guardar" >COFIGURAR</button>
                </li>
            </ul>
        </form>
    </div>
</div>

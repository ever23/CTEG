<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><?PHP
echo $ObjResponse->BotonAtras();
?>
<script>
    var teg = new TEG();
    $(document).ready(function (e) {
        $('input[name=telf_autor').FmtTelefono();
        $('input[name=ci_autor]').data('CodiTide', 'C.I-');

        $('button[name=boton]').click(function (e) {
            e.preventDefault();
            if (!teg.Valid_form('.contact_form', 'autor'))
            {
                return 1;
            }
            var form = $('.contact_form').serialize();
            $().load_json('?page=autor::editar', form, function (json) {
                if (json.error)
                {
                    error('ERROR', json.error);
                    return 1;
                } else
                {
                    window.location.href = "?page=autor&ci_autor=" + json.ci_autor;
                }


            });


        });
    });

</script>

<div class="form">
    <h2 align="center">EDITAR DATOS DEL AUTOR</h2>
    <form action=""   class="contact_form" method="post" id="form_autor" >
        <ul>
            <li class="form_row">
                <label for="nom1_autor">CI:</label>
                <div  class="input"><?php echo $autor['ci_autor'] ?></div>
                <input type="hidden"  required name="ci_autor"   placeholder="CI" value="<?php echo $autor['ci_autor'] ?>"   class="input ci"/>
            </li>

            <li class="form_row">
                <label for="nom1_autor">PRIMER NOMBRE:</label>
                <input type="text" required name="nom1_autor"  placeholder="nombre" value="<?php echo $autor['nom1_autor'] ?>"  />
            </li>
            <li class="form_row">
                <label for="nom2_autor">SEGUNDO NOMBRE:</label>
                <input type="text" required name="nom2_autor" placeholder="seg nombre" value="<?php echo $autor['nom2_autor'] ?>" />
            </li>
            <li class="form_row">
                <label for="ape1_autor"> PRIMER APELLIDO:</label>
                <input type="text" required name="ape1_autor"  placeholder="apellido" value="<?php echo $autor['ape1_autor'] ?>"  />
            </li>
            <li class="form_row">
                <label for="ape2_autor"> SEGUNDO APELLIDO:</label>
                <input type="text" required name="ape2_autor"  placeholder="seg apellido" value="<?php echo $autor['ape2_autor'] ?>" />
            </li>
            <li class="form_row">
                <label for="emai_autor"> CORREO:</label>
                <input type="email"  name="emai_autor" placeholder="email" value="<?php echo $autor['emai_autor'] ?>"  />
            </li>
            <li class="form_row">
                <label for="telf_autor"> TELEFONO:</label>
                <input type="tel"  name="telf_autor" placeholder="telefono"  value="<?php echo $autor['telf_autor'] ?>" />
            <li class="form_row">
                <button class="submit" type="reset"  value="tutor">RESET</button>
                <button class="submit" type="submit" name="boton" id="autors" value="autor">GUARDAR</button>
            </li>
        </ul>
    </form>
</div>

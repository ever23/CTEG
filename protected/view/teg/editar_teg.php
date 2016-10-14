<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?><?php
/* @var $ObjResponse TegHtml */
echo $ObjResponse->BotonAtras();
?>
<script>
    $(document).ready(function () {
        $('input[name^="ci"]').FmtIdentificacion('C.I-');
        $('input[name^="ci"]').data('valid', true);
        $('#new_autor').click(function (e)
        {
            var id = $('input[name^="ci_autor"]:last').attr('id');
            var lastid = Number($.isNumeric(id) ? id : -1) + 1;
            var newConten = $('  <li class="form_row"  id="autor"> <label>N ' + (lastid + 1) + ' :</label><input name="ci_autor[' + lastid + ']" type="text" required   class="main_input ci" id="' + lastid + '"\n\
                    placeholder="CI" /><div class="elimina" ></div> </li>');
            newConten.children('input').FmtIdentificacion('C.I-');
            if ($('input[name^="ci_autor"]').size() == 0)
            {
                $(this).closest('.form_row').after(newConten);
            } else
            {
                $('input[name^="ci_autor"]:last').closest('.form_row').after(newConten);
            }


        });
        $('#new_jurado').click(function (e)
        {
            var id = $('input[name^="ci_jurado"]:last').attr('id');
            var lastid = Number($.isNumeric(id) ? id : -1) + 1;
            var newConten = $('  <li class="form_row"  id="jurado"> <label>N ' + (lastid + 1) + ' :</label><input name="ci_jurado[' + lastid + ']" type="text" required   class="main_input ci" id="' + lastid + '"\n\
                    placeholder="CI" /> <div class="elimina" ></div></li>');
            newConten.children('input').FmtIdentificacion('C.I-');
            if ($('input[name^="ci_jurado"]').size() == 0)
            {
                $(this).closest('.form_row').after(newConten);
            } else
            {
                $('input[name^="ci_jurado"]:last').closest('.form_row').after(newConten);
            }
        });

        $('.elimina').live('click', function ()
        {
            $(this).closest('li').remove();
        });
        $('input[name^="ci"]').live('focusout', function (e)
        {
            var ci = $(this).val();
            var input = $(this);
            var tform = input.parent().attr('id');
            $().load_json('?page=teg::BuscarTform', {"ci_b": ci, 'tform': tform}, function (json)
            {
                if (json.error)
                {
                    error("ERROR EN EL SERVIDOR", json.error);
                    input.data('valid', false);
                    return false;
                } else
                {
                    if (json.num_rows === 0)
                    {
                        input.data('valid', false);
                        error('', 'PORFAVOR INSERTE EL NUMERO DE CEDULA DE UN ' + tform.toUpperCase() + ' YA REGISTRADO', function () {
                            input.focus();
                        });
                    } else
                    {
                        input.data('valid', true);
                    }
                }
            });

        });


        $('form').bind('submit', function (e)
        {
            e.preventDefault();
            var form = new FormData($(this)[0]);
            var error = false;
            $('input[name^="ci"]').each(function (i, v)
            {
                if (!$(v).data('valid'))
                {
                    error('ERROR', 'PORFAVOR INSERTE EL NUMERO DE CEDULA DE UN ' + $(V).parent().attr('id').toUpperCase() + ' YA REGISTRADO', function ()
                    {
                        $(v).focus();
                    });
                    error = true;
                    return;
                }
            });
            if (error)
            {
                return;
            }
            $('').load_json('?page=teg::Editar', form, function (json)
            {
                if (json.error)
                {
                    error('ERROR', json.error);

                } else
                {
                    window.location = '?page=teg&codi_teg=' + json.codi_teg;
                }
            }, {contentType: false, processData: false});
        });
    });


</script>
<h1 style="text-align: center">EDITAR TRABAJO ESPECIAL DE GRADO</h1>
<div class="form" >

    <form action=""   class="contact_form" id="form_teg" method="post" enctype="multipart/form-data">
        <input type="hidden" name="codi_teg" value="<?php echo $teg['codi_teg'] ?>">
        <ul>
            <li class="form_row">
                <label for="nom2_tutor">TITULO :</label>
                <input type="text" style="width: 400px;height: 30px;border-radius: 5px;" name="titulo_teg" value=" <?php echo $teg['titulo_teg'] ?>" class="input_text">
            </li>

            <li class="form_row">   <label for="nom2_tutor">AUTORES :</label>  <div class="new" id="new_autor"></div></li>

            <?PHP
            foreach($Dautor as $i => $campo)
            {
                echo '  <li class="form_row" id="autor"> <label>N ' . ($i + 1) . '  :</label><input name="ci_autor[' . $i . ']" type="text" required   class="main_input ci" id="' . $i . '"'
                . ' value="' . $campo['ci_autor'] . '" placeholder="CI" /> <div class="elimina" ></div></li>';
            }
            ?>
            <li class="form_row"></li>
            <li class="form_row" >   <label for="nom2_tutor">JURADOS :</label>  <div class="new" id="new_jurado"></div></li>
            <?php
            foreach($Djurado as $i => $campo)
            {
                echo '    <li class="form_row" id="jurado"><label>  N ' . ($i + 1) . ' :</label><input name="ci_jurado[' . $i . ']" type="text" required   class="main_input ci" id="' . $i . '" '
                . 'value="' . $campo['ci_jurado'] . '" placeholder="CI" /> <div class="elimina" ></div></li>';
            }
            ?>

            <li class="form_row"></li>
            <li class="form_row" id="tutor">
                <label>TUTOR :</label>
                <input name="ci_tutor" type="text" required   class="main_input ci" id="ci_tutor" value="<?php echo $Dtutor['ci_tutor'] ?>" placeholder="CI" />
            </li>
            <li class="form_row">
                <label for="nom2_tutor">CARRERA:</label>
                <select name="codi_carr">
                    <option >CARRERA</option>
                    <?php
                    if($carreras)
                        foreach($carreras as $campo)
                        {
                            $select = '';
                            if($campo['codi_carr'] == $teg['codi_carr'])
                                $select = 'selected';
                            echo "<option value='" . $campo['codi_carr'] . "' " . $select . ">" . $campo['desc_carr'] . "</option>";
                        }
                    ?>
                </select>
            </li>
            <li class="form_row">
                <label for="ape1_tutor">PERIODO ACADEMICO:</label>
                <select name="peri_acad">
                    <?php
                 
                    $ano =date('Y');
        for($i=$ano -12;$i<=$ano;$i++)
		{
			echo "<option value='1-".($i+1)."' ".( ($teg['peri_acad']==("1-".($i+1)))?'selected':'').">1-".($i+1)."</option>";
            echo "<option value='2-".($i+1)."' ".( ($teg['peri_acad']==("2-".($i+1)))?'selected':'').">2-".($i+1)."</option>";
		}
                    ?>
                </select>
            </li>
            <li class="form_row">
                <label for="ape2_tutor"> MENCION:</label>
                <select name="codi_menc">
                    <option >MENCION</option>
                    <?php
                    if($menciones)
                        foreach($menciones as $campo)
                        {
                        $select=NULL;
                            if($campo['codi_menc'] == $teg['codi_menc'])
                                $select = 'selected';
                            echo "<option value='" . $campo['codi_menc'] . "'  " . $select . ">" . $campo['desc_menc'] . "</option>";
                        }
                    ?>
                </select>
            </li>
            <li class="form_row">
                <label>CARGAR ARCHIVO</label>
                <input type="file" name="TegPdf"   >
            </li>
            <li class="form_row">
                <label >OBSERVACIONES:</label>
                <textarea name="obse_teg" cols="40" rows="6"  id="mensaje" class="main_input"><?php echo $teg['obse_teg'] ?></textarea>
            </li>

            <li class="form_row">

                <button class="submit" type="submit" name="teg" id="teg" value="teg">EDITAR</button>
            </li>
        </ul>
    </form>
</div>


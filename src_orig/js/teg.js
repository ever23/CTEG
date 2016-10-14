// JavaScript Document

function TEG(dir, teg) {

    this.titulo = '';
    this.paso = 1;
    this.ajax = {
        teg: {},
        fteg: '',
        dir: '',
        tutor: {},
        jurado: {},
        autor: {}

    };
    this.Ini('ajax/', 'ajax-teg.php');
}
TEG.prototype.Ini = function (dir, teg) {
    this.ajax.fteg = 'index.php?page=teg';
    this.ajax.dir = dir;
}

TEG.prototype.Insertar = function () {
    var obj = this;
    $(document).ready(function () {
        obj.paso1();
    });
};
TEG.prototype.Consultar = function (elem, obj_var) {
    var obj = this;
    console.log(obj_var);
    $().load_json(this.ajax.fteg + '::ConsultaTeg', obj_var, function (J) {
        var html = '';
        if (J.error) {
            error('ERROR', J.error);
            return false;
        } else {
            // var row_act = '';
            var campo;
            // for (var i = 0; campo = J.result[i]; i++)
            for (var i in J.result)
            {
                campo = J.result[i];
                html += " <tr class='col_hov " + (i % 2 ? 'row_act' : '') + "'><td> " + campo['titulo_teg'] + " </td><td> " + campo['desc_carr'] + " </td>\
<td> " + campo['desc_menc'] + " </td>\
<td> " + campo['nom1_tutor'] + " " + campo['ape1_tutor'] + "</td>\
<td> " + campo['peri_acad'] + "  </td>\
<TD><a class='popup' href='?page=teg::resumen&codi_teg=" + campo['codi_teg'] + "'><div class='buscar1'></div></a>\n\
<a class='popup' href='?page=teg::FormEditar&codi_teg=" + campo['codi_teg'] + "'><div class='edit'></div></a></TD>\
</tr>";

            }
            if (J.num_rows === 0) {
                html = " <tr class='col_hov'>\
                <td colspan='6' align='center' class='col_select'>NO SE ENCONTRARON RESULTADOS </td>\
                </tr>";
            } else if (J.next) {


                html += " <tr class='col_hov'>\
                 <td colspan='6' align='center' class=''><div ><a id='Cnum' next='" + J.next[J.var] + "' >Siguente</a></div></td>\
                </tr>";
            }
            $(elem).html(html);
            //return html;
            $('#Cnum').click(function (e) {
                e.preventDefault();
                var post = {};


                obj.Consultar(elem, $.extend(elem, {'PM1': J.next[J.var]}));

            });


        }

        /*	$('.popup').click(function(e) {
         e.preventDefault();
         popUpWindow($(this).attr('href'),window.innerWidth,window.innerHeight);
         });*/
    });
};
TEG.prototype.paso_sig = function () {
    this.paso++;
    var p = 'p' + this.paso;
    for (var i = 1; i <= 5; i++)
    {
        $('.pasos').removeClass('p' + i);
    }
    $('.pasos').addClass(p);
};
TEG.prototype.paso_ant = function () {
    this.paso--;
    var p = 'p' + this.paso;
    for (var i = 1; i <= 5; i++)
    {
        $('.pasos').removeClass('p' + i);
    }
    $('.pasos').addClass(p);
};
TEG.prototype.Valid_form = function (selected, tform, cant) {
    var form = $(selected).serializeArray();
    var num;
    var ind = '';
    var array = true;
    var ci = new Array();
    if (!cant) {
        cant = 1;
        array = false;
    }

    for (var i = 0; i < cant; i++)
    {
        num = cant > 1 ? " N&deg; " + (i + 1) : '';
        if (array) {
            ind = '[' + i + ']';
        }
        ci.push($('input[name="ci_' + tform + ind + '"]').val());
        if (!$('input[name="ci_' + tform + ind + '"]').ValidIdentificacion() || $('input[name="ci_' + tform + ind + '"]').val().length === 0) {

            error("FORMULARIO INCOMPLETO", "LA CEDULA DEL " + tform.toUpperCase() + num + "  ESTA INCOMPLETA O ES INVALIDA ",
                    function () {
                        $('input[name="ci_' + tform + ind + '"]').IdentificacionInvalida();
                    });
            this.ajax[tform] = [];

            return false;
        }
        if ($('input[name="nom1_' + tform + ind + '"]').val() === '') {

            error("FORMULARIO INCOMPLETO", "ES NESESARIO PROPORCIONAR EL PRIMER NOMBRE  DEL " + tform.toUpperCase() + num + "",
                    function () {
                        $('input[name="nom1_' + tform + ind + '"]').focus();
                    });
            this.ajax[tform] = [];
            return false;
        }
        if ($('input[name="nom2_' + tform + ind + '"]').val() === '') {
            error("FORMULARIO INCOMPLETO", "ES NESESARIO PROPORCIONAR EL SEGUNDO NOMBRE  DEL " + tform.toUpperCase() + num + "",
                    function () {
                        $('input[name="nom2_' + tform + ind + '"]').focus();
                    });
            this.ajax[tform] = [];
            return false;
        }
        if ($('input[name="ape1_' + tform + ind + '"]').val() === '') {
            error("FORMULARIO INCOMPLETO", "ES NESESARIO PROPORCIONAR EL PRIMER APELLIDO  DEL " + tform.toUpperCase() + num + "",
                    function () {
                        $('input[name="ape1_' + tform + ind + '"]').focus();
                    });
            this.ajax[tform] = [];
            return false;
        }
        /*if($('input[name="ape2_'+tform+ind+'"]').val()=='')
         {
         error("FORMULARIO INCOMPLETO","ES NESESARIO PROPORCIONAR EL SEGUNDO APELLIDO  DEL "+tform.toUpperCase()+num+"",
         function(){$('input[name="ape2_'+tform+ind+'"]').focus();});
         this.ajax[tform]=[];
         return false;
         }*/
        if ($('input[name="emai_' + tform + ind + '"]').val().length > 0 && ($('input[name="emai_' + tform + ind + '"]').val().indexOf('@') === -1 || $('input[name="emai_' + tform + ind + '"]').val().indexOf('.') === -1)) {
            error("FORMULARIO INCOMPLETO", "EL CORREO ELECTRONICO DEL " + tform.toUpperCase() + num + " ES INVALIDO",
                    function () {
                        $('input[name="emai_' + tform + ind + '"]').focus();
                    });
            this.ajax[tform] = [];
            return false;
        }
        if ($('input[name="telf_' + tform + ind + '"]').val().length > 0 && !$('input[name="telf_' + tform + ind + '"]').ValidTelefono()) {
            error("FORMULARIO INCOMPLETO", "EL NUMERO DE TELEFONO  DEL " + tform.toUpperCase() + num + " ES INVALIDO",
                    function () {
                        $('input[name="telf_' + tform + ind + '"]').focus();
                    });
            this.ajax[tform] = [];
            return false;
        }

    }
    for (var i = 0; i < ci.length; i++)
    {
        if (ci.indexOf(ci[i]) != ci.lastIndexOf(ci[i])) {
            error("FORMULARIO INCOMPLETO", "LA CEDULA DEL " + tform.toUpperCase() + " N&deg; " + (Number(ci.indexOf(ci[i])) + 1) + "  Y DEL N&deg; " + (Number(ci.lastIndexOf(ci[i])) + 1) + " NO PUEDEN SER IDENTICAS ");
            this.ajax[tform] = [];
            return false;
        }
    }
    return true;
};
TEG.prototype.form_object = function (tform, cant) {
    var form = new Object();
    form['ci_' + tform] = [];
    form['nom1_' + tform] = [];
    form['nom2_' + tform] = [];
    form['ape1_' + tform] = [];
    form['ape2_' + tform] = [];
    form['emai_' + tform] = [];
    form['telf_' + tform] = [];
    for (i = 0; i < cant; i++)
    {
        form['ci_' + tform].push($("#ci_" + tform + i).val());
        form['nom1_' + tform].push($("#nom1_" + tform + i).val());
        form['nom2_' + tform].push($("#nom2_" + tform + i).val());
        form['ape1_' + tform].push($("#ape1_" + tform + i).val());
        form['ape2_' + tform].push($("#ape2_" + tform + i).val());
        form['emai_' + tform].push($("#emai_" + tform + i).val());
        form['telf_' + tform].push($("#telf_" + tform + i).val());
    }
    return form;
};
TEG.prototype.rellenar_form = function (tform) {

    var script2 = "";
    var cant = this.ajax[tform]['ci_' + tform].length;
    var form;
    for (i = 0; i < cant; i++)
    {
        form = this.ajax[tform];
        $('#ci_' + tform + '' + i + '').val(this.ajax[tform]['ci_' + tform][i]);
        $('#nom1_' + tform + '' + i + '').val(this.ajax[tform]['nom1_' + tform][i]);
        $('#nom2_' + tform + '' + i + '').val(this.ajax[tform]['nom2_' + tform][i]);
        $('#ape1_' + tform + '' + i + '').val(this.ajax[tform]['ape1_' + tform][i]);
        $('#ape2_' + tform + '' + i + '').val(this.ajax[tform]['ape2_' + tform][i]);
        $('#emai_' + tform + '' + i + '').val(this.ajax[tform]['emai_' + tform][i]);
        $('#telf_' + tform + '' + i + '').val(this.ajax[tform]['telf_' + tform][i]);
    }
};
TEG.prototype.exist = function (tform, cant) {
    var obj = this;
    for (var i = 0; i < cant; i++)
    {
        $('#ci_' + tform + '' + i).focusout(function (e) {
            var id = $(this).attr('id');
            var i2 = id.substr(id.length - 1, id.length - 1);
            var ci = $(this).val();
            $().load_json(obj.ajax.fteg + '::BuscarTform', {"ci_b": ci, 'tform': tform},
                    function (json) {

                        if (json.error) {
                            error("ERROR EN EL SERVIDOR", json.error);
                            return false;
                        }
                        var campo = {};
                        if (json.num_rows > 0) {
                            campo = json.result[0];
                            $('#nom1_' + tform + i2).val(campo['nom1_' + tform]);
                            $('#nom2_' + tform + i2).val(campo['nom2_' + tform]);
                            $('#ape1_' + tform + i2).val(campo['ape1_' + tform]);
                            $('#ape2_' + tform + i2).val(campo['ape2_' + tform]);
                            $('#emai_' + tform + i2).val(campo['emai_' + tform]);
                            $('#telf_' + tform + i2).val(campo['telf_' + tform]);

                            $('#errores:ui-dialog').dialog('destroy');
                            $('#errores').dialog('close');
                            $('#errores').attr('title', '');
                            $('#error_div').html("EL " + tform.toUpperCase() + " " + (Number(cant) > 1 ? "N&deg; " + (Number(i2) + 1) : '') + " YA SE ENCUENTRA EN LA BASE DE DATOS, EL FORMULARIO SE LLENARA CON LOS DATOS DISPONIBLES  ");
                            $('#errores').dialog({
                                height: 300,
                                width: 300,
                                modal: true,
                                buttons: {
                                    'ENTENDIDO': function () {
                                        $('#errores').dialog('close');
                                    }}
                            });

                        }

                    });
        });
    }
};

TEG.prototype.fmt_form = function () {
    $('input[type=tel]').FmtTelefono();
    $('.ci').FmtIdentificacion('C.I-');
};
TEG.prototype.paso1 = function ()//paso 1
{

    var obj = this;
    //obj.
    $('#verif_teg').click(function (e) {
        var titulo = $('input[name=titulo_teg]').val();
        $('#coin').load_json(obj.ajax.fteg + '::verificate', {'titulo_teg': titulo, 'verificate': true}, function (json) {
            if (json.error) {
                error("ERROR EN EL SERVIDOR", json.error);
                return false;
            }
            var html = ' ';
            var campo = {};
            for (var i = 0; campo = json.result[i]; i++)
            {
                html += '<tr class="' + (i % 2 ? 'row_act' : '') + '"><td>' + campo['titulo_teg'] + '</td></tr>';
            }
            if (json.num_rows == 0) {
                html += '<tr><td  align="center" class="col_select"> NO SE ENCONTRARON COINCIDENCIAS </td>\</tr>';
            }
            return html;
        });
    });
    $('#SIGIENTE').click(function (e) {
        obj.titulo = $('input[name=titulo_teg]').val();
        obj.paso1_2();
    });

};
TEG.prototype.paso1_2 = function ()//insertar y enviar la cantidada de autores 
{
    var obj = this;

    var html = ' <div align="center">\
<H2>INGRESA LA CANTIDAD DE AUTORES DE <BR>' + obj.titulo + ' </H2>\
<input type="number" name="c_atores" class="input_text" min="1" ><br>\
<button class="submit" type="submit"  id="regresar" name=""  value="">REGRESAR</button>\
<button class="submit" type="submit"id="bc_atores" name="bc_atores"  value="">ENVIAR</button>\
</div><br>';
    obj.paso_sig();
    $('.formularios').html(html);
    $('#regresar').click(function (e) {
        e.preventDefault();
        obj.b_regresar('1');
    });
    $('#bc_atores').click(function (e) {
        var cant = Number($('input[name=c_atores]').val());
        if (cant < 1) {
            error("ERROR", "LA CANTIDAD NO PUEDE SER MENOR A 0");

        } else {
            $().load_html(obj.ajax.fteg + '::XMLHttpRequest', {"cant": cant, "request": "form-autor"}, function (h) {
                $('.formularios').html(h);
                obj.paso2(cant);
            });//
        }

    });

};
TEG.prototype.paso2 = function (cant)//ingresar los datos de autores
{

    var obj = this;
    $('#regresar').click(function (e) {
        e.preventDefault();
        obj.b_regresar('1_2');
    });
    obj.fmt_form();
    obj.exist('autor', cant);
    $('#autores').click(function (evento) {
        evento.preventDefault();
        obj.ajax.autor = obj.form_object('autor', cant);

        if (obj.Valid_form('#form_autor', 'autor', cant)) {
            $().load_html(obj.ajax.fteg + '::XMLHttpRequest', {"request": "form-tutor"}, function (h) {
                $('.formularios').html(h);
                obj.paso3();
            });
        }
    });

};
TEG.prototype.paso3 = function () {

    var obj = this;
    $('#regresar').click(function (e) {
        e.preventDefault();
        obj.b_regresar('2');
    });
    obj.paso_sig();
    obj.fmt_form();
    obj.exist('tutor', 1);
    $('#tutores').click(function (evento) {
        evento.preventDefault();

        obj.ajax.tutor = obj.form_object('tutor', 1);

        if (obj.Valid_form('#form_tutor', 'tutor', false)) {
            obj.paso3_4();
        }
    });

};
TEG.prototype.paso3_4 = function () {
    var obj = this;

    obj.paso_sig();
    var html = ' <div align="center">\
<H2>INGRESA LA CANTIDAD DE JURADOS DE <BR>' + obj.titulo + ' </H2>\
<input type="number" name="c_jurados" class="input_text" min="1"><br>\
<button class="submit" type="submit"  id="regresar" name=""  value="">REGRESAR</button>\
<button class="submit" type="submit"  id="bc_jurados" name="bc_jurados"  value="">ENVIAR</button>\
</div><br>';
    $('.formularios').html(html);
    $('#regresar').click(function (e) {
        e.preventDefault();
        obj.b_regresar('3');
    });
    $('#bc_jurados').click(function (e) {

        var cant = Number($('input[name=c_jurados]').val());
        if (cant < 1) {
            error("ERROR", "LA CANTIDAD NO PUEDE SER MENOR A 0");

        } else
            $('.formularios').load_html(obj.ajax.fteg + '::XMLHttpRequest', {"cant": cant, "request": "form-jurado"}, function (h) {
                $('.formularios').html(h);
                obj.paso4(cant);
            });
    });

};
TEG.prototype.paso4 = function (cant) {

    var obj = this;
    $('#regresar').click(function (e) {
        e.preventDefault();
        obj.b_regresar('3_4');
    });
    obj.fmt_form();
    obj.exist('jurado', cant);
    $('#jurados').click(function (evento) {
        evento.preventDefault();

        obj.ajax.jurado = obj.form_object('jurado', cant);

        if (obj.Valid_form('#form_jurado', 'jurado', cant)) {

            $('.formularios').load_html(obj.ajax.fteg + '::XMLHttpRequest', {"request": "CargarPdf"}, function (h) {
                $('.formularios').html(h);
                obj.paso5(cant);
            });
        }
    });
};

TEG.prototype.paso5 = function () {
    var obj = this;
    obj.paso_sig();
    $('#regresar').click(function (e) {
        e.preventDefault();
        obj.b_regresar('4');
    });
    $('button[name=cargar_pdf]').click(function (e) {
        e.preventDefault();
        $('.formularios').load_html(obj.ajax.fteg + '::XMLHttpRequest', {titulo: obj.titulo, "request": "form-teg"}, function (h) {
            $('.formularios').html(h);
            obj.paso6();
        });
        e.preventDefault();
    });

    var Iframe = $('<iframe id="iframe" width="600" height="600" src="" ></iframe>');
    $('input[name=TegPdf]').change(function (e) {
        e.preventDefault();
        var formData = new FormData($('#FormTegPdf')[0]);
        $('').load_json("?page=teg::CargarPdf", formData, function (json) {
            if (json.error) {
                error("ERROR", json.error);

            } else {
                obj.ajax.pdf_name = json.pdf_name;
                Iframe.attr('src', '?page=teg::PreviewPdf&pdf_name=' + json.pdf_name);
                $('#PreviewPdf').html(Iframe);

            }
            //console.log(json);
        }, {contentType: false, processData: false});


    });


};
TEG.prototype.ValidateTEG = function () {
    console.log($('select[name=codi_carr]').val());
    if ($('select[name=codi_carr]').val() === '' || $('select[name=codi_carr]').val() === undefined) {
        error("ERROR", "PORFAVOR SELECCIONE UNA CARRERA ");
        return false;
    }
    if ($('select[name=peri_acad]').val() === '' || $('select[name=peri_acad]').val() === undefined) {
        error("ERROR", "PORFAVOR SELECCIONE UN PERIODO ACADEMICO ");
        return false;
    }
    if ($('select[name=codi_menc]').val() === '' || $('select[name=codi_menc]').val() === undefined) {
        error("ERROR", "PORFAVOR SELECCIONE UNA MENCION ");
        return false;
    }
    return true;
};
TEG.prototype.paso6 = function () {

    var obj = this;
    obj.paso_sig();
    $('#regresar').click(function (e) {
        e.preventDefault();
        obj.b_regresar('5');
    });
    $('input[name=titulo_teg]').val(obj.titulo);
    $('#teg').click(function (e) {
        e.preventDefault();
        if (!obj.ValidateTEG()) {
            return;
        }

        obj.ajax.teg = {
            titulo_teg: obj.titulo,
            codi_carr: $('select[name=codi_carr]').val(),
            peri_acad: $('select[name=peri_acad]').val(),
            codi_menc: $('select[name=codi_menc]').val(),
            obse_teg: $('textarea[name=obse_teg]').val(),
            pdf_name: obj.ajax.pdf_name
        };
        var teg = $.extend(obj.ajax.teg, obj.ajax.autor, obj.ajax.tutor, obj.ajax.jurado, {"request": "verificar-teg"});

        $().load_html(obj.ajax.fteg + '::XMLHttpRequest', teg, function (h) {
            $('.formularios').html(h);
            obj.registrar_teg();
        });
    });
};
TEG.prototype.registrar_teg = function () {

    var obj = this;
    $('#regresar').click(function (e) {
        e.preventDefault();
        obj.b_regresar('6');
    });
    $('#registrar').click(function (e) {

        var teg = $.extend(obj.ajax.teg, obj.ajax.autor, obj.ajax.tutor, obj.ajax.jurado);
        $().load_json(obj.ajax.fteg + '::Guardar', teg, function (json) {
            if (json.error) {
                error("ERROR EN EL SERVIDOR", json.error);
                return false;
            } else {
                $('#errores:ui-dialog').dialog('destroy');
                $('#errores').dialog('close');
                $('#errores').attr('title', '<H2></H2>');
                $('#error_div').html("EL TRABAJO ESPECIAL DE GRADO <br>" + obj.titulo.toUpperCase() + "<br>FUE GUARDADO");
                $('#errores').dialog({
                    height: 300,
                    width: 300,
                    modal: true,
                    buttons: {'LISTO': function () {
                            $('#errores').dialog('close');
                            window.location = '?page=teg&codi_teg=' + json.codi_teg;
                        }}
                });
            }
        });
    });
};
TEG.prototype.b_regresar = function (paso) {
    var obj = this;

    switch (paso)
    {
        case '1':
            window.location = '?page=teg::insertar&titulo=' + obj.titulo;
            break;
        case '1_2':
            obj.paso_ant();
            obj.paso1_2();
            break;
        case '2':
            $().load_html(obj.ajax.fteg + '::XMLHttpRequest', {"request": "form-autor", "cant": obj.ajax.autor.ci_autor.length}, function (h) {
                $('.formularios').html(h);
                obj.paso_ant();
                obj.rellenar_form('autor');
                obj.paso2(obj.ajax.autor.ci_autor.length);
            });
            break;
        case '3':
            $().load_html(obj.ajax.fteg + '::XMLHttpRequest', {"request": "form-tutor"}, function (h) {
                $('.formularios').html(h);
                obj.paso_ant();
                obj.rellenar_form('tutor');
                obj.paso3();
            });
            break;
        case '3_4':
            obj.paso_ant();
            obj.paso3_4();
            break;
        case '4':
            $('.formularios').load_html(obj.ajax.fteg + '::XMLHttpRequest', {"request": "form-jurado", "cant": obj.ajax.jurado.ci_jurado.length}, function (h) {
                $('.formularios').html(h);
                obj.paso_ant();
                obj.rellenar_form('jurado');
                obj.paso4(obj.ajax.jurado.ci_jurado.length);
            });
            break;
        case '5':
            $('.formularios').load_html(obj.ajax.fteg + '::XMLHttpRequest', {"request": "CargarPdf"}, function (h) {
                $('.formularios').html(h);
                obj.paso_ant();
                obj.paso5();
                $('#PreviewPdf').html('<iframe id="iframe" width="600" height="600" src="?page=teg::PreviewPdf&pdf_name=' + obj.ajax.pdf_name + '" ></iframe>');
            });

            break;
        case '6':

            $().load_html(obj.ajax.fteg + '::XMLHttpRequest', {"request": "form-teg", titulo: obj.titulo}, function (h) {
                $('.formularios').html(h);
                obj.paso_ant();
                obj.paso6();
                $('select[name=codi_carr]> option[value=' + obj.ajax.teg.codi_carr + ']').attr('selected', '');
                $('select[name=peri_acad] > option[value=' + obj.ajax.teg.peri_acad + ']').attr('selected', '');
                $('select[name=codi_menc]> option[value=' + obj.ajax.teg.codi_menc + ']').attr('selected', '');
                $('textarea[name=obse_teg]').val(obj.ajax.teg.obse_teg);

            });
            break;


    }


}

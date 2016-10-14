// JavaScript Document
function PERS(ajax) {
    this.ajax = ajax;

    this.Consultar = function (elem, obj_ajax) {
        var obj = this;
        $().load_json(this.ajax, obj_ajax, function (J) {

            var html = '';
            if (J.error) {
                error('ERROR', J.error);
                return 0;
            } else {
                var campo;
                var tpers = J.tpers;
                if (J.num_rows == 0) {
                    html = " <tr class='col_hov'>\
<td colspan='6' align='center' class='col_select'>NO SE ENCONTRARON RESULTADOS </td>\
</tr>"
                }
                for (var i in J.result)
                {
                    campo = J.result[i];
                    html += '<tr class="col_hov ' + (i % 2 ? 'row_act' : '') + '">\
<td>' + campo['ci_' + tpers] + '</td>\
<td>' + campo['nom1_' + tpers] + ' ' + campo['nom2_' + tpers] + '</td>\
<td>' + campo['ape1_' + tpers] + ' ' + campo['ape2_' + tpers] + '</td>\
<td>' + campo['emai_' + tpers] + '</td>\
<td>' + campo['telf_' + tpers] + '</td>\
<TD><a class="popup" href="?page=' + tpers + '::resumen&ci_' + tpers + '=' + campo['ci_' + tpers] + '"><div class="buscar1"></div></a>\
<a href="?page=' + tpers + '::form_editar&ci_' + tpers + '=' + campo['ci_' + tpers] + '"><div class="edit"></div></a></TD>\
</tr>';
                }
                if (J.next) {

                    html += " <tr class='col_hov'>\
                 <td colspan='6' align='center' class=''><div ><a id='Cnum' next='" + J.next[J.var] + "' >Siguente</a></div></td>\
                </tr>";
                }
                $(elem).html(html);
                //return html;
                $('#Cnum').click(function (e) {
                    e.preventDefault();

                    obj.Consultar(elem, $.extend(elem, {'PM1': J.next[J.var]}));

                });
                return html;
                /*$('.popup').click(function(e) {
                 e.preventDefault();
                 popUpWindow($(this).attr('href'),window.innerWidth,window.innerHeight);
                 });*/
            }
        });
    }
}
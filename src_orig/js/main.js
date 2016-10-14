// JavaScript Document

function main(EventMain)
{
    $('.cargando').ajaxStart(star_load).ajaxStop(stop_load);
    $('#iframe').load(stop_load);
    $('a[id=pdf]').click(function (evento)
    {
        evento.preventDefault();
        var htm = $(this).attr('title');
        console.log(htm);
        var w = 960;
        var h = 600;
        var iframe = $('#iframe');
        var conten = $('#conten_html');
        if (conten.css('display') != 'none')
        {
            star_load();
            conten.fadeOut(function () {
                iframe.fadeIn();
            });
            iframe.attr('src', htm).attr('width', w).attr('height', h);
        } else
        {
            iframe.fadeOut(function () {
                conten.fadeIn();
            }).attr('width', 0).attr('height', 0);
        }
    });
    var red = 0, redir = 1795;
    var time_redir = function () {
        red++;
        $('#time_redir').html(red + ' redirec in ' + redir + ' seconds');
        if (redir == red)
        {
            window.location.href = '?page=login';
        }
        setTimeout(time_redir, 1000);
    };
    time_redir();
    $('.buscar').tics('BUSCAR');
    $('input[name=in_criterio]').tics('FILTRO DE BUSQUEDA');
    $('.buscar1').tics('MAS INFORMACION');
}
$(document).ready(main);
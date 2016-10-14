$(document).ready(function (e) {
    $('input[name=pass2]').keyup(function (e) {
        if (e.target.value !== $('input[name=pass1]').val())
        {
            $(this).css('border-color', 'rgba(255,0,4,1.00)');
        } else
        {
            if (e.target.value.length > 1)
                $(this).css('border-color', 'rgba(0,255,52,1.00)');
        }
    });
    $('input[name=pass2]').focusout(function (e) {
        if (e.target.value !== $('input[name=pass1]').val())
        {
            if (e.target.value.length > 1)
                $(this).css('border-color', 'rgba(255,0,4,1.00)');
            error("ERROR", "LAS CONTRASEÑAS NO COINCIDEN");
        } else
        {
            $(this).css('border-color', 'rgba(0,255,52,1.00)');

        }
    });

    $('input[name=ci_user]').FmtIdentificacion('C.I-');


    $('button[name=generatepass]').click(function (e) {
        e.preventDefault();
        var divpass = $('<input type="text">');
        var pass = createpass(16);
        divpass.val(pass);
        $('#passg').html(divpass);
        $('input[name=pass1]').val(pass);
        $('input[name=pass2]').val(pass);


    });

    $('form').bind('submit',ValidaUser);

});

var ValidaUser=function (e) {
    if ($('input[name=pass2]').val() !== $('input[name=pass1]').val())
    {

        error("ERROR", "LAS CONTRASEÑAS NO COINCIDEN", function () {
            $('input[name=pass2]').focus().css('border-color', 'rgba(0,255,52,1.00)');
        });
        e.preventDefault();
        return false;

    } else
    {
        if ($('input[name=pass2]').val().length < 8)
        {
            error("ERROR", "LA CONTRASEÑA DEVE SER DE ALMENOS 8 CARACTERES", function () {
                $('input[name=pass1]').focus();
            });
            e.preventDefault();
            return false;
        }
    }
    return true;

}
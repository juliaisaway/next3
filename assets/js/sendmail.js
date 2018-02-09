var $body = $("body");

$body.on('submit', 'form', function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();

    var form = $(this);

    $(this).find('.formulario').removeClass('form-erro');

    var $required = $(this).find('.formulario'),
        retorno = true,
        campo;
    $.each($required, function () {
        if($(this).attr('type') === 'checkbox'){
            if (!$(this).is(':checked') && retorno === true) {
                retorno = false;
                campo = $(this);
            }
        }
        else{
            if ($(this).val() === '' && retorno === true) {
                retorno = false;
                campo = $(this);
            }
        }
    });
    if (retorno === false) {

        campo.focus();
        campo.addClass('form-erro');
        form.find('.valid-box').slideDown(600);

        setTimeout(function(){
            form.find('.valid-box').slideUp(600);
        }, 4000);

    } else {

        var url = form.attr('action');
        var data = new FormData(this);

        lib.wait();

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {

                lib.wait(false);
                if (data === 'OK') {
                    o.overlayOpen('<div class=\'mensagem-sucesso\' style="margin: 0">Mensagem enviada com sucesso</div>');
                    setTimeout(function () {
                        o.overlayClose();
                    }, 1000);
                }
                else
                    o.overlayOpen(data);
            }
        });


    }
    return false;
});
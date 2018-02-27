/*
 * Login - Next
 *---------------------------------------------------------------
 *
 * Função Javascript para envio e validação do formulário de login do site.
 *
 */

function loginValidade(el){

    //Retorna o caminho do Controlador e cria a array de disparo
    var action = el.attr('action'),
        data = {
            'login':true,
            'adm-user':el.find("input[name='login_email']").val(),
            'adm-pswd':el.find("input[name='login_password']").val()
        };

    $.ajax({
        type: 'POST',
        url: action,
        data: data,
        success: function (data) {

            // Remove o cursor de espera do DOM
            lib.wait(false);

            if(data === 'OK') {
                window.location.reload();
            }
            else {
                var el = $('#notification'),
                    notification_type = 'alert-danger',
                    notification_error = 'Usuário e/ou senha incorretos';

                el.addClass(notification_type).html(notification_error);
                el.slideDown().delay('2500').slideUp();
            }

        }
    });
}

$('#login-form').submit(function(e){

    // Previne qualquer função padrão do HTML
    e.preventDefault();

    // Insere o cursor de espera no DOM
    lib.wait();

    // Inicializa a função de Login
    loginValidade($(this));

});
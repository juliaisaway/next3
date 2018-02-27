/*
 * FormData - Next
 *---------------------------------------------------------------
 *
 * Função Javascript para envio de informações de Formulário via POST
 * para seu controlador correspondente
 *
 */

function formData($val) {

    // Define o elemento $form
    $form = $('#' + $val);

    // Função a ser executada ao enviar um formulário HTML
    $form.submit(function (e) {

        // Previne eventuais ações padrão do DOM
        e.preventDefault();

        // Insere o cursor de espera no DOM
        lib.wait();

        // Retorna todas as informações necessárias para o Ajax
        var formData = new FormData(this),
            id = $(this).attr('id'),
            mode = $(this).attr('data-mode'),
            action = $(this).attr('action'),
            dataType = id.replace('form-', ''),
            url = $(location).attr('pathname') + '?page=' + dataType;

        // Insere a ação a ser executada (edit ou new)
        formData.append(dataType + '_' + mode, 'true');

        // Construtor Ajax
        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {

                //Remove o cursor de espera
                lib.wait(false);

                if (data === 'OK') {
                    lib.wait();
                    setTimeout(function () {
                        // Exceção necessária no caso da Galeria de Banners
                        if(id === 'form-galleryimg' || id === 'form-gallery')
                            window.location.reload();
                        else
                            window.location.href = url;
                    }, 800);
                } else
                    o.overlayOpen(data + "<input class='cancel' type='button' value=' Ok ' />");
            }

        });
    });
}

// Para cada formulário existente na página, execute a função de
// envio do formulário para o Controlador PHP
$('form').each(function () {
    $form = $(this).attr('id');
    formData($form);
});

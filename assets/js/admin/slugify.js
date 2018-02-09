/*
 *---------------------------------------------------------------
 * Slugify
 *---------------------------------------------------------------
 *
 * Função Javascript para conversão de qualquer string para uma
 * slug "human-readable".
 *
 */

function slugify(text){
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
}

$('form').each(function () {

    // Retorna a ID de cada formulário e o seu dataType
    var id = $(this).attr('id'),
        dataType = id.replace('form-', '');

    // Procura o campo de Título e ja converte para slug o campo Slug
    $("input[name='" + dataType + "_title']").on('keyup',function () {
        $("input[name='" + dataType + "_slug']").val(slugify($(this).val()));
    });

});


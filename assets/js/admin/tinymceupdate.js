/*
 *---------------------------------------------------------------
 * TinyMCE Update
 *---------------------------------------------------------------
 *
 * Função Javascript para inbicializar o TinyMCE em campos de Textarea.
 *
 */

function tinyMceUpdate(parameters) {

    // Listagem dos parâmetros que a Função aceita
    var $init = parameters.$init,
        $size = parameters.$size || 400;

    // Remove qualquer TinyMCE anterior
    tinymce.remove($init);

    // Inicializa o TinyMCE
    tinymce.init({
        selector: $init,
        height: $size,
        skin: 'next',
        resize: true,
        menubar: false,
        statusbar: true,
        branding: false,
        language: 'pt_BR',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        contextmenu: "link image inserttable | cell row column deletetable | code",
        plugins: [
            'advlist autolink lists link image imagetools charmap anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code placeholder'
        ],
        // Permite que qualquer alteração no TinyMCE seja salvo em tempo real na textarea
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

}
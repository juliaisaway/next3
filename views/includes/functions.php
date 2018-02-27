<?php
/**
 * Functions - Next
 * --------------------------------------------------
 *
 * Inserção de arquivos Javascript e outras funções importantes do front-end
 *
 */

    // Insere uma quebra de linha no início para identar corretamente
    echo "\n\n";

    // Lista todos os arquivos de bibliotecas Javascript do Next
    $libraries = (object) [
        '/library/overlay.js', '/library/accordion.js', '/library/utilities.js', '/inicializer.js'
    ];

    // Constrói as inclusões de Javascript
    foreach($libraries as $lib) {
        $js = "<script src=\"" . $config->paths->js;
        $js .= $lib;
        $js .= "\"></script>\n";
        echo $js;
    }

    // Insere a chave de API do Gooogle Maps
    if(isset($configs->g_maps_key) && $configs->g_maps_key != "")
        echo '<script src="https://maps.googleapis.com/maps/api/js?key={$configs->g_maps_key}"></script>';

    // Insere o código de identificação do Google Analytics
    if(isset($configs->g_analytics) && $configs->g_analytics != "") {

        echo <<<HERE
            <script async src="https://www.googletagmanager.com/gtag/js?id={$configs->g_analytics}"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
            
                gtag('config', '{$configs->g_analytics}');
            </script>
HERE;

    }

?>
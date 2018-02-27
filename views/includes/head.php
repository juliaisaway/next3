<title><?= $configs->site_name ?></title>
<link rel="icon" type="image/x-icon" href="<?= $config->paths->img.'/favicon.ico' ?>"/>
<meta charset="UTF-8">
<meta http-equiv="content-language" content="pt-br">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Estilização de cores para dispositivos mobile -->
<meta name="theme-color" content="<?= $configs->theme_bar_color ?>">
<meta name="msapplication-navbutton-color" content="<?= $configs->theme_bar_color ?>">
<meta name="apple-mobile-web-app-status-bar-style" content="<?= $configs->theme_bar_color ?>">

<?php
// Insere os valores de metatags do site com as informações do banco de dados
$metatags = (object) [
    (object) ["type" => "name", "name" => "description", "value" => $configs->description],
    (object) ["type" => "name", "name" => "keywords", "value" => $configs->keywords],
    (object) ["type" => "property", "name" => "og:title", "value" => $configs->site_name],
    (object) ["type" => "property", "name" => "og:description", "value" => $configs->description],
];
// Constrói as metatags do site
echo "<!-- Metatags do website para os motores de busca --> \n";
foreach ($metatags as $item) {
    $meta = "<meta ";
    $meta .= $item->type."='".$item->name."'";
    $meta .= " content='".$item->value."'";
    $meta .= ">\n";
    echo $meta;
}
?>

<?php
if(isset($configs->fb_thumb) && $configs->fb_thumb != "") {
    // Busca a imagem de thumbnail do Facebook e retorna o tamanho da mesma
    list($width, $height) = getimagesize($config->paths->abs . "assets/images/" . $configs->fb_thumb);
    // Insere os valores da thumbnail do Facebook com as informações do banco de dados
    $facebook_info = (object)[
        (object)['property' => 'og:image', 'content' => $config->paths->abs . 'assets/images/' . $configs->fb_thumb],
        (object)['property' => 'og:image:type', 'content' => 'image/jpeg'],
        (object)['property' => 'og:image:width', 'content' => $width],
        (object)['property' => 'og:image:height', 'content' => $height],
    ];
    // Constrói as metatags de thumbnail do Facebook
    echo "<!-- Metatags de thumbnail para exibição no Facebook --> \n";
    foreach ($facebook_info as $item) {
        $meta = "<meta ";
        $meta .= "property='".$item->property."'";
        $meta .= " content='".$item->content."'";
        $meta .= ">\n";
        echo $meta;
    }
}
?>

<!-- Muralha de estilização do site -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" href="<?= $config->paths->css.'/vendor/fontawesome.min.css' ?>">
<link rel="stylesheet" href="<?= $config->paths->css.'/vendor/bootstrap.min.css' ?>">
<link rel="stylesheet" href="<?= $config->paths->css.'/vendor/slick.css' ?>">
<link rel="stylesheet" href="<?= $config->paths->css.'/style.css' ?>"/>

<!-- Muralha de Javascripts - Bibliotecas externas -->
<script src="<?= $config->paths->js.'/vendor/jquery.min.js' ?>"></script>
<script src="<?= $config->paths->js.'/vendor/bootstrap.min.js' ?>"></script>
<script src="<?= $config->paths->js.'/vendor/jquery.mask.min.js' ?>"></script>
<script src="<?= $config->paths->js.'/vendor/jquery.matchHeight.min.js' ?>"></script>
<script src="<?= $config->paths->js.'/vendor/slick.min.js' ?>"></script>


<?php

/**
 * Rotas das páginas - Next
 *---------------------------------------------------------------
 *
 * Configuração de cada página do site, junto com suas URLs amigáveis.
 */

// Inclusão da blioteca principal de rotas
include_once('libraries/routes/routesConfig.php');

// Início das rotas
switch($page){
    case '':
        $page = 'home';
        $file = "404.php";
        $partial = "home.mustache";
        break;
    default:
        $page = '404';
        $file = "404.php";
        $partial = "404.mustache";
        break;
}
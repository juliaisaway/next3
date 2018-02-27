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
    case '': $page = 'home';
        $pagina = "views/home.php";
        break;
    default:
        $page = '404';
        $pagina = "views/404.php";
        break;
}
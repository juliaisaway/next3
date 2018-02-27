<?php
/**
 * Rotas - Next
 * --------------------------------------------------
 *
 * Todas as configurações principais de rotas do sistema ficam aqui
 *
 */

$url = (isset($_GET['url']))? $_GET['url']:'';
$url = explode('/', $url);

$page = strtolower($url[0]);
global $breadcrumb;
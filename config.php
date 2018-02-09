<?php
/**
 * NEXT Framework
 * --------------------------------------------------
 *
 * Framework MVC e CMS integrado para desenvolvimento de websites.
 *
 * Arquivo de configurações básicas do website
 *
 * Este arquivo contém todas as informações de diretórios e
 * as configurações de acesso ao banco de dados.
 *
 * @package	next
 * @author Ilton Alberto Junior, William Jacinto Venancio
 * @copyright Copyright (c) 2018
 * @since Version 3.0.0-beta.2
 * @filesource
 */

date_default_timezone_set('America/Sao_Paulo');
ini_set('default_charset','UTF-8');

/*
 *---------------------------------------------------------------
 * Diretórios do site
 *---------------------------------------------------------------
 *
 * Por favor, não mexa nessa parte.
 *
 */

if(in_array($_SERVER["SERVER_ADDR"],array("127.0.0.1","::1"))){
    $mode = 'local';
    $bar = '';
} else {
    $mode = 'final';
    $bar = '';
}

$root = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT']);
$path = str_replace('\\','/',$bar.str_replace($root,'', __DIR__).DIRECTORY_SEPARATOR);

/*
 *---------------------------------------------------------------
 * Configurações de caminhos e banco de dados
 *---------------------------------------------------------------
 */

return (object) array(
    'maintenance' => false,
    'mode' => $mode,
    'path' => $path,
    'paths' => (object) array(
        'abs' => 'http://'.$_SERVER['HTTP_HOST'].$path,
        'assets' => $path.'assets',
        'model' => $path.'models',
        'view' => $path.'views',
        'controller' => $path.'controllers',
        'libraries' => $path.'libraries',
        'uploads' => $path.'assets/uploads',
        'css' => $path.'assets/css',
        'img' => $path.'assets/images',
        'js' => $path.'assets/js',
    ),
    'admin' => (object) array(
        'path' => $path.'admin/',
        'includes' => $path.'admin/includes',
        'view' => $path.'admin/views',
    ),
    'cms_info' => (object) array(
        'agency_name' => 'Kombi Design',
        'agency_link' => 'http://kombidesign.com.br',
        'year' => '2018',
    ),
    'db'=> (object) array(
        'host' => 'kdguia.com.br',
        'username' => 'kdguiaco_novocms',
        'password' => 'kombi18design',
        'database' => 'kdguiaco_novocms'
    ),
    'local_db' => (object) array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'kdcms_new'
    ),
);

?>
<?php
/*
 * Mailform - Next
 *---------------------------------------------------------------
 *
 * Arquivo de configurações básicas de envio de emails via PHPMailer.
 * Por favor, não mexer nesse arquivo a menos que seja estritamente necessário.
 *
 */

// Instancia as configurações do CMS
$config = include('../../config.php');

// Requisições dos Controladores do CMS
require_once(realpath(dirname(__FILE__)) . "/../../controllers/emailController.php");
require_once(realpath(dirname(__FILE__)) . "/../../controllers/settingsController.php");

// Caminho para a pasta de templates padrão da Biblioteca Next
$template_path = realpath(dirname(__FILE__)) . "/templates/";

// Instância do Controlador de Configurações, para retornar os valores do banco de dados
$class_configs = new settingsController();
$configs = $class_configs->getConfigs();

// Instância do Controlador de Emails
$class_emails = new emailController();

// Instância da conexão do banco de dados
$db = new dbAccess();

// Verifica se foi recebido o GET de 'mail'
if(!isset($_GET['mail'])) {
    echo "Função não encontrada...<br/>\r\n";
    var_dump($_POST);
    echo '<br/>'."\r\n";
    var_dump($_FILES);
    die();
}

// Seta os campos do formulário como uma array e os valores padrão como vazios
$dados = $receiver = [];
$content = $message = $template = $title = $sender_mail = $sender_name = '';
$copy = null;
$flag_save = false;

// Puxa todos os formulários do Front-End
require_once(realpath(dirname(__FILE__)) . "/../../views/mailform/mail-content.php");

// Puxa todos os formulários do CMS
require_once(realpath(dirname(__FILE__)) . "/../../cms/views/mailform/mail-content.php");

// Solicita o template do email
$body = file_get_contents($template_path . $template);

// Substitui as variáveis do template pelos campos do formulário
$body = str_replace("#sitename", $configs->site_name, $body );
$body = str_replace("#title", $title, $body );
$body = str_replace("#color", $configs->theme_bar_color, $body );
$body = str_replace("#content", $content, $body );
$body = str_replace("#data", date('d/m/Y'), $body );
$body = str_replace("#ip", $_SERVER['REMOTE_ADDR'], $body );
$body = str_replace("#siteurl", $config->paths->abs, $body );

//Configurações de SMTP
try {
    $mail = $class_emails->mailConfig(
        $configs->server_smtp,
        $configs->port_smtp,
        $configs->user_smtp,
        $configs->pswd_smtp,
        $sender_name,
        $sender_mail,
        $configs->site_name . ' - ' . $title
    );
} catch (phpmailerException $e) {}

// Configurações de envio de email do PHPMailer
try {
    echo $class_emails->sendMail(
        $mail,
        $body,
        $message,
        $sender_name,
        $sender_mail,
        $receiver,
        $copy,
        $flag_save
    );
} catch (phpmailerException $e) {}
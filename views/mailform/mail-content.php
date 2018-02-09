<?php

if(isset($_GET['mail']) && $_GET['mail'] == 'contato') {

    // Salva cada campo do formulário em uma variável e já passa a proteção contra SQL Injection
    foreach ($_POST as $key => $val) {
        $dados[$key] = $db->sanitize($_POST[$key]);
    }

    //Template a ser utilizado para o email
    $template = 'cms-messages.html';

    // Título do email
    $title = 'Formulário de Suporte';

    // Nome e E-mail da pessoa que está mandando o email
    $sender_name = $dados['suporte_name'];
    $sender_mail = $dados['suporte_mail'];
    $message = $dados['suporte_msg'];

    // E-mails de recebimento
    $receiver = 'desenvolvimento2@kombidesign.com.br';
    $copy = 'iltonalberto@gmail.com';

    // Mensagem do corpo de email
    $content = '<p><b>Nome:</b><br/>' . $dados['suporte_name'] . '</p>';
    $content .= '<p><b>Email:</b><br/>' . $dados['suporte_mail'] . '</p>';
    $content .= '<p><b>Categoria:</b><br/>' . $dados['suporte_cat'] . '</p>';
    $content .= '<p><b>Mensagem:</b><br/>' . $dados['suporte_msg'] . '</p>';

}
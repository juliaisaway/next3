<?php

if(isset($_GET['mail']) && $_GET['mail'] == 'cms_suporte') {

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
    $receiver = ['desenvolvimento2@kombidesign.com.br'];
    $copy = 'comercial@kombidesign.com.br';

    // Define se será salvo a mensagem no banco de dados ou não
    $flag_save = false;

    // Mensagem do corpo de email
    $content = '<p><b>Nome:</b><br/>' . $dados['suporte_name'] . '</p>';
    $content .= '<p><b>Email:</b><br/>' . $dados['suporte_mail'] . '</p>';
    $content .= '<p><b>Categoria:</b><br/>' . $dados['suporte_cat'] . '</p>';
    $content .= '<p><b>Mensagem:</b><br/>' . $dados['suporte_msg'] . '</p>';

}

else if(isset($_GET['mail']) && $_GET['mail'] == 'cms_indique') {

    // Salva cada campo do formulário em uma variável e já passa a proteção contra SQL Injection
    foreach ($_POST as $key => $val) {
        $dados[$key] = $db->sanitize($_POST[$key]);
    }

    //Template a ser utilizado para o email
    $template = 'cms-messages.html';

    // Título do email
    $title = 'Formulário de Indicação';

    // Nome e E-mail da pessoa que está mandando o email
    $sender_name = $dados['indique_name'];
    $sender_mail = $dados['indique_mail'];
    $message = $content;

    // E-mails de recebimento
    $receiver = [$dados['indique_destino']];
    $copy = 'comercial@kombidesign.com.br';

    // Define se será salvo a mensagem no banco de dados ou não
    $flag_save = false;

    // Mensagem do corpo de email
    $content = '<p>Olá <strong>'.$dados['indique_parceiro'].'</strong>, </p><br>';
    $content .= '<p>'.$dados['indique_name'].' da empresa '.$configs->site_name.', recomendou a <a href="http://www.kombidesign.com.br" target="_blank">Kombi Design</a> para te ajudar com soluções em marketing digital, seguem abaixo os dados de contato.</p><br>';
    $content .= '<p>Agência Kombi Design<br>(15) 3318-5300<br>';
    $content .= '<a href="mailto:comercial@kombidesign.com.br">comercial@kombidesign.com.br</a><br>';
    $content .= '<a href="http://www.kombidesign.com.br" target="_blank">kombidesign.com.br</a><br>';
    $content .= '<a href="http://facebook.com/kombidesign" target="_blank">fb.com/kombidesign</a></p>';

}
<?php
require_once(realpath(dirname(__FILE__))."/../controllers/core/nextController.php");

class emailModel extends nextController{

    const   key = 'email_id',
            table = 'emails',
            desc = 'o email',
            dataT = 'email';

    /**
     * Função para instanciar e configurar classes de e-mail.
     * @param  string $host Servidor de acesso SMTP do e-mail.
     * @param  string $port Porta de conexão SMTP.
     * @param  string $user E-mail de utilização para disparo de e-mail.
     * @param  string $pswd Senha para utilização de disparo de e-mail.
     * @param  string $name Nome do remetente.
     * @param  string $from E-mail de remetente.
     * @param  string $subject Assunto do e-mail.
     * @return PHPMailer Instância configurada do PHPMailer para envio de e-mails.
     * @throws phpmailerException
     */
    function mailConfig($host, $port, $user, $pswd, $sender_name, $sender_mail, $subject){

        $debug = false;

        $mail = new PHPMailer;
        $mail->setLanguage('pt_br', realpath(dirname(__FILE__)) . '/../../libraries/PHPMailer/language');
        $mail->WordWrap = 50;

        $mail->isSMTP();
        $mail->Host = $host;
        $mail->Port = $port;
        $mail->Username = $user;
        $mail->Password = $pswd;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';

        if($debug == true)
            $mail->SMTPDebug = 2;

        // Desabilita qualquer tipo de verificação. Não usar em produção
        if(in_array($_SERVER["SERVER_ADDR"],array("127.0.0.1","::1"))) {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true)
            );
        }

        $mail->setFrom($sender_mail, $sender_name);
        $mail->Subject = $subject;

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        return $mail;
    }

    /**
     * Função de envio de e-mail.
     * @param $mail PHPMailer Objeto para envio
     * @param $body string Email a ser recebido
     * @param string $content Corpo do Email - Mensagem
     * @param $sender_name string Nome do usuário
     * @param $sender_mail string Remetente do email
     * @param string|array $receiver Lista de emails a ser enviado
     * @param string|array|null $copy Lista de emails em cópia
     * @param bool $flag_save
     * @return string
     * @throws phpmailerException
     */
    function sendMail($mail, $body, $content, $sender_name, $sender_mail, $receiver, $copy = null, $flag_save = true){

        // Adiciona todos os emails que devem ser receber a mensagem
        if(is_array($receiver)){
            foreach($receiver as $row)
                $mail->addAddress($row);
        } else
            $mail->addAddress($receiver);

        // Adiciona todos os emails que devem receber em cópia
        if(isset($copy) && $copy != null ){
            if(is_array($copy)) {
                foreach ($copy as $row)
                    $mail->addCC($row);
            } else
                $mail->addCC($copy);
        }

        // Puxa os valores do campo da mensagem e gera a mensagem de corpo sem HTML
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        // Salva todas as mensagems no banco de dados
        if($flag_save) {
            $array = [
                'email_name' => $sender_name,
                'email_email'=>$sender_mail,
                'email_category'=>$_GET['mail'],
                'email_message'=>strip_tags($content)
            ];

            $this->set($array);
        }

        // Verifica se o enmvio foi feito e retorna uma mensagem para o usuário
        if(!$mail->send()) {
            return 'Erro ao enviar o email!<br/>'.'ERRO: ' . $mail->ErrorInfo;
        } else {
            return 'OK';
        }

    }

}
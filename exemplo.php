<?php
date_default_timezone_set('America/Sao_Paulo');

require 'vendor/autoload.php';

$conf = parse_ini_file("config.ini");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(exceptions: true);

try {
    $mail->isSMTP();

    // Configurações do servidor
    $mail->Host = $conf["host"];
    $mail->SMTPAuth = true;
    $mail->Username = $conf["username"];
    $mail->Password = $conf["password"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $conf["port"];

    // Remetente e Destinatários
    $mail->setFrom('username@host.com', 'Nome do From');
    $mail->addAddress('email_destino@host.com', 'Nome do destino');
    $mail->addReplyTo('email_responder_para@host.com', 'Nome de quem receberá a resposta');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Anexos
    //$mail->addAttachment('/var/tmp/arquivo.tar.gz');
    //$mail->addAttachment('/tmp/imagem.jpg', 'novo-nome.jpg');

    // Conteúdo
    $mail->isHTML(true);
    $mail->Subject = 'Assunto aqui';
    $mail->Body = 'Esse é o corpo da mensagem em HTML <b>em negrito!</b>';
    $mail->Body .= '<p>Lorem Ipsum</p>';
    $mail->Body .= '<p>Now: '.date("d/m/Y - H:i:s").'</p>';
    $mail->AltBody = 'Esse é o corpo da mensagem em "texto puro" para clientes que não suportam HTML';

    $mail->send();
} catch (Exception $exception) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($toEmail, $toName, $subject, $body) {
    $mail = new PHPMailer(true); 

    try {
        // Configurações do Servidor SMTP
        $mail->isSMTP();                                            // Enviar usando SMTP
        $mail->Host       = 'smtp.gmail.com';                     // Servidor SMTP (ex: smtp.gmail.com, smtp.outlook.com)
        $mail->SMTPAuth   = true;                                   // Habilitar autenticação SMTP
        $mail->Username   = 'suportesuac@gmail.com';                // Seu e-mail completo
        $mail->Password   = 'puhoizzgeizhoutj';                   // Senha do seu e-mail ou senha de aplicativo (se usar Gmail/Outlook)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Habilitar criptografia TLS implícita (ssl)
        $mail->Port       = 465;                                    // Porta TCP para conectar (465 para SMTPS)

        // Remetente
        $mail->setFrom('suportesuac@gmail.com', 'SUAC - Redefinição de Senha'); // E-mail de quem envia, Nome de quem envia

        // Destinatário
        $mail->addAddress($toEmail, $toName); // Adiciona um destinatário

        // Conteúdo
        $mail->isHTML(true);                                  // Definir formato do e-mail para HTML
        $mail->CharSet = 'UTF-8';                             // Setar o charset para UTF-8
        $mail->Subject = $subject;
        $mail->Body    = nl2br($body); // `nl2br` converte quebras de linha em <br/> para HTML
        $mail->AltBody = $body;        // Texto puro para clientes que não suportam HTML

        $mail->send();
        return true; // E-mail enviado com sucesso
    } catch (Exception $e) {
        // Logar o erro para depuração 
        error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
        return false; // Falha no envio
    }
}
?>
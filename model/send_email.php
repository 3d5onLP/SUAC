<?php
// Carrega o autoload do Composer para usar bibliotecas externas
require_once __DIR__ . '/../vendor/autoload.php'; 

// Importa as classes do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Função que envia um e-mail com os dados fornecidos
function sendEmail($toEmail, $toName, $subject, $body) {
    // Cria uma nova instância do PHPMailer
    $mail = new PHPMailer(true); 

    try {
        // Habilita o uso de SMTP
        $mail->isSMTP();                                            

        // Define o servidor SMTP do Gmail
        $mail->Host = 'smtp.gmail.com';                             

        // Ativa a autenticação SMTP
        $mail->SMTPAuth = true;                                     

        // E-mail que será usado para enviar
        $mail->Username = 'suportesuac@gmail.com';                  

        // Senha do aplicativo (gerada no Gmail)
        $mail->Password = 'puhoizzgeizhoutj';                       

        // Criptografia segura (SSL)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            

        // Porta usada pelo servidor SMTP com SSL
        $mail->Port = 465;                                          

        // Define o e-mail e nome do remetente
        $mail->setFrom('suportesuac@gmail.com', 'SUAC - Redefinição de Senha'); 

        // Define o e-mail e nome do destinatário
        $mail->addAddress($toEmail, $toName);                       

        // Define que o corpo do e-mail será em HTML
        $mail->isHTML(true);            

        // Define o charset para evitar problemas com acentuação
        $mail->CharSet = 'UTF-8';       

        // Define o assunto do e-mail
        $mail->Subject = $subject;

        // Define o corpo do e-mail (com quebras de linha convertidas em <br>)
        $mail->Body = nl2br($body);     

        // Corpo alternativo (em texto simples) para e-mails que não suportam HTML
        $mail->AltBody = $body;        

        // Envia o e-mail
        $mail->send();

        // Retorna verdadeiro se o e-mail foi enviado com sucesso
        return true;

    } catch (Exception $e) {
        // Em caso de erro, grava no log
        error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");

        // Retorna falso indicando falha
        return false;
    }
}
?>

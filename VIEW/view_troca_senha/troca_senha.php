<?php

require_once '../../model/conexao.php'; 

// Mensagens de feedback e controle de exibição do formulário
$mensagem_status_redefinir = ''; // Para mensagens após a validação do token na URL
$mostrar_formulario_redefinir = false; // Controla a exibição do formulário de nova senha

// Verifica se há um token na URL 
$token = isset($_GET['token']) ? $_GET['token'] : '';

if (empty($token)) {
?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SUAC - Redefinir Senha</title>
        <link rel="icon" href="../icon/logo.png" type="image/png">
        <link rel="stylesheet" href="../../global_suac.css">
        <link rel="stylesheet" href="../components/btn_sent.css">
        <link rel="stylesheet" href="../components/btn_valid-attach.css">
        <link rel="stylesheet" href="../components/input_forms.css">
        <link rel="stylesheet" href="troca_senha.css">
    </head>

    <body>
    <div class="container1">
        <h1 class="title-text">Redefinição de Senha</h1>

        <p class="cad-text">Por favor, informe sua matrícula para redefinir sua senha:</p>

        <form action="../../model/autenticar.php" method="post" class="d-flex">
            <input class="input-form" type="text" name="matricula_ou_email" placeholder="Digite sua matrícula ou e-mail..." required>
            <button type="submit" name="solicitar_redefinicao" class="btn-send">Solicitar Redefinição</button>
        </form>

        <?php
            // Exibe mensagens de feedback da solicitação de token
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'success') {
                    // Sucesso no envio do e-mail
                    echo '<p style="color: green;">Um e-mail com as instruções foi enviado para você!</p>';
                } elseif ($_GET['status'] == 'error' && isset($_GET['message'])) {
                    // Erro ao tentar enviar ou localizar o usuário
                    echo '<p style="color: red;">Erro: ' . htmlspecialchars($_GET['message']) . '</p>';
                }
            }
        ?>
    </div>
    </body>
</html>

<?php

} else {

    $stmt = $conexao->prepare("SELECT id, reset_token_expires_at FROM usuarios WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $expires_at = new DateTime($usuario['reset_token_expires_at']);
        $now = new DateTime();

        if ($expires_at > $now) {
            // Token válido e não expirado
            $mostrar_formulario_redefinir = true;
        } else {
            // Token expirado
            $mensagem_status_redefinir = "Link de redefinição expirado. Por favor, solicite um novo.";
        }
    } else {
        // Token não encontrado no banco de dados 
        $mensagem_status_redefinir = "Link de redefinição inválido ou já utilizado.";
    }
    $stmt->close();
    $conexao->close(); // Fecha a conexão após a validação do token

?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SUAC - Redefinir Senha</title>
        <link rel="icon" href="../icon/logo.png" type="image/png">
        <link rel="stylesheet" href="../../global_suac.css">
        <link rel="stylesheet" href="../components/btn_sent.css">
        <link rel="stylesheet" href="../components/btn_valid-attach.css">
        <link rel="stylesheet" href="../components/input_forms.css">
        <link rel="stylesheet" href="troca_senha.css">
    </head>

    <body>
    <div class="container1">
        <h1 class="title-text">Redefinição de Senha</h1>

        <?php
        // Exibe a mensagem de status da validação do token
        if (!empty($mensagem_status_redefinir)) {
            echo '<p style="color: red;">' . htmlspecialchars($mensagem_status_redefinir) . '</p>';
            echo '<p>Se você precisa redefinir sua senha, <a href="troca_senha.php">clique aqui para solicitar um novo link</a>.</p>';
        }
        ?>

        <?php if ($mostrar_formulario_redefinir): // Só mostra o formulário se o token for válido ?>
            <p class="cad-text">Você está redefinindo sua senha. Por favor, insira a nova senha:</p>

            <form action="../../model/autenticar.php" method="post" class="d-flex-column">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                <p class="cad-text">Nova senha:</p>
                <input class="input-form" type="password" name="nova_senha" placeholder="Digite uma nova senha..." required>

                <p class="cad-text">Confirme a nova senha:</p>
                <input class="input-form" type="password" name="confirmar_nova_senha" placeholder="Confirme a nova senha..." required>

                <div class="submit">
                <button class="btn-send" type="submit" name="redefinir_senha">Redefinir Senha</button>
                </div>
            </form>

            <?php
            // Mensagens de feedback após tentativa de redefinir a senha 
            if (isset($_GET['status'])) { 
                if ($_GET['status'] == 'success_reset') {
                    echo '<p style="color: green;">Sua senha foi redefinida com sucesso! Você pode fazer login agora.</p>';
                } elseif ($_GET['status'] == 'error_reset' && isset($_GET['message'])) {
                    echo '<p style="color: red;">Erro na redefinição: ' . htmlspecialchars($_GET['message']) . '</p>';
                }
            }
            ?>
        <?php endif; ?>
    </div>
    </body>
</html>
<?php

}
?>
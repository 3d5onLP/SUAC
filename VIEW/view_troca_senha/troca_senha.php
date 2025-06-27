<?php
  require_once '../../model/auth_check.php';
?>

// Resto do seu código PHP e HTML da página restrita
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
    <!-- Container principal -->
    <div class="container1">
        <!-- Título da página -->
        <h1 class="title-text">Redefinição de Senha</h1>

        <?php
            // Verifica se há um token na URL (usado para redefinir senha diretamente)
            $token = isset($_GET['token']) ? $_GET['token'] : '';

            // Se não houver token, exibe o formulário de solicitação de redefinição
            if (empty($token)) {
        ?>

            <!-- Texto explicativo -->
            <p class="cad-text">Por favor, informe sua matrícula para redefinir sua senha:</p>

            <!-- Formulário para solicitar redefinição -->
            <form action="../../model/autenticar.php" method="post" class="d-flex">
                <input class="input-form" type="text" name="matricula_ou_email" placeholder="Digite sua matrícula ou e-mail..." required>
                <button type="submit" name="solicitar_redefinicao" class="btn-send">Solicitar Redefinição</button>
            </form>

            <?php
                // Exibe mensagens de feedback (sucesso ou erro)
                if (isset($_GET['status'])) {
                    if ($_GET['status'] == 'success') {
                        // Sucesso no envio do e-mail
                        echo '<p style="color: green;">Um e-mail com as instruções foi enviado para você!</p>';
                    } elseif ($_GET['status'] == 'error' && isset($_GET['message'])) {
                        // Erro ao tentar enviar ou localizar o usuário
                        echo '<p style="color: red;">Erro: ' . htmlspecialchars($_GET['message']) . '</p>';
                    }
                }

                } else {
                // Se houver token, mostra o formulário para redefinir a senha
            ?>

            <!-- Texto explicativo -->
            <p class="cad-text">Você está redefinindo sua senha. Por favor, insira a nova senha:</p>

            <!-- Formulário para nova senha -->
            <form action="../../model/autenticar.php" method="post" class="d-flex-column">
                <!-- Envia o token escondido no formulário -->
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                <!-- Campo nova senha -->
                <p class="cad-text">Nova senha:</p>
                <input class="input-form" type="password" name="nova_senha" placeholder="Digite uma nova senha..." required>

                <!-- Campo confirmar nova senha -->
                <p class="cad-text">Confirme a nova senha:</p>
                <input class="input-form" type="password" name="confirmar_nova_senha" placeholder="Confirme a nova senha..." required>

                <!-- Botão para enviar nova senha -->
                <div class="submit">
                <button class="btn-send" type="submit" name="redefinir_senha">Redefinir Senha</button>
                </div>
            </form>

            <?php
            // Mensagens de feedback após tentativa de redefinir a senha
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'success_reset') {
                    // Senha redefinida com sucesso
                    echo '<p style="color: green;">Sua senha foi redefinida com sucesso! Você pode fazer login agora.</p>';
                } elseif ($_GET['status'] == 'error_reset' && isset($_GET['message'])) {
                    // Erro na redefinição da senha
                    echo '<p style="color: red;">Erro na redefinição: ' . htmlspecialchars($_GET['message']) . '</p>';
                }
            }
        }
        ?>
    </div>
    </body>
</html>

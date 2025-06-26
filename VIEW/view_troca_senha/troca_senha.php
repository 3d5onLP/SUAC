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
    // Verifica se um token foi passado na URL
    $token = isset($_GET['token']) ? $_GET['token'] : '';

    if (empty($token)) {
        // --- FORMULÁRIO PARA SOLICITAR E-MAIL/MATRÍCULA ---
        // Este formulário enviará a matrícula/email para o seu script de autenticação
        // que irá gerar e enviar o token.
    ?>
        <p class="cad-text">Por favor, informe sua matrícula para redefinir sua senha:</p>
        <form action="../../model/autenticar.php" method="post" class="d-flex">
            <input class="input-form" type="text" name="matricula_ou_email" placeholder="Digite sua matrícula ou e-mail..." required>
            <button type="submit" name="solicitar_redefinicao" class="btn-send">Solicitar Redefinição</button>
        </form>
        <?php
        // Aqui você pode adicionar mensagens de erro/sucesso após o envio do formulário,
        // por exemplo, usando parâmetros GET na URL ao redirecionar de volta.
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<p style="color: green;">Um e-mail com as instruções foi enviado para você!</p>';
            } elseif ($_GET['status'] == 'error' && isset($_GET['message'])) {
                echo '<p style="color: red;">Erro: ' . htmlspecialchars($_GET['message']) . '</p>';
            }
        }
    } else {
        // --- FORMULÁRIO PARA INSERIR NOVA SENHA (COM TOKEN) ---
        // Seu HTML atual para inserir o código e a nova senha.
        // O token será enviado junto com a nova senha para validação no backend.
    ?>
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
        // Mensagens de erro/sucesso para redefinição de senha
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success_reset') {
                echo '<p style="color: green;">Sua senha foi redefinida com sucesso! Você pode fazer login agora.</p>';
            } elseif ($_GET['status'] == 'error_reset' && isset($_GET['message'])) {
                echo '<p style="color: red;">Erro na redefinição: ' . htmlspecialchars($_GET['message']) . '</p>';
            }
        }
    }
    ?>
  </div>
</body>
</html>
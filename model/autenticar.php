<?php
// Inicia a sessão
session_start();

// Inclui a conexão com o banco de dados
require_once 'conexao.php';

// Inclui o script para envio de e-mails com PHPMailer
require_once 'send_email.php';

// Função para gerar um token seguro
function generateToken($length = 64) {
    return bin2hex(random_bytes($length / 2));
}

// --- LÓGICA DE SOLICITAÇÃO DE REDEFINIÇÃO DE SENHA ---
if (isset($_POST['solicitar_redefinicao'])) {
    // Captura a matrícula ou e-mail enviado pelo formulário
    $matricula_ou_email = $_POST['matricula_ou_email'] ?? '';

    // Se o campo estiver vazio, redireciona com mensagem de erro
    if (empty($matricula_ou_email)) {
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=error&message=" . urlencode("Por favor, informe sua matrícula ou e-mail."));
        exit();
    }

    // Consulta o usuário no banco por matrícula ou e-mail
    $stmt = $conexao->prepare("SELECT id, email, nome FROM usuarios WHERE matricula = ? OR email = ?");
    $stmt->bind_param("ss", $matricula_ou_email, $matricula_ou_email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Se o usuário for encontrado
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $user_id = $usuario['id'];
        $user_email = $usuario['email'];
        $user_nome = $usuario['nome'];

        // Gera token e define o tempo de expiração (1 hora)
        $token = generateToken();
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Atualiza o token no banco de dados
        $update_stmt = $conexao->prepare("UPDATE usuarios SET reset_token = ?, reset_token_expires_at = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $token, $expires_at, $user_id);

        if ($update_stmt->execute()) {
            // Monta o link de redefinição com o token
            $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/VIEW/view_troca_senha/troca_senha.php?token=" . $token;

            // Mensagem do e-mail
            $assunto = "Redefinição de Senha - SUAC";
            $mensagem = "Olá " . $user_nome . ",\n\nVocê solicitou a redefinição de senha para sua conta SUAC. Clique no link abaixo para redefinir sua senha:\n\n";
            $mensagem .= '<a href="' . $reset_link . '">' . $reset_link . '</a>' . "\n\n";
            $mensagem .= "Este link expirará em 1 hora.\n\nSe você não solicitou isso, ignore este e-mail.\n\nAtenciosamente,\nEquipe SUAC";

            // Envia o e-mail com o link de redefinição
            if (sendEmail($user_email, $user_nome, $assunto, $mensagem)) {
                header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=success");
                exit();
            } else {
                error_log("Falha ao enviar e-mail de redefinição para: " . $user_email);
                header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=error&message=" . urlencode("Erro ao enviar e-mail. Tente novamente mais tarde."));
                exit();
            }
        } else {
            error_log("Erro ao salvar token para o usuário ID: " . $user_id);
            header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=error&message=" . urlencode("Erro interno. Tente novamente."));
            exit();
        }
        $update_stmt->close();
    } else {
        // Usuário não encontrado, mas redireciona como se tivesse funcionado (segurança)
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=success");
        exit();
    }

    $stmt->close();
    $conexao->close();
    exit();
}

// --- LÓGICA DE REDEFINIÇÃO DE SENHA COM TOKEN ---
if (isset($_POST['redefinir_senha'])) {
    // Recebe os dados do formulário
    $token = $_POST['token'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar_nova_senha = $_POST['confirmar_nova_senha'] ?? '';

    // Verifica se todos os campos foram preenchidos
    if (empty($token) || empty($nova_senha) || empty($confirmar_nova_senha)) {
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?token=$token&status=error_reset&message=" . urlencode("Todos os campos são obrigatórios."));
        exit();
    }

    // Verifica se a senha e a confirmação são iguais
    if ($nova_senha !== $confirmar_nova_senha) {
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?token=$token&status=error_reset&message=" . urlencode("A nova senha e a confirmação não coincidem."));
        exit();
    }

    // Valida o tamanho da nova senha
    if (strlen($nova_senha) < 6) {
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?token=$token&status=error_reset&message=" . urlencode("A nova senha deve ter no mínimo 8 caracteres."));
        exit();
    }

    // Verifica se o token é válido e ainda está no prazo
    $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE reset_token = ? AND reset_token_expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $user_id = $usuario['id'];

        // Criptografa a nova senha
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

        // Atualiza a senha e remove o token
        $update_stmt = $conexao->prepare("UPDATE usuarios SET senha = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE id = ?");
        $update_stmt->bind_param("si", $nova_senha_hash, $user_id);

        if ($update_stmt->execute()) {
            header("Location: ../VIEW/VIEW_LOGIN/view_login.php?status=success_reset");
            exit();
        } else {
            error_log("Erro ao atualizar senha para usuário ID: " . $user_id);
            header("Location: ../VIEW/view_troca_senha/troca_senha.php?token=$token&status=error_reset&message=" . urlencode("Erro ao redefinir a senha."));
            exit();
        }
        $update_stmt->close();
    } else {
        // Token inválido ou expirado
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=error_reset&message=" . urlencode("Link de redefinição inválido ou expirado."));
        exit();
    }

    $stmt->close();
    $conexao->close();
    exit();
}

// --- LÓGICA DE LOGIN ---
$matricula = $_POST['matricula'] ?? '';
$senha_digitada = $_POST['senha'] ?? '';

// Verifica se os campos de login foram preenchidos
if (!empty($matricula) && !empty($senha_digitada)) {
    // Busca o usuário pela matrícula
    $stmt = $conexao->prepare("SELECT id, matricula, nome, email, senha, tipo, departamento, curso FROM usuarios WHERE matricula = ?");
    $stmt->bind_param("s", $matricula);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $senha_hash_do_banco = $usuario['senha'];

        // Verifica se a senha digitada está correta
        if (password_verify($senha_digitada, $senha_hash_do_banco)) {
            // Login bem-sucedido: salva os dados do usuário na sessão
            $_SESSION['usuario'] = $usuario;
            header("Location: ../VIEW/VIEW_PROJETO/view_projeto.php");
            exit;
        } else {
            // Senha incorreta
            echo "<script>
                    alert('Matrícula ou senha incorretos!');
                    window.location.href = '../VIEW/VIEW_LOGIN/view_login.php';
                  </script>";
        }
    } else {
        // Usuário não encontrado
        echo "<script>
                alert('Matrícula ou senha incorretos!');
                window.location.href = '../VIEW/VIEW_LOGIN/view_login.php';
              </script>";
    }
}
?>

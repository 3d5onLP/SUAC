<?php
// Inicio / retomada da sessão
session_start();
require_once 'conexao.php'; // Inclui a conexão com o banco de dados
require_once 'send_email.php'; // Inclui o arquivo PHPMailer helper

// Função para gerar um token seguro
function generateToken($length = 64) {
    return bin2hex(random_bytes($length / 2));
}

// --- LÓGICA DE SOLICITAÇÃO DE REDEFINIÇÃO DE SENHA ---
if (isset($_POST['solicitar_redefinicao'])) {
    $matricula_ou_email = $_POST['matricula_ou_email'] ?? '';

    if (empty($matricula_ou_email)) {
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=error&message=" . urlencode("Por favor, informe sua matrícula ou e-mail."));
        exit();
    }

    // Busca o usuário pela matrícula OU e-mail
    $stmt = $conexao->prepare("SELECT id, email, nome FROM usuarios WHERE matricula = ? OR email = ?"); // Adicionei 'nome' para usar no sendEmail
    $stmt->bind_param("ss", $matricula_ou_email, $matricula_ou_email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $user_id = $usuario['id'];
        $user_email = $usuario['email'];
        $user_nome = $usuario['nome']; // Obtendo o nome do usuário

        // Gerar um token e definir o tempo de expiração
        $token = generateToken();
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Salvar o token e a data de expiração no banco de dados
        $update_stmt = $conexao->prepare("UPDATE usuarios SET reset_token = ?, reset_token_expires_at = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $token, $expires_at, $user_id);
        
        if ($update_stmt->execute()) {
            // --- ENVIAR E-MAIL COM O LINK DE REDEFINIÇÃO USANDO PHPMailer ---
            
            // O caminho correto para o link de redefinição.
            // Se o seu projeto estiver em um subdiretório (ex: "http://localhost/suac/"),
            // você precisará ajustar para algo como "/suac/VIEW/view_troca_senha/troca_senha.php"
            $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/VIEW/view_troca_senha/troca_senha.php?token=" . $token; 
            
            $assunto = "Redefinição de Senha - SUAC";
            $mensagem = "Olá " . $user_nome . ",\n\nVocê solicitou a redefinição de senha para sua conta SUAC. Clique no link abaixo para redefinir sua senha:\n\n";
            $mensagem .= '<a href="' . $reset_link . '">' . $reset_link . '</a>' . "\n\n"; // Link em HTML
            $mensagem .= "Este link expirará em 1 hora.\n\nSe você não solicitou isso, por favor, ignore este e-mail.\n\nAtenciosamente,\nEquipe SUAC";

            // Chamar a função sendEmail (do send_email.php)
            if (sendEmail($user_email, $user_nome, $assunto, $mensagem)) { 
                header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=success");
                exit();
            } else {
                error_log("Falha ao enviar e-mail de redefinição para: " . $user_email);
                header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=error&message=" . urlencode("Erro ao enviar e-mail. Tente novamente mais tarde."));
                exit();
            }
        } else {
            error_log("Falha ao salvar token de redefinição para user_id: " . $user_id . " Erro: " . $conexao->error);
            header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=error&message=" . urlencode("Erro interno. Tente novamente."));
            exit();
        }
        $update_stmt->close();
    } else {
        // Usuário não encontrado, mas por segurança, damos uma resposta genérica para não vazar informações
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?status=success"); 
        exit();
    }
    $stmt->close();
    $conexao->close();
    exit(); 
}

// RESTANTE DO CÓDIGO (LÓGICA DE REDEFINIÇÃO DE SENHA E LÓGICA DE LOGIN) ABAIXO...
// (Não alterado nesta correção)

// --- LÓGICA DE REDEFINIÇÃO DE SENHA (USANDO TOKEN) ---
if (isset($_POST['redefinir_senha'])) {
    $token = $_POST['token'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar_nova_senha = $_POST['confirmar_nova_senha'] ?? '';

    if (empty($token) || empty($nova_senha) || empty($confirmar_nova_senha)) {
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?token=" . urlencode($token) . "&status=error_reset&message=" . urlencode("Todos os campos são obrigatórios."));
        exit();
    }

    if ($nova_senha !== $confirmar_nova_senha) {
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?token=" . urlencode($token) . "&status=error_reset&message=" . urlencode("A nova senha e a confirmação não coincidem."));
        exit();
    }

    // Adicione validações de complexidade para a nova senha
    if (strlen($nova_senha) < 8) { // Mantenha 8 caracteres como mínimo
        header("Location: ../VIEW/view_troca_senha/troca_senha.php?token=" . urlencode($token) . "&status=error_reset&message=" . urlencode("A nova senha deve ter no mínimo 8 caracteres."));
        exit();
    }

    // Validar o token no banco de dados
    $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE reset_token = ? AND reset_token_expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $user_id = $usuario['id'];

        // Gerar o hash da nova senha
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

        // Atualizar a senha e invalidar o token
        $update_stmt = $conexao->prepare("UPDATE usuarios SET senha = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE id = ?");
        $update_stmt->bind_param("si", $nova_senha_hash, $user_id);

        if ($update_stmt->execute()) {
            header("Location: ../VIEW/VIEW_LOGIN/view_login.php?status=success_reset"); // Redireciona para o login com sucesso
            exit();
        } else {
            error_log("Falha ao atualizar senha para user_id: " . $user_id . " Erro: " . $conexao->error);
            header("Location: ../VIEW/view_troca_senha/troca_senha.php?token=" . urlencode($token) . "&status=error_reset&message=" . urlencode("Erro ao redefinir a senha."));
            exit();
        }
        $update_stmt->close();
    } else {
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

// Verifica se os parâmetros de login estão presentes
if (!empty($matricula) && !empty($senha_digitada)) {
    $stmt = $conexao->prepare("SELECT id, matricula, nome, email, senha, tipo, departamento, curso FROM usuarios WHERE matricula = ?");
    $stmt->bind_param("s", $matricula);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $senha_hash_do_banco = $usuario['senha'];

        if (password_verify($senha_digitada, $senha_hash_do_banco)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: ../VIEW/VIEW_PROJETO/view_projeto.php");
            exit;
        } else {
            echo "<script>
                    alert('Matrícula ou senha incorretos!');
                    window.location.href = '../VIEW/VIEW_LOGIN/view_login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Matrícula ou senha incorretos!');
                window.location.href = '../VIEW/VIEW_LOGIN/view_login.php';
              </script>";
    }
}
// Não feche a conexão aqui se houver mais código abaixo
// $stmt->close(); 
// $conexao->close();
?>
<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../../model/conexao.php';

// Verifica se o método da requisição é POST (ou seja, se o formulário foi enviado)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe os dados enviados pelo formulário (com fallback para vazio)
    $nome = $_POST['nome'] ?? ''; 
    $matricula = $_POST['matricula'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $email = $_POST['email'] ?? '';
    $curso = $_POST['curso'] ?? '';
    $tipo = $_POST['tipo'] ?? ''; 

    // Cria um array para armazenar mensagens de erro
    $erros = [];

    // Validações dos campos do formulário

    // Verifica se o nome foi preenchido
    if (empty($nome)) {
        $erros[] = "O nome completo é obrigatório.";
    }

    // Verifica se a matrícula foi preenchida
    if (empty($matricula)) {
        $erros[] = "A matrícula é obrigatória.";
    }

    // Verifica se a senha foi preenchida
    if (empty($senha)) {
        $erros[] = "A senha é obrigatória.";
    } 
    // Verifica se a senha tem pelo menos 6 caracteres
    elseif (strlen($senha) < 6) {
        $erros[] = "A senha deve ter pelo menos 6 caracteres.";
    }

    // Verifica se o e-mail foi preenchido e se é válido
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O e-mail é obrigatório e deve ser um formato válido.";
    }

    // Verifica se o tipo de acesso é válido (aluno ou professor)
    if (empty($tipo) || ($tipo != 'aluno' && $tipo != 'professor')) {
        $erros[] = "O tipo de acesso é obrigatório e deve ser 'Aluno' ou 'Professor'.";
    }

    // Se não houve erro até agora, verifica se a matrícula ou e-mail já existem
    if (empty($erros)) {
        $stmt_check = $conexao->prepare("SELECT id FROM usuarios WHERE matricula = ? OR email = ? LIMIT 1");
        $stmt_check->bind_param("ss", $matricula, $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        // Se já existir, adiciona erro
        if ($stmt_check->num_rows > 0) {
            $erros[] = "Matrícula ou e-mail já cadastrados.";
        }
        $stmt_check->close();
    }

    // Se houver erros, mostra todos e link para voltar
    if (!empty($erros)) {
        foreach ($erros as $erro) {
            echo "<p style='color: red;'>Erro: " . $erro . "</p>";
        }
        echo "<p><a href='view_cadastro.html'>Voltar para o cadastro</a></p>";
    } else {
        // Criptografa a senha antes de salvar
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Define um valor padrão para professores (caso precise)
        $departamento = ($tipo === 'professor') ? 'Departamento Padrão' : NULL;

        // Cria a query de inserção no banco
        $sql = "INSERT INTO usuarios (nome, matricula, senha, email, tipo, curso) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexao->prepare($sql);

        // Se a preparação da query funcionar
        if ($stmt) {
            $stmt->bind_param("ssssss", $nome, $matricula, $senha_hash, $email, $tipo, $curso);

            // Executa a inserção e redireciona para o login
            if ($stmt->execute()) {
                header("Location: ../VIEW_LOGIN/view_login.php"); 
                exit(); 
            } else {
                echo "<p style='color: red;'>Erro ao cadastrar usuário: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color: red;'>Erro na preparação da query: " . $conexao->error . "</p>";
        }
    }

    // Fecha a conexão com o banco
    $conexao->close();

} else {
    // Se não for POST, redireciona para o formulário de cadastro
    header("Location: view_cadastro.html");
    exit();
}
?>

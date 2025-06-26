<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../../model/conexao.php'; // Certifique-se de que o caminho está correto

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Recebe os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $matricula = $_POST['matricula'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $email = $_POST['email'] ?? '';
    $curso = $_POST['curso'] ?? '';
    $tipo = $_POST['tipo'] ?? ''; // <--- Recebendo o valor do select com name="tipo"

    // 2. Validação básica dos dados
    $erros = [];

    if (empty($nome)) {
        $erros[] = "O nome completo é obrigatório.";
    }
    if (empty($matricula)) {
        $erros[] = "A matrícula é obrigatória.";
    }
    if (empty($senha)) {
        $erros[] = "A senha é obrigatória.";
    } elseif (strlen($senha) < 6) {
        $erros[] = "A senha deve ter pelo menos 6 caracteres.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O e-mail é obrigatório e deve ser um formato válido.";
    }
    // Esta validação irá funcionar corretamente se o HTML enviar os valores "aluno" ou "professor"
    if (empty($tipo) || ($tipo != 'aluno' && $tipo != 'professor')) {
        $erros[] = "O tipo de acesso é obrigatório e deve ser 'Aluno' ou 'Professor'.";
    }

    // 3. Verifica se a matrícula ou e-mail já existem no banco de dados
    if (empty($erros)) {
        $stmt_check = $conexao->prepare("SELECT id FROM usuarios WHERE matricula = ? OR email = ? LIMIT 1");
        $stmt_check->bind_param("ss", $matricula, $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $erros[] = "Matrícula ou e-mail já cadastrados.";
        }
        $stmt_check->close();
    }

    // Se houver erros, exibe-os
    if (!empty($erros)) {
        foreach ($erros as $erro) {
            echo "<p style='color: red;'>Erro: " . $erro . "</p>";
        }
        echo "<p><a href='view_cadastro.html'>Voltar para o cadastro</a></p>";
    } else {
        // 4. Criptografa a senha antes de armazenar no banco de dados
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // O campo 'departamento' não está no seu formulário, mas está na sua tabela.
        // Se 'tipo' for 'professor', você pode definir um departamento padrão, caso contrário, NULL.
        // A sua query SQL e bind_param precisam incluir 'departamento' se for inserido.
        // No SQL que você me enviou do processa_cadastro.php, 'departamento' não está na lista de colunas, mas estava em versões anteriores.
        // Vou assumir que o 'departamento' não será inserido a menos que o formulário o envie, ou que você tem uma lógica específica para ele.
        // Se precisar inserir 'departamento', a query e o bind_param precisam ser ajustados.
        
        // Exemplo: Se for para inserir departamento quando 'professor':
        $departamento = ($tipo === 'professor') ? 'Departamento Padrão' : NULL; // Defina um valor padrão ou NULL

        // A query SQL DEVE corresponder EXATAMENTE ao número de colunas e ao tipo de parâmetros.
        // Sua query atual: INSERT INTO usuarios (nome, matricula, senha, email, tipo, curso) VALUES (?, ?, ?, ?, ?, ?);
        // Não inclui 'departamento'. Se quiser incluir, mude a query e o bind_param.
        $sql = "INSERT INTO usuarios (nome, matricula, senha, email, tipo, curso) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            // Se 'departamento' for incluído, o bind_param seria: "sssssss", $nome, $matricula, $senha_hash, $email, $tipo, $departamento, $curso
            // Como a query atual não o inclui, mantém 6 's'.
            $stmt->bind_param("ssssss", $nome, $matricula, $senha_hash, $email, $tipo, $curso);

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

    $conexao->close();

} else {
    header("Location: view_cadastro.html");
    exit();
}
?>
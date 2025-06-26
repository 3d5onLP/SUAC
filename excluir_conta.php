<?php
session_start();
require_once 'model/conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: /VIEW//VIEW_LOGIN/view_login.php');
    exit;
}

$usuario_id = $_SESSION['usuario']['id'];

try {
    // Prepara a query SQL para excluir o usuário
    $stmt = $conexao->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $usuario_id); // "i" indica que o parâmetro é um inteiro

    // Executa a query
    if ($stmt->execute()) {
        // Exclusão bem-sucedida, destrói a sessão e redireciona para a página de login
        session_destroy();
        echo "<script>
                alert('Sua conta foi excluída com sucesso.');
                window.location.href = 'VIEW//VIEW_LOGIN/view_login.php';
              </script>";
        exit;
    } else {
        // Erro ao executar a exclusão
        echo "<script>
                alert('Erro ao excluir a conta. Por favor, tente novamente.');
                window.location.href = 'VIEW/VIEW_PROJETO/view_projeto.php';
              </script>";
        exit;
    }

    $stmt->close();
} catch (Exception $e) {
    // Captura exceções para erros de banco de dados
    echo "<script>
            alert('Um erro inesperado ocorreu: " . $e->getMessage() . "');
            window.location.href = '/VIEW/VIEW_PROJETO/view_projeto.php';
          </script>";
    exit;
} finally {
    $conexao->close(); // Garante que a conexão com o banco de dados seja fechada
}
?>
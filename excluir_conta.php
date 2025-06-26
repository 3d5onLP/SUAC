<?php
// Inicia a sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once 'model/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: /VIEW//VIEW_LOGIN/view_login.php');
    exit;
}

// Pega o ID do usuário logado
$usuario_id = $_SESSION['usuario']['id'];

try {
    // Prepara a SQL para deletar o usuário pelo ID
    $stmt = $conexao->prepare("DELETE FROM usuarios WHERE id = ?");
    
    // Define o valor do ID como inteiro
    $stmt->bind_param("i", $usuario_id);

    // Executa a exclusão
    if ($stmt->execute()) {
        // Se der certo, finaliza a sessão e redireciona
        session_destroy();
        echo "<script>
                alert('Sua conta foi excluída com sucesso.');
                window.location.href = 'VIEW//VIEW_LOGIN/view_login.php';
              </script>";
        exit;
    } else {
        // Se der erro, mostra mensagem e volta para a área logada
        echo "<script>
                alert('Erro ao excluir a conta. Por favor, tente novamente.');
                window.location.href = 'VIEW/VIEW_PROJETO/view_projeto.php';
              </script>";
        exit;
    }

    // Fecha a preparação da query
    $stmt->close();

} catch (Exception $e) {
    // Se houver erro inesperado, exibe mensagem e redireciona
    echo "<script>
            alert('Um erro inesperado ocorreu: " . $e->getMessage() . "');
            window.location.href = '/VIEW/VIEW_PROJETO/view_projeto.php';
          </script>";
    exit;
} finally {
    // Fecha a conexão com o banco de dados
    $conexao->close();
}
?>

<?php
// Inicio / retomada da sessão
session_start();
require_once 'conexao.php';

// Verifica se o campos de matrícula e senha foram enviados via POST
$matricula = $_POST['matricula'] ?? '';
$senha = $_POST['senha'] ?? '';

// Consulta SQL
$stmt = $conexao->prepare("SELECT * FROM usuarios WHERE matricula = ? AND senha = ?");
$stmt->bind_param("ss", $matricula, $senha);
$stmt->execute();
$resultado = $stmt->get_result();

// Verifica se o login foi bem-sucedido e, se sim, salva os dados do usuário na sessão
if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $_SESSION['usuario'] = $usuario;

    // Redireciona para a página principal
    header("Location: ../VIEW/VIEW_PROJETO/view_projeto.php");
    exit;
} else {
    // Volta para o login com mensagem de erro
    echo "<script>
            alert('Matrícula ou senha incorretos!');
            window.location.href = '../VIEW/VIEW_LOGIN/view_login.php';
          </script>";
}
?>

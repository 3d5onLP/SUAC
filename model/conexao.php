<?php
// conexao.php
$host = 'db';
$usuario = 'usuario';
$senha = 'senha';
$banco = 'suac_db';

$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verifica erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
<?php

// conexao.php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'suac_db';

$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verifica erro na conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error); 
}
?>
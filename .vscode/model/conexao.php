<?php
//Requisitos para a conexão com o banco de dados...
$host = "localhost";
$banco = "suac_db";
$usuario = "root";
$senha = "";

try {
    //Acessando o banco...
    $conn = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida!";

    //Falha..,
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}
?>

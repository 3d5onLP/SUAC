<?php
session_start();

// Destroi todas as variáveis de sessão
$_SESSION = array();

// Destroi a sessão
session_destroy();

// --- Adicionar headers para prevenir cache do navegador ---
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Uma data no passado


header('Location: ../index.php'); // Verifique se este é o caminho correto para sua tela de login
exit;
?>  
<?php
// Inicia/retoma a sessão se ainda não foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- Adicionar headers para prevenir cache do navegador ---
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Uma data no passado

// Verificação de sessão
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header('Location: ../VIEW_LOGIN/view_login.php');
    exit;
}
?>
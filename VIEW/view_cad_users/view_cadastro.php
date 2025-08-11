<?php
  
?>

<!DOCTYPE html>
<html lang="pt-BR">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUAC</title>
    <link rel="icon" href="../icon/logo.png" type="image/png">
    <link rel="stylesheet" href="../../global_suac.css">
    <link rel="stylesheet" href="../components/btn_sent.css">
    <link rel="stylesheet" href="../components/input_forms.css">
    <link rel="stylesheet" href="view_cadastro.css">
  </head>

  <body>
    <!-- Corpo da página -->

    <!-- Container que centraliza e organiza o conteúdo -->
    <div class="container">

      <!-- Título principal da página -->
      <h1 class="title-text">Cadastro de Usuários</h1>

      <!-- Início do formulário de cadastro -->
      <form action="processa_cadastro.php" method="POST">
        
        <!-- Rótulo para o campo nome -->
        <p class="cad-text">Nome Completo:</p>

        <!-- Campo de entrada de texto para o nome -->
        <input class="input-form" type="text" name="nome" placeholder="Digite seu nome completo..." aria-label="Nome Completo" required>

        <!-- Rótulo para o campo matrícula -->
        <p class="cad-text">Matrícula:</p>

        <!-- Campo de entrada para matrícula -->
        <input class="input-form" type="text" name="matricula" placeholder="Digite sua matrícula..." aria-label="Matrícula" required>

        <!-- Rótulo para o campo senha -->
        <p class="cad-text">Senha:</p>

        <!-- Campo de senha (com caracteres ocultos) -->
        <input class="input-form" type="password" name="senha" placeholder="Digite a senha que deseja..." aria-label="Senha" required>

        <!-- Rótulo para o campo e-mail -->
        <p class="cad-text">E-mail:</p>

        <!-- Campo de entrada do tipo e-mail -->
        <input class="input-form" type="email" name="email" placeholder="Digite seu e-mail..." aria-label="E-mail" required>

        <!-- Rótulo para o campo curso -->
        <p class="cad-text">Curso:</p>

        <!-- Campo opcional para informar o curso -->
        <input class="input-form" type="text" name="curso" placeholder="Digite seu curso..." aria-label="Curso">

        <!-- Rótulo para o select de tipo de acesso -->
        <label class="cad-text" for="tipo_acesso_select">Tipo de Acesso:</label>

        <!-- Menu suspenso (dropdown) para escolher o tipo -->
        <select class="select-container" id="tipo_acesso_select" name="tipo" required>
          <option value="">Selecione</option>
          <option value="aluno">Aluno</option>
          <option value="professor">Professor</option>
        </select>

        <!-- Container do botão de envio -->
        <div class="submit">

          <!-- Botão que envia o formulário -->
          <button class="btn-send" type="submit">Enviar</button>

        </div>

      </form>
      <!-- Fim do formulário -->

    </div>
    <!-- Fim do container -->

  </body>
</html>

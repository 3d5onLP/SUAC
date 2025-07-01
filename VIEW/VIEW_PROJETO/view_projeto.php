<?php
  require_once '../../model/finish_session.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SUAC</title>
  <link rel="icon" href="../icon/logo.png" type="image/png">
  <link rel="stylesheet" href="../components/css/navbar.css">
  <link rel="stylesheet" href="view_projeto.css">
</head>

<body>
  <?php require_once '../components/php/navbar.php';?>

  <!--Seleções de Projetos-->
  <main class="container">
    <!--Seleção 1-->
    <div class="card">
      <img src="../icon/iamgem-de-AI.avif" alt="">
      <div class="info">
        <p>Progressão AI</p>
        <p class="font-info">Área: Tecnologia </p>
        <p class="font-info">Orientador: Edson Lopes</p>
      </div>
      <div class="more-info">
        <p> Uma pequena descrição sobre o projeto</p>
        <a href="pagina-mountain.html" class="info-link">Saiba Mais</a>
        <a href="arquivos/mountain.pdf" download class="download-link">Baixar PDF</a>
      </div>
    </div>
    
    <!--Seleção 2-->
    <div class="card">
      <img src="../icon/banco-de-dados.png" alt="">
      <div class="info">
        <p>Banco de dados com Integração a AI</p>
        <p class="font-info">Área: Tecnologia </p>
        <p class="font-info">Orientador: Igor Gabrielw</p>
      </div>
      <div class="more-info">
        <p>Uma pequena descrição sobre o projeto</p>
        <a href="pagina-beach.html" class="info-link">Saiba Mais</a>
        <a href="arquivos/beach.pdf" download class="download-link">Baixar PDF</a>
      </div>
    </div>

    <!--Seleção 3-->
    <div class="card">
      <img src="../icon/imagem-pedag.jpg" alt="">
      <div class="info">
        <p>Não ao Racismo</p>
        <p class="font-info">Área: Educação </p>
        <p class="font-info">Orientador: Lucia Martins</p>
      </div>
      <div class="more-info">
        <p>Uma pequena descrição sobre o projeto</p>
        <a href="pagina-desert.html" class="info-link">Saiba Mais</a>
        <a href="arquivos/desert.pdf" download class="download-link">Baixar PDF</a>
      </div>
    </div>

    <!--Seleção 4-->
    <div class="card">
      <img src="../icon/imagem-agro.jpeg" alt="">
      <div class="info">
        <p>Progressão de Safra</p>
        <p class="font-info">Área: Agronomia</p>
        <p class="font-info">Orientador: Lucas Mota</p>
      </div>
      <div class="more-info">
        <p>Uma pequena descrição sobre o projeto</p>
        <a href="pagina-galaxy.html" class="info-link">Saiba Mais</a>
        <a href="arquivos/galaxy.pdf" download class="download-link">Baixar PDF</a>
      </div>
    </div>

  </main>

  <!-- Conexão com o JavaScript -->
  <script>feather.replace();</script>
  <script src="view_projeto.js"></script>
  <script src="../components/js/navbar.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script>
      document.getElementById('excluirContaBtn').addEventListener('click', function(event) {
          event.preventDefault(); // Impede o comportamento padrão do link

          // Exibe a caixa de diálogo de confirmação
          if (confirm("Tem certeza que deseja excluir sua conta? Esta ação é irreversível.")) {
              // Se o usuário confirmar, redireciona para o script de exclusão
              window.location.href = '../../excluir_conta.php';
          }
      });
  </script>

</body>
</html>
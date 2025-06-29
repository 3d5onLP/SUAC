<?php
  require_once '../../model/finish_session.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SUAC</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="../icon/logo.png" type="image/png"> 
  <link rel="stylesheet" href="../components/css/navbar.css">
  <link rel="stylesheet" href="view_aluno.css">
</head>

<body>
  <?php require_once '../components/php/navbar.php';?>

  <!-- Cards de Alunos -->
  <main class="container">
    <div class="wrapper">
      <div class="card">
        <div class="poster"><img src="../icon/poster1-img.jpg"alt="Location Unknown"></div>
        <div class="details">
          <h1>Igor Gabriel</h1>
          <h2>Analise e desenvolvimento de Sistemas</h2>
          <div class="rating">
            <!-- Estrelas de avaliação -->
            <div class="stars" data-rating="4">
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="far fa-star star"></i>
            </div>
            <span>4/5</span>
          </div>
          <p class="desc">
            Indisponivel para projetos
          </p>
        </div>
      </div>

      <div class="card">
        <div class="poster"><img src="../icon/poster1-img.jpg" alt="Location Unknown"></div>
        <div class="details">
          <h1>Iago Bezerra</h1>
          <h2>Analise e desenvolvimento de Sistemas</h2>
          <div class="rating">
            <!-- Estrelas de avaliação -->
            <div class="stars" data-rating="4">
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="far fa-star star"></i>
            </div>
            <span>4/5</span>
          </div>
          <p class="desc">
            Indisponivel para projetos
          </p>
        </div>
      </div>

      <div class="card">
        <div class="poster"><img src="../icon/poster1-img.jpg" alt="Location Unknown"></div>
        <div class="details">
          <h1>Vitor Marques</h1>
          <h2>Analise e desenvolvimento de Sistemas</h2>
          <div class="rating">
            <!-- Estrelas de avaliação -->
            <div class="stars" data-rating="3">
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="far fa-star star"></i>
              <i class="far fa-star star"></i>
            </div>
            <span>3/5</span>
          </div>
          <p class="desc">
            Disponivel para projetos
          </p>
        </div>
      </div>

      <div class="card">
        <div class="poster"><img src="../icon/poster1-img.jpg" alt="Location Unknown"></div>
        <div class="details">
          <h1>Edson Oliveira</h1>
          <h2>Analise e desenvolvimento de Sistemas</h2>
          <div class="rating">
            <!-- Estrelas de avaliação -->
            <div class="stars" data-rating="5">
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
              <i class="fas fa-star star"></i>
            </div>
            <span>5/5</span>
          </div>
          <p class="desc">
            Disponivel para projetos
          </p>
        </div>
      </div>

    </div>
  </main>

  <script>
    feather.replace();
  </script>
  <script src="view_aluno.js"></script>
  <script src="../components/js/navbar.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>

</body>
</html>


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
  <link rel="stylesheet" href="view_professor.css">
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
  <div class="nav-header">

    <div class="nav-left">
      <div class="logo">
        <img src="../icon/logo.png" alt="Logo CIENTIF">
        <h1 class="header-logo">SUAC</h1>
      </div>
    </div>

    <div class="nav-center">
      <form class="d-flex">
        <input class="btn-buscar" type="search" placeholder="Buscar alunos..." aria-label="Buscar">
        <button class="btn-green" type="submit">Buscar</button>
      </form>
    </div>

    <button id="fab-menu" class="fab-bottom-left">☰</button>

    <div class="nav-right">
      <ul class="nav-list">
        <li>
          <a href="../VIEW_PROJETO/view_projeto.php" class="tooltip-container">
            <img src="../icon/pesquisa-projeto.png" alt="Proje" class="tooltip-img">
            <span class="tooltip-text">Projetos</span>
          </a>
        </li>
        <li>
          <a href="../VIEW_EDITAL/view_edital.html" target="_blank" class="tooltip-container">
            <img src="../icon/pesquisa-edital.png" alt="Edital" class="tooltip-img">
            <span class="tooltip-text">Edital</span>
          </a>
        </li>
        <li>
          <a href="../VIEW_ALUNO/view_aluno.php" class="tooltip-container">
            <img src="../icon/aluno-icon.png" alt="Alunos" class="tooltip-img">
            <span class="tooltip-text">Alunos</span>
          </a>
        </li>
        <li>
          <div class="profile-menu">
            <img src="../icon/foto.perfil.jpg" alt="Profile" class="profile-img" id="profileToggle">
            <div class="dropdown" id="dropdownMenu">
              <h4>Edson Oliveira</h4>
              <p>Análise e Desenvolvimento de Sistema</p>
              <ul>
                <li><span>👤</span> Meu Perfil</li>
                <li><span>✏️</span> Editar Perfil</li>
                <li><a href="../VIEW_DUVIDAS/view_duvidas.html"><span>🛠️</span> Duvidas</a></li>
                <li><a href="../logout.php"><span>🔓</span> Deslogar</a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>

    </div>
  </div>

  <main class="container">
    <div class="wrapper">
      <div class="card">
        <div class="poster"><img src="../../poster1-img.jpg" alt="Location Unknown"></div>
        <div class="details">
          <h1>Igor Gabriel</h1>
          <h2>Analise e desenvolvimento de Sistemas</h2>
          <div class="rating">
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
        <div class="poster"><img src="../../poster1-img.jpg" alt="Location Unknown"></div>
        <div class="details">
          <h1>Iago Bezerra</h1>
          <h2>Analise e desenvolvimento de Sistemas</h2>
          <div class="rating">
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
        <div class="poster"><img src="../../poster1-img.jpg" alt="Location Unknown"></div>
        <div class="details">
          <h1>Vitor Marques</h1>
          <h2>Analise e desenvolvimento de Sistemas</h2>
          <div class="rating">
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
        <div class="poster"><img src="../../poster1-img.jpg" alt="Location Unknown"></div>
        <div class="details">
          <h1>Edson Oliveira</h1>
          <h2>Analise e desenvolvimento de Sistemas</h2>
          <div class="rating">
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

</body>
</html>
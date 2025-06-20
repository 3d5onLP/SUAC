<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SUAC</title>
  <link rel="icon" href="../icon/logo.png" type="image/png">
  <link rel="stylesheet" href="view_projeto.css">
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
  <div class="nav-header">
    <div class="logo">
      <img src="../icon/logo.png" alt="Logo CIENTIF">
      <h1 class="header-logo">SUAC</h1>
    </div>
    <!--Menu para telas grandes-->
    <nav class="nav" id="nav-menu">
      <i data-feather="x" class="close" id="close-menu"></i>
      <ul class="nav-list">
        <!-- li do botão do edital -->
        <li>
          <a href="../VIEW_EDITAL/view_edital.html" target="_blank" class="tooltip-container">
            <img src="../icon/pesquisa-edital.png" alt="Edital" class="tooltip-img">
            <span class="tooltip-text">Edital</span>
          </a>
        </li>
        <!-- li do botão de Professores -->
        <li>
          <a href="../VIEW_PROFESSOR/view_professor.html" class="tooltip-container">
            <img src="../icon/professor-icon.png" alt="Professores" class="tooltip-img">
            <span class="tooltip-text">Professores</span>
          </a>
        </li>
        <!-- li do botão de Alunos -->
        <li>
          <a href="../VIEW_ALUNO/view_aluno.php" class="tooltip-container">
            <img src="../icon/aluno-icon.png" alt="Alunos" class="tooltip-img">
            <span class="tooltip-text">Alunos</span>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Perfil do usuário -->
    <div class="profile-menu">
      <img src="../icon/foto.perfil.jpg" alt="Profile" class="profile-img" id="profileToggle">
      <div class="dropdown" id="dropdownMenu">
        <h4>Edson Oliveira</h4>
        <p>Análise e Desenvolvimento de Sistema</p>
        <ul>
          <li><span>👤</span>Meu Perfil</li>
          <li><span>✏️</span>Editar Perfil</li>
          <li><a href="../VIEW_DUVIDAS/view_duvidas.html"><span>🛠️</span> Duvidas</a></li>
          <li><a href="../logout.php"><span>🔓</span href="../logout.php"> Deslogar</a></li>
        </ul>
      </div>
    </div>

    <i data-feather="menu" class="toggle" id="toggle-menu"></i>
  </div>

  <!--Seleção de Busca de Projetos-->
  <header class="buscar">
    <form class="d-flex">
      <input class="btn-buscar" type="search" placeholder="Buscar projeto..." aria-label="Buscar">
      <button class="btn-green" type="submit">Buscar</button>
    </form>
  </header>

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
  <script>
    feather.replace();
  </script>
  <script src="view_projeto.js"></script>

</body>

</html>
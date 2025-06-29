<?php

$nome_usuario = $_SESSION['usuario']['nome'] ?? 'Visitante';
$curso_usuario = $_SESSION['usuario']['curso'] ?? 'Não informado'; 
?>

<div class="nav-header">
  <div class="nav-left">
    <div class="logo">
      <h1 class="header-logo">SUAC</h1>
    </div>
  </div>

  <div class="nav-center">
    <form class="d-flex" action="#" method="get">
      <input class="btn-buscar" type="search" placeholder="Buscar..." aria-label="Buscar">
      <button class="btn-green" type="submit">Buscar</button>
    </form>
  </div>

  <button id="fab-menu" class="fab-bottom-left">☰</button>

  <div class="nav-right">
    <ul class="nav-list">
      <li>
        <a href="../VIEW_PROJETO/view_projeto.php" class="tooltip-container">
          <img src="../icon/pesquisa-projeto.png" alt="Projetos" class="tooltip-img">
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
        <a href="../VIEW_PROFESSOR/view_professor.html" class="tooltip-container">
          <img src="../icon/professor-icon.png" alt="Professores" class="tooltip-img">
          <span class="tooltip-text">Professores</span>
        </a>
      </li>
      <li>
        <div class="profile-menu">
          <img src="../icon/foto.perfil.jpg" alt="Profile" class="profile-img" id="profileToggle">
          <div class="dropdown" id="dropdownMenu">
            <h4><?php echo htmlspecialchars($nome_usuario); ?></h4>
            <p><?php echo htmlspecialchars($curso_usuario); ?></p>
            <ul>
              <li><span>👤</span> Meu Perfil</li>
              <li><span>✏️</span> Editar Perfil</li>
              <li><a href="../VIEW_DUVIDAS/view_duvidas.html"><span>🛠️</span> Dúvidas</a></li>
              <li><a href="../../model/logout.php"><span>🔓</span> Deslogar</a></li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>

<script>
    // Script para o dropdown do perfil (coloque aqui ou em um arquivo JS separado)
    const profileToggle = document.getElementById('profileToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (profileToggle && dropdownMenu) {
        profileToggle.addEventListener('click', function(event) {
            dropdownMenu.classList.toggle('show');
            event.stopPropagation(); // Evita que o clique se propague para o document
        });

        // Fechar o dropdown se clicar fora dele
        document.addEventListener('click', function(event) {
            if (!dropdownMenu.contains(event.target) && !profileToggle.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }

    // Script para o botão hamburguer (se estiver usando)
    const fabMenu = document.getElementById('fab-menu');
    const navRight = document.querySelector('.nav-right'); // Ou o elemento que contém seu menu responsivo

    if (fabMenu && navRight) {
        fabMenu.addEventListener('click', function() {
            navRight.classList.toggle('active'); // Adicione/remova uma classe 'active' para mostrar/esconder o menu
        });
    }
</script>
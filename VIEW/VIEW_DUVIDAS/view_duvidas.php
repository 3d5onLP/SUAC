<?php
  require_once '../../model/finish_session.php';
?>

// Resto do seu código PHP e HTML da página restrita
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUAC</title>
    <link rel="stylesheet" href="view_duvidas.css" />
    <link rel="icon" href="/VIEW/icon/logo.png" type="image/png" />
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>

<body>
    <div class="nav-header">
        <!-- DIV da logo -->
        <div class="logo">
            <img src="../icon/logo.png" alt="Logo CIENTIF">
            <h1 class="header-logo">SUAC</h1>
        </div>
        <!-- NAV do menu -->
        <nav class="nav" id="nav-menu">
            <i data-feather="x" class="close" id="close-menu"></i>
            <ul class="nav-list">
                <!-- Menu "Projeto" -->
                <li>
                    <a href="../VIEW_PROJETO/view_projeto.html" class="tooltip-container">
                        <img src="../icon/pesquisa-projeto.png" alt="Projeto" class="tooltip-img">
                        <span class="tooltip-text">Projeto</span>
                    </a>
                </li>
                <!-- Menu "Edital" -->
                <li>
                    <a href="../VIEW_EDITAL/view_edital.html" target="_blank"
                        class="tooltip-container">
                        <img src="../icon/pesquisa-edital.png" alt="Edital" class="tooltip-img">
                        <span class="tooltip-text">Edital</span>
                    </a>
                </li>
                <!-- Menu "Professores" -->
                <li>
                    <a href="../VIEW_PROFESSOR/view_professor.html" class="tooltip-container">
                        <img src="../icon/professor-icon.png" alt="Professores" class="tooltip-img">
                        <span class="tooltip-text">Professores</span>
                    </a>
                </li>
                <!-- Menu "Alunos" -->
                <li>
                    <a href="../VIEW_ALUNO/view_aluno.html" class="tooltip-container">
                        <img src="../icon/aluno-icon.png" alt="Alunos" class="tooltip-img">
                        <span class="tooltip-text">Alunos</span>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- Perfil do usuário -->
        <div class="profile-menu">
            <img src="../icon/foto.perfil.jpg" alt="Profile" class="profile-img" id="profileToggle">
            <!-- Dropdown do perfil -->
            <div class="dropdown" id="dropdownMenu">
                <h4>Edson Oliveira</h4>
                <p>Análise e Desenvolvimento de Sistema</p>
                <ul>
                    <li><span>👤</span>Meu Perfil</li>
                    <li><span>✏</span>Editar Perfil</li>
                    <li><a href="../VIEW_DUVIDAS/view_duvidas.html"><span>🛠</span> Duvidas</a></li>
                    <li><a href="../logout.php"><span>🔓</span href="../logout.php"> Deslogar</a></li>
                </ul>
            </div>
        </div>

        <i data-feather="menu" class="toggle" id="toggle-menu"></i>

    </div>

    <!--Div branca do meio FAQs-->
    <div class="duvidas-container container mt-4 p-4 rounded border">
        <!--Cabeçalho da Div .duvidas-container-->
        <header class="mb-4">
            <h2 class="d-inline">FAQs</h2>
        </header>

        <!--DIVs de cada pergunta dentro da DIV principal(.duvidas-container)-->
        <div class="accordion" id="accordionDuvidas">

            <!-- 1° pergunta e resposta -->
            <div class="accordion-item">
                <!-- 1° pergunta -->
                <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#duvida1"
                        aria-expanded="true" aria-controls="duvida1">
                        1. Quem pode cadastrar projetos no sistema?
                    </button>
                </h2>
                <!-- 1° resposta -->
                <div id="duvida1" class="accordion-collapse collapse show" aria-labelledby="hea ding1"
                    data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                        Alunos e professores regularmente matriculados ou vinculados ao Instituto podem cadastrar seus
                        projetos científicos.
                    </div>
                </div>
            </div>

            <!-- 2° pergunta e resposta -->
            <div class="accordion-item">
                <!-- 2° pergunta -->
                <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#duvida2" aria-expanded="false" aria-controls="duvida2">
                        2. Como faço para enviar um novo projeto?
                    </button>
                </h2>
                <!-- 2° resposta -->
                <div id="duvida2" class="accordion-collapse collapse" aria-labelledby="heading2"
                    data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                        Basta fazer login no sistema, clicar em "Cadastrar Projeto" e preencher o formulário com as
                        informações solicitadas.
                    </div>
                </div>
            </div>

            <!-- 3° pergunta e resposta -->
            <div class="accordion-item">
                <!-- 3° pergunta -->
                <h2 class="accordion-header" id="heading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#duvida3" aria-expanded="false" aria-controls="duvida3">
                        3. Meu projeto precisa ser aprovado por alguém antes de ser publicado?
                    </button>
                </h2>
                <!-- 3° resposta -->
                <div id="duvida3" class="accordion-collapse collapse" aria-labelledby="heading3"
                    data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                        Sim, todos os projetos enviados passam por uma análise da coordenação antes de serem liberados
                        para visualização pública.
                    </div>
                </div>
            </div>

            <!-- 4° pergunta e resposta -->
            <div class="accordion-item">
                <!-- 4° pergunta-->
                <h2 class="accordion-header" id="heading4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#duvida4" aria-expanded="false" aria-controls="duvida4">
                        4. Posso editar um projeto depois de enviado?
                    </button>
                </h2>
                <!-- 4° resposta -->
                <div id="duvida4" class="accordion-collapse collapse" aria-labelledby="heading4"
                    data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                        Sim, enquanto o projeto estiver em análise, você pode editar as informações. Após a aprovação,
                        alterações precisarão ser solicitadas à coordenação.
                    </div>
                </div>
            </div>

            <!-- 5° pergunta e resposta -->
            <div class="accordion-item">
                <!-- 5° pergunta -->
                <h2 class="accordion-header" id="heading5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#duvida5" aria-expanded="false" aria-controls="duvida5">
                        5. Quem pode visualizar os projetos cadastrados?
                    </button>
                </h2>
                <!-- 5° resposta -->
                <div id="duvida5" class="accordion-collapse collapse" aria-labelledby="heading5"
                    data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                        Todos os alunos, professores e servidores do Instituto que tenham acesso ao sistema.
                    </div>
                </div>
            </div>

            <!-- 6° pergunta e resposta -->
            <div class="accordion-item">
                <!-- 6° pergunta -->
                <h2 class="accordion-header" id="heading6">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#duvida6" aria-expanded="false" aria-controls="duvida6">
                        6. Posso me inscrever como participante em um projeto?
                    </button>
                </h2>
                <!-- 6° resposta -->
                <div id="duvida6" class="accordion-collapse collapse" aria-labelledby="heading6"
                    data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                        Sim! Se o projeto permitir participação de outros alunos ou professores, você poderá se
                        inscrever diretamente na página do projeto.
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        feather.replace();
    </script>
    <script src="view_duvidas.js"></script>
</body>

</html>
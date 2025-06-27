<?php
  require_once '../../model/finish_session.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>API de Editais - IFTO</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <script src="view_edital.js"></script>
  <link rel="stylesheet" href="view_edtital.css">
</head>

<body>
  <!-- Titulo "Editais em Aberto" -->
  <h1>Editais em Aberto - IFTO</h1>
    
  <!-- DIV de buscar -->
  <div class="search-container">
    <input type="text" id="searchNome" placeholder="Buscar por título...">
    <input type="text" id="searchCampus" placeholder="Buscar por campus...">
    <button onclick="buscarEditais()">Buscar</button>
  </div>

  <div id="resultado"></div>

  <!-- DIV de anterior, próxima e n° da pagina -->
  <div class="pagination">
    <button onclick="anteriorPagina()">◀ Anterior</button>
    <span id="paginaAtual">Página 0</span>
    <button onclick="proximaPagina()">Próxima ▶</button>
  </div>
</body>
</html>


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
  <link rel="stylesheet" href="view_cad_project.css">
</head>       

<body>  
    
  <div class="container"> 
    <h1 class="title-text">Cadastro de Projetos</h1>

    <p class="cad-text">Título do Projeto:</p>
    <form class="d-flex">
      <input class="input-form" type="search" placeholder="Digite seu nome completo..." aria-label="Buscar">
    </form>

    <p class="cad-text">Status:</p>

    <label class="checkbox-wrapper">
        <input type="checkbox" name="item" value="andamento">
        <span class="custom-checkbox"></span>
        Em andamento
    </label>

    <label class="checkbox-wrapper">
        <input type="checkbox" name="item" value="finalizado">
        <span class="custom-checkbox"></span>
        Finalizado
    </label>

    <p class="cad-text">Campus do Projeto:</p>
    <form class="d-flex">
      <input class="input-form" type="search" placeholder="Digite a senha que deseja..." aria-label="Buscar">
    </form>

    <p class="cad-text">N° do Edital:</p>
    <form class="d-flex">
      <input class="input-form" type="search" placeholder="Digite seu e-mail..." aria-label="Buscar">
    </form>

    <p class="cad-text">Anexo do Artigo:</p>
    <form class="d-flex">
        <label class="file-label">
            📎 Escolher arquivo
            <input type="file" id="arquivo-artigo" name="arquivo" class="file-input">
        </label>
        <button type="submit" class="btn-attach">Anexar</button>
    </form>

    <p class="cad-text">Anexo de Fotos:</p>
    <form class="d-flex">
        <label class="file-label">
            📸 Selecionar imagem
            <input type="file" id="arquivo-foto" name="arquivo" class="file-input">
        </label>
        <button type="submit" class="btn-attach">Anexar</button>
    </form>
      
    <div class="submit">
      <button class="btn-send" type="submit">Enviar</button>
    </div>
    
  </div>

</body>
</html>


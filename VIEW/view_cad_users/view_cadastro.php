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
    
  <div class="container"> 
    <h1 class="title-text">Cadastro de Usuários</h1>

    <p class="cad-text">Nome Completo:</p>
    <form class="d-flex">
      <input class="input-form" type="search" placeholder="Digite seu nome completo..." aria-label="Buscar">
    </form>

    <p class="cad-text">Matricula:</p>
    <form class="d-flex">
      <input class="input-form" type="search" placeholder="Digite sua matricula..." aria-label="Buscar">
    </form>

    <p class="cad-text">Senha:</p>
    <form class="d-flex">
      <input class="input-form" type="search" placeholder="Digite a senha que deseja..." aria-label="Buscar">
    </form>

    <p class="cad-text">E-mail:</p>
    <form class="d-flex">
      <input class="input-form" type="search" placeholder="Digite seu e-mail..." aria-label="Buscar">
    </form>

    <p class="cad-text">Curso:</p>
    <form class="d-flex">
      <input class="input-form" type="search" placeholder="Digite seu curso..." aria-label="Buscar">
    </form>

    <label class="cad-text" for="cad-text">Tipo de Acesso:</label>
    <select class="select-container">
      <option>Selecione</option>
      <option>Aluno</option>
      <option>Professor</option>
    </select>
          
    <div class="submit">
      <button class="btn-send" type="submit">Enviar</button>
    </div>
    
  </div>

</body>
</html>


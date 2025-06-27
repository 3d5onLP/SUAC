<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUAC</title>
    <link rel="stylesheet" href="view_login.css">
    <script src="login.js"></script>
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>

<body>
    <!--Container principal-->
    <div class="container">
        <!--Logo do Sistema--> 
        <div class="left">
          <img src="../icon/logo.png" class="illustration" alt="">
        </div>

        <!-- Função de autenticação do login com o BD -->
        <form action="../../model/autenticar.php" method="post">

          <div class="right">
            <h2>Login</h2>
            <p>Acesse:</p>
            <div class="form-group">
              <label for="matricula">Matricula:</label>
              <input type="text" id="matricula" name="matricula" required placeholder="Digite seu usuário">
            </div>
            
            <div class="form-group">  
              <label for="senha">Senha:</label>
              <input type="password" id="senha" name="senha" required placeholder="Digite sua senha">
            </div>
              <button class="acessar" onclick="fazerLogin()">Acessar</button> 
              <a href="../view_troca_senha/troca_senha.php" target="_self">Esqueceu sua senha?</a>

              <a href="../view_cad_users/view_cadastro.html" target="_self">Cadastre-se</a>

                
          </div>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUAC</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="global.css">
</head>
<body>
    <!-- DIV da animação ao carregar a página de login -->
    <div class="loading-container">
        <div class="site-title">SUAC Sistema unificado de administração científica</div>
        <i class="fas fa-sync-alt"></i>
        <div class="spinner-border" role="status">
            <span class="sr-only">Carregando...</span>
        </div>
        <p class="loading-text">Carregando, por favor aguarde...</p>
    </div>

    <script>
     
        // Redirecionar para a página desejada após 3 segundos
        setTimeout(() => {
            document.body.classList.add('fade-out');
            setTimeout(() => {
                window.location.href = 'VIEW/VIEW_LOGIN/view_login.php';
            }, 1000); // Sincronizar com a animação de fade out
        }, 1000);
    </script>
</body>
</html>
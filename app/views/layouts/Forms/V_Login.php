<?php
if (isset($_SESSION['usuari'])) {
    header("Location: index.php?controller=Login&method=bienvenido");
    exit();
} ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salleguard Login</title>
    <link rel="shortcut icon" href="https://lasallemollerussa.sallenet.org/theme/image.php/sallenetboost/theme/1732323702/favicon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Custom CSS File link -->
    <link rel="stylesheet" href="public/css/stylesLogin.css?v=1">
</head>

<body>
    <div class="header">
        <img src="Images/Login/Salleguard.png" alt="">
    </div>
    <div class="contenedor-login-principal">
        <div class="contenedor-login-detalles">
            <div class="home" id="home">
                <div class="user">
                    <img src="Images/Login/user.png" alt="">
                </div>
                <h1>Inicia Sessió</h1>
                <form action="index.php?controller=Login&method=verificar_login" method="POST" class="form">
                    <div class="input-container">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Correu electrònic" required>
                    </div>
                    <div class="input-container">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Contrasenya" required minlength="3">
                    </div>
                    <button type="submit" class="anm-levantar">Iniciar Sessió</button>

                    <p class="text-center">
                        <a href="index.php?controller=Login&method=show_reset_form" class="forgot-password">¿Has oblidat el teu nom d' usuari o contrasenya?</a>
                    </p>                    
                </form>
            </div>
        </div>
        <div class="contenedor-login-imagen">
            <div class="logo1">
                <img src="Images/Login/Salleguard.png" alt="">
            </div>

            <div class="logo2">
                <img src="Images/Login/la_salle_white.jpeg" alt="">
            </div>
        </div>
    </div>
    <div class="footer">
        <img src="Images/Login/la_salle_white.jpeg" alt="">
    </div>
</body>

<!-- jQuery cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</html>
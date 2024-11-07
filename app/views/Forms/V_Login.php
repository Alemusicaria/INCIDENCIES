<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salleguard Login</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Custom CSS File link -->
    <link rel="stylesheet" href="public/css/styles.css?v=1"> 

</head>
<body>

    <!-- Logo Header -->
    <div class="header"> 
        <img src="Images/Login/la_salle_white.jpeg" alt="">
    </div>

    <section class="home" id="home">
        <div class="container">
            <!-- User Avatar -->
            <div class="user">
                <img src="Images/Login/user.png" alt="">
            </div>

            <!-- Form -->
            <form action="index.php?controller=Login&method=verificar_login" method="POST" class="form-content">
                <h1>Inicia Sessió</h1>

                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Correu eletrònic" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contrasenya" required minlength="3">
                </div>

                <button type="submit" class="form-btn">Iniciar Sessió</button>
                
                <p class="text-center">
                    <a href="#" class="forgot-password">¿Has oblidat el teu nom d' usuari o contrasenya?</a>
                </p>
            </form>
        </div>
    </section>

    <!-- Logo Footer -->
    <div class="footer"> 
        <img src="Images/Login/Salleguard.png" alt="">
    </div>
    

    <!-- jQuery cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Custom JS file link -->
    <script src="js/main.js"></script>

</body>
</html>
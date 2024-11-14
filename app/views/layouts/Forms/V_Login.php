<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salleguard Login</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Custom CSS File link -->
    <link rel="stylesheet" href="public/css/stylesLogin.css?v=1"> 

</head>

<body>
    <div class="mobile-view">
        <div class="container">
            <header class="header">
                <img src="Images/Login/Salleguard.png" alt="">
            </header>

            <main class="main" style="display: flex; flex-direction: column; gap: 15px;">
                <div class="home" id="home">
                    <div class="user">
                        <img src="Images/Login/user.png" alt="">
                    </div>

                    <form action="index.php?controller=Login&method=verificar_login" method="POST" class="form">
                        <h1>Inicia Sessió</h1>

                        <div class="input-container">
                            <i class="fas fa-user"></i>
                            <input type="email" name="username" id="username" class="form-control" placeholder="Nom d' Usuari" required>
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
            </main>

            <footer class="footer">
                <img src="Images/Login/la_salle_white.jpeg" alt="">
            </footer>
        </div>
    </div>

    <div class="desktop-view">
        <div class="container">
            <main class="main" style="display: flex; flex-direction: row; height: 100%;">
                <div class="mleft"> 
                    <div class="logo2">
                    <img src="Images/Login/Salleguard.png" alt="">
                    </div>
                    <div class="logo1">
                        <img src="Images/Login/la_salle_white.jpeg" alt="">
                    </div>
                </div>
                
                <div class="mright"> 
                    <div class="home" id="home">
                        <div class="user">
                            <img src="Images/Login/user.png" alt="">
                        </div>

                        <form action="index.php?controller=Login&method=verificar_login" method="POST" class="form">
                            <h1>Inicia Sessió</h1>

                            <div class="input-container">
                                <i class="fas fa-user"></i>
                                <input type="email" name="username" id="username" class="form-control" placeholder="Nom d' Usuari" required>
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
                </div>
            </main>
        </div>
    </div>

    <!-- jQuery cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>
</html>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../../../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Inici</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../../../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <style>
        .menu-lateral {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #333;
            padding-top: 20px;
            color: white;
            display: none;
            /* Inicialment amagat */
            flex-direction: column;
            gap: 1rem;
            z-index: 1050;
            transition: transform 0.3s ease;
            /* Afegit per a transicions suaus */
        }

        .menu-lateral.show {
            display: flex;
            /* Mostrar només quan és necessari */
        }

        .menu-lateral a {
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .menu-lateral a:hover {
            background-color: #575757;
        }

        .container {
            transition: margin-left 0.3s ease;
            /* Animació per al canvi de marge */
            margin-left: 0;
        }

        .container.menu-active {
            margin-left: 250px;
            /* Espai per al menú lateral actiu */
        }

        .logo-container {
            display: flex;
            justify-content: space-around;
            /* Espaiat entre els logos */
            background-image: url('../../../Images/Login/Fondo1.png');
            align-items: center;
            padding: 10px;
            transition: margin-left 0.3s ease;
            /* Animació per al canvi de marge de la logo-container */
        }

        .logo-container.menu-active {
            margin-left: 250px;
            /* Espai per al menú lateral actiu */
        }

        .logo {
            width: 50px;
            /* Amplada dels logos */
            height: auto;
            cursor: pointer;
            /* Canvia el cursor a mà quan es passa per sobre */
        }
    </style>

</head>

<body>
    <div class="logo-container" id="logoContainer">
        <img src="../../../Images/menu.png" alt="Logo 1" class="logo" id="menuToggle"> <!-- Logo per obrir el menú -->
        <img src="../../../Images/Login/la_salle_white.jpeg" alt="Logo 2" class="logo">
        <img src="../../../Images/Login/user.png" alt="Logo 3" class="logo">
    </div>

    <nav class="menu-lateral" id="sidebarMenu">
        <a href="#">Inici</a>
        <a href="#">Perfil</a>
        <a href="#">Configuració</a>
        <a href="#">Tancament</a>
    </nav>

    <div class="container" id="mainContent">
        <h1>Benvingut a la pàgina d'inici!</h1>
        <p>Aquí pots gestionar el teu contingut.</p>
    </div>

    <script>
        $(document).ready(function() {
            $('#menuToggle').click(function() {
                $('#sidebarMenu').toggleClass('show'); // Afegir o treure la classe per mostrar/ocultar el menú
                $('#mainContent').toggleClass('menu-active'); // Afegir o treure la classe per ajustar el marge
                $('#logoContainer').toggleClass('menu-active'); // Afegir o treure la classe per ajustar el marge de la logo-container
            });
        });
    </script>
</body>

</html>
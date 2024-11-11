<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion id incidencia</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css' rel='stylesheet' />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous">
    </script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .input-container {
            position: relative; /* Posiciona el contenedor de manera relativa */
            width: 100%; /* Asegura que el input ocupe el ancho completo */
            margin-bottom: 10px; /* Espacio entre inputs */

        }

        .input-container i {
            position: absolute; /* Posiciona el icono de manera absoluta */
            left: 10px; /* Ajusta el espacio desde la izquierda */
            top: 50%; /* Centra el icono verticalmente */
            transform: translateY(-50%); /* Alinea verticalmente el icono */
            color: #888; /* Color del icono */
        }

        .input-container input {
            padding-left: 30px; /* Espacio para el icono */
            width: 100%; /* Asegura que el input ocupe el ancho completo */
            height: 40px; /* Altura del input */
            border: 1px solid #ccc; /* Estilo del borde */
            border-radius: 5px; /* Esquinas redondeadas */
            background-color: #F4F6FF; /* Color de fondo del input */
            transition: border-color 0.3s, box-shadow 0.3s; /* Transiciones suaves */
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <?php
        include("sidebar.php"); // Aquí se incluye la barra lateral
        ?>
        
        <div class="content m-3">
            <h1> Detalles de la incidencia </h1>
            <form method="post" action="#">

                <label>Titulo de la Incidencia</label>
                <div class="input-container">
                    <i class="fa-solid fa-heading"></i>
                    <input type="text" name="TituloFallo" id="TituloFallo" required>
                </div>

                <label>Tipo de Incidencia</label>
                <div class="input-container">
                    <i class="fa-solid fa-heading"></i>
                    <input type="text" name="Categoria" id="Categoria" required>
                </div>

                <label>Email del reporter</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <label>Titol del fallo</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <lable>Tipus del fallo</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <label>Data de creació</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <label>Descripció</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <label>Ubicació</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <label>Prioritat</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <label>Estat</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <label>Imatgés</label>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" id="correo" required>
                </div>

            </form>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="script_default.js"></script>
    <script src="script_inici.js"></script>
</body>
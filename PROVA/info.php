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

            background-color: #FFFFFF; /* Color de fondo del input */
        }

        .input-container input {
            padding-left: 10px;
            width: 100%; /* Asegura que el input ocupe el ancho completo */
            height: 40px; /* Altura del input */
            border: 1px solid #ccc; /* Estilo del borde */
            border-radius: 5px; /* Esquinas redondeadas */
            transition: border-color 0.3s, box-shadow 0.3s; /* Transiciones suaves */
        }

        .input-container select {
            width: 100%; /* Asegura que el select ocupe el ancho completo */
            height: 40px; /* Altura del select */
            border: 1px solid #ccc; /* Estilo del borde */
            border-radius: 5px; /* Esquinas redondeadas */
            font-size: 16px; /* Tamaño de fuente para que sea coherente con el diseño */
            transition: border-color 0.3s, box-shadow 0.3s; /* Transiciones suaves */
        }

        .input-container select:focus {
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5); /* Sombra verde */
            outline: none; /* Elimina el borde por defecto de los navegadores */
        }

        .input-container select:hover {
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

                <i class="fa-solid fa-pencil-alt"></i>
                <label>Titulo de la Incidencia</label>
                <div class="input-container">
                    <input type="text" name="TituloFallo" id="TituloFallo" required>
                </div>
                
                <i class="fas fa-th-list"></i>
                <label>Tipo de Incidencia</label>
                <div class="input-container">
                    <select id="Categoria" name="Categoria" class="form-control" required>
                        <option value="Calefaccio"> Calefacció</option>
                        <option value="Electricitat"> Electricitat</option>
                        <option value="Fontaner"> Fontaner</option>
                        <option value="Informatica"> Informàtica</option>
                        <option value="Fusteria"> Fusteria</option>
                        <option value="Ferrer"> Ferrer</option>
                        <option value="Obres"> Obres</option>
                        <option value="Audiovisual"> Audiovisual</option>
                        <option value="Equips de seguretat"> Equips de seguretat</option>
                        <option value="Neteja de clavegueram"> Neteja de clavegueram</option>
                        <option value="Otros"> Otros</option>
                    </select>
                </div>

                <i class="fas fa-building"></i>
                <label>Planta</label>
                <div class="input-container">
                    <select id="Planta" name="Planta" class="form-control">
                        <option value="Planta -1">Planta -1</option>
                        <option value="Planta 0">Planta 0</option>
                        <option value="Planta 1">Planta 1</option>
                        <option value="Planta 2">Planta 2</option>
                        <option value="Planta 3">Planta 3</option>
                        <option value="Planta 4">Planta 4</option>
                    </select>
                </div>
                
                <i class="fas fa-door-closed"></i>
                <label>Numero Sala</label>
                <div class="input-container">
                    <input type="text" name="Salon" id="Salon" required>
                </div>

                                <!--

                <label>Estado</label>
                <div class="input-container">
                    <input type="radio" class="btn-check" name="Estado" id="Pendent" value="Pendent" required>
                    <label class="btn btn-outline-success" for="Pendent">Pendent</label>

                    <input type="radio" class="btn-check" name="Estado" id="En Progrés" value="En Progrés" required>
                    <label class="btn btn-outline-danger" for="En Progrés">En Progrés</label>

                    <input type="radio" class="btn-check" name="Estado" id="Resolta" value="Resolta" required>
                    <label class="btn btn-outline-warning" for="Resolta">Resolta</label>
                </div>


                <label>Prioritat</label>
                <div class="input-container">
                    <input type="radio" class="btn-check" name="Prioridad" id="Baixa" value="Baixa" required>
                    <label class="btn btn-outline-success" for="Baixa">Baixa</label>

                    <input type="radio" class="btn-check" name="Prioridad" id="Mitjana" value="Mitjana" required>
                    <label class="btn btn-outline-danger" for="Mitjana">Mitjana</label>

                    <input type="radio" class="btn-check" name="Prioridad" id="Alta" value="Alta" required>
                    <label class="btn btn-outline-warning" for="Alta">Alta</label>
                </div>

                                    -->
                <i class="fas fa-camera"></i>
                <label>Foto</label>
                <input type="file" class="form-control" name="Foto" id="Foto">

                <i class="fas fa-envelope"></i>
                <label>Descripció</label>
                <div class="input-container">
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
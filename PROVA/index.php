<!------------------------------------------------------------------------>
<!------------------------------------------------------------------------>
<!--------------------------        MENU        -------------------------->
<!------------------------------------------------------------------------>
<!------------------------------------------------------------------------>

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
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css' rel='stylesheet' />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <?php
        include("sidebar.php"); // Aquí se incluye la barra lateral
        ?>
        
        <!------------------------------------------------------------------------->
        <!------------------------------------------------------------------------->
        <!--------------------------        INICI        -------------------------->
        <!------------------------------------------------------------------------->
        <!------------------------------------------------------------------------->

        <div class="main p-3">
            <div class="text-center">
                <h1>Incidències</h1>
            </div>
            <div class="view-buttons">
                <button class="btn btn-primary" data-view="dayGridDay">Dia</button>
                <button class="btn btn-primary" data-view="timeGridWeek">Setmana</button>
                <button class="btn btn-primary" data-view="dayGridMonth">Mes</button>
            </div>
            <div id='calendar'></div>
            <!-- Espai per mostrar la data seleccionada -->
            <div id="selected-date" style="display:none;">
                <h4>Data Seleccionada:</h4>
                <p id="date-text"></p>
                <h5>Incidències:</h5>
                <div id="incidencies-container"></div> <!-- Contenidor per a les incidències -->
            </div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js'></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
            <script src="script.js"></script>
        </div>
    </div>
    <!------------------------------------------------------------------------>
    <!--------------------------        FOOTER        ------------------------>
    <!------------------------------------------------------------------------>
</body>

</html>
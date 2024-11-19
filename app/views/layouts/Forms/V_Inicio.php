<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
include("app/views/layouts/header/header.php");
?>

<body>
    <div class="wrapper">
        <?php
        include("app/views/layouts/menu/menu.php");
        ?>

        <div class="main p-3">
            <div class="tittle-page">
                <h2>INICI</h2>
            </div>
            <div class="w-100" id='calendar'></div>
            <!-- Espai per mostrar la data seleccionada -->
            <div id="selected-date" style="display:none;">
                <h4 style="color:black">Data Seleccionada:</h4>
                <p id="date-text"></p>
                <h5>Incidències:</h5>
                <div id="incidencies-container"></div> <!-- Contenidor per a les incidències -->
            </div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js'></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
            <!-- Script personalitzat -->
            <script src="assets/js/script_inici.js"></script>
            
            


        </div>
</body>
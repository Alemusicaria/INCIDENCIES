<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php
include("layouts/header/header.php"); // Aquí se incluye la barra lateral
?>

<body>
    <div class="wrapper">
        <?php
        include("layouts/menu/menu.php"); // Aquí se incluye la barra lateral
        ?>

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
            <script src="assets/js/script_inici.js"></script>
        </div>
    </div>
    <?php
    include("layouts/footer/footer.php"); // Aquí se incluye la barra lateral
    ?>
</body>

</html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
include("app/views/layouts/header/header.php"); // Aquí se incluye la barra lateral
?>

<body>
    <div class="wrapper">
        <?php
        include("app/views/layouts/menu/menu.php"); // Aquí se incluye la barra lateral
        ?>
    
        <div class="main p-3">
            <div class="text-center">
                <h2>INICI</h2>
            </div>

            <div class="btn-group w-100 mt-1 mb-3" role="group" aria-label="Basic radio toggle button group">
                <label class="btn btn-outline-primary w-100" data-view="dayGridDay">Dia</label>
                <label class="btn btn-outline-primary w-100" data-view="timeGridWeek">Setmana</label>
                <label class="btn btn-outline-primary w-100 active" data-view="dayGridMonth">Mes</label>
            </div>

            <div class="w-100" id='calendar'></div>
            <!-- Espai per mostrar la data seleccionada -->
            <div id="selected-date" style="display:none;">
                <h4>Data Seleccionada:</h4>
                <p id="date-text"></p>
                <h5>Incidències:</h5>
                <div id="incidencies-container"></div> <!-- Contenidor per a les incidències -->
            </div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js'></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

            <!-- Script personalitzat -->
            <script src="assets/js/script_inici.js"></script>
        </div>
    </div>
</body>


<!--
<h1>hola mundo <?php echo $_SESSION['usuario']; ?>!</h1>
<button onclick="window.location.href='index.php?controller=Incidencias&method=vista_ingreso_incidencias';">
    Ir a Vista Ingreso de Incidencias
</button>
<button onclick="window.location.href='index.php?controller=Registro&method=registro';">
    Ir a Vista Usuario
</button>
<button onclick="window.location.href='index.php?controller=Info_Incidencias&method=mostrar_tabla_incidencias';">
    Ir a MOSTARAS
</button>
-->
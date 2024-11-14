<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

?>

<?php
include("../../layouts/header/header.php");
?>

<body>
    <div class="wrapper">
        <?php
        include("../../layouts/menu/menu.php"); 
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
</body>
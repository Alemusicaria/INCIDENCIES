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

        <!-- Contingut principal del perfil -->
        <div class="main">
            <!-- Fondo de la Imagen -->
            <div class="fondo-perfil">
                <!-- Imagen de Perfil -->
                <div class="perfil-img mb-3">
                    <img src="Images/Login/perfil.png" alt="Perfil" class="perfil-img">
                </div>

                <a href="#">Cambiar foto de perfil</a>
            </div>

            <!-- Dades de l'usuari -->
            <div class="card m-4">
                <div class="card-header">
                    <i class="lni lni-user"></i>
                    Dades de l'Usuari
                </div>

                <div class="card-body">
                    <div class="mb-2">
                        <label for="nom" class="perfil-label">Nom i Cognoms</label>
                        <input id="nom" type="text" class="form-control" value="Pepe Perez" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="correu" class="perfil-label">Correu Electrònic</label>
                        <input id="correu" type="text" class="form-control" value="pepe.perez@example.com" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="incidencies" class="perfil-label">Nombre d'Incidències Creades</label>
                        <input id="incidencies" type="text" class="form-control" value="10" readonly>
                    </div>

                    <!-- Botons per a accions del perfil -->
                    <div class="d-grid gap-2 mt-3">
                        <div class="text-center">
                            <a href="#" class="btn" id="rescorreo">Restaurar Correu</a>
                        </div> 
                        <div class="text-center">
                            <a href="#" class="btn" id="rescontra">Restaurar Contrasenya</a>
                        </div> 
                        <div class="text-center">
                            <a href="#" class="btn" id="descuenta">Deshabilitar Compte</a>
                        </div> 
                        <!--
                        <a href="restaurar_correu.php" class="btn btn-warning-custom btn-professional">Restaurar Correu</a>
                        <a href="restaurar_contrasenya.php" class="btn btn-secondary-custom btn-professional">Restaurar Contrasenya</a>
                        <a href="deshabilitar_compte.php" class="btn btn-danger-custom btn-professional">Deshabilitar Compte</a>
-->
                    </div>
                </div>
            </div>

            <!-- Botó per tornar a l'inici -->
            <div class="text-center mt-4 mb-4">
                <a href="index.php" class="btn" id="volver">Torna a l'inici</a>
            </div> 
        </div>
    </div>
</body>

</html>
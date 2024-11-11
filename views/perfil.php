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
        <div class="main p-3">
            <h2 class="text-center">Perfil de l'Usuari</h2>
            <div class="card p-4">
                <!-- Dades de l'usuari -->
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom i Cognoms:</label>
                    <p id="nom"><strong>Joan Pérez</strong></p>
                </div>
                <div class="mb-3">
                    <label for="correu" class="form-label">Correu Electrònic:</label>
                    <p id="correu">joan.perez@example.com</p>
                </div>
                <div class="mb-3">
                    <label for="incidencies" class="form-label">Nombre d'Incidències Creades:</label>
                    <p id="incidencies">12</p>
                </div>

                <!-- Botons per a accions del perfil -->
                <div class="d-grid gap-2 mt-4">
                    <a href="restaurar_correu.php" class="btn btn-warning-custom btn-professional">Restaurar Correu</a>
                    <a href="restaurar_contrasenya.php" class="btn btn-secondary-custom btn-professional">Restaurar Contrasenya</a>
                    <a href="deshabilitar_compte.php" class="btn btn-danger-custom btn-professional">Deshabilitar Compte</a>
                </div>

            </div>

            <!-- Botó per tornar a l'inici -->
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-primary btn-professional">Torna a l'inici</a>
            </div>
        </div>
    </div>
</body>

</html>
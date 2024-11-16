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
            <div class="fondo-perfil"></div>
            <!-- Fondo de la Imagen -->

            <div class="tittle-page">
                <h2>Perfil de l'Usuari</h2>
            </div>

            <div class="main p-3">
                <div class="card p-3">
                    <!-- Imatge de perfil -->
                    <div class="perfil-center">
                        <div class="perfil-img">
                            <img src="Images/Login/perfil.png" alt="Perfil" class="perfil-img">
                        </div>

                        <div class="perfil-group">
                            <label for="Foto">Foto Usuario</label>
                            <input type="file" class="form-control" name="Foto" id="Foto">
                        </div>
                    </div>

                    <!-- Dades de l'usuari -->
                    <div class="mb-2">
                        <label for="nom" class="perfil-label">Nom i Cognoms:</label>
                        <p id="nom">Noms i Cognoms Usuari</p>
                    </div>

                    <div class="mb-2">
                        <label for="correu" class="perfil-label">Correu Electrònic:</label>
                        <p id="correu">joan.perez@example.com</p>
                    </div>

                    <div class="mb-2">
                        <label for="incidencies" class="perfil-label">Nombre d'Incidències Creades:</label>
                        <p id="incidencies">#</p>
                    </div>

                    <!-- Botons per a accions del perfil -->
                    <div class="d-grid gap-2 mt-3">
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
    </div>
</body>

</html>
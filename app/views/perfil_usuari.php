<?php
if (isset($dades_perfil)) {
    // Mostrar los datos de la incidencia
?>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include("layouts/header/header.php"); // Incloure el header
    ?>

    <body>
        <div class="wrapper">
            <?php
            include("layouts/menu/menu.php"); // Incloure la barra lateral
            ?>

            <!-- Contingut principal del perfil -->
            <div class="main">
                <!-- Fondo de la Imatge -->
                <div class="fondo-perfil">
                    <!-- Imatge de Perfil -->
                    <div class="perfil-img mb-3">
                        <img src="<?php echo $_SESSION['usuari'][5]; ?>" alt="Perfil" class="perfil-img">
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
                        <form action="index.php?controller=Perfil&method=actualitzar" method="POST">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($dades_perfil['id']); ?>">

                            <div class="mb-2">
                                <label for="nom_cognoms" class="perfil-label">Nom i cognoms</label>
                                <input id="nom_cognoms" type="text" name="nom_cognoms" class="form-control"
                                    value="<?= htmlspecialchars($dades_perfil['nom_cognoms']); ?>" required>
                            </div>

                            <div class="mb-2">
                                <label for="correu" class="perfil-label">Correu Electrònic</label>
                                <input id="correu" type="email" name="correu" class="form-control"
                                    value="<?= htmlspecialchars($dades_perfil['correu']); ?>" required>
                            </div>

                            <div class="mb-2">
                                <label for="telefon" class="perfil-label">Telèfon</label>
                                <input id="telefon" type="text" name="telefon" class="form-control"
                                    value="<?= htmlspecialchars($dades_perfil['telefon']); ?>" required>
                            </div>

                            <div class="mb-2">
                                <label for="rol" class="perfil-label">Rol</label>
                                <select id="rol" name="rol" class="form-control" required>
                                    <option value="Admin" <?= $dades_perfil['rol'] === 'Admin' ? 'selected' : ''; ?>>Administrador</option>
                                    <option value="Tecnic" <?= $dades_perfil['rol'] === 'Tecnic' ? 'selected' : ''; ?>>Tecnic</option>
                                    <option value="Professor" <?= $dades_perfil['rol'] === 'Professor' ? 'selected' : ''; ?>>Professor</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar canvis</button>
                        </form>
                    </div>
                </div>

                <!-- Botó per tornar a l'inici -->
                <div class="text-center mt-4 mb-4">
                    <a href="index.php?controller=Login&method=gestionar_usuaris" class="btn" id="volver">Torna endarrere</a>
                </div>
            </div>
        </div>
    </body>
<?php
} else {
    echo "<div class='alert alert-danger'>No se encontraron datos de la incidencia.</div>";
}


?>

</html>
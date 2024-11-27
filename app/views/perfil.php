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
                    <?php $foto = $_SESSION['usuari'][5] ? $_SESSION['usuari'][5] : 'Images/Foto_Perfiles/user-icon.png'; ?>
                    <img src="<?php echo $foto; ?>" alt="Perfil">
                </div>
            </div>

            <!-- Dades de l'usuari -->
            <div class="card m-4">
                <div class="card-header">
                    <i class="lni lni-user"></i>
                    Dades de l'Usuari
                </div>

                <div class="card-body">
                    <div class="mb-2">
                        <label for="nom" class="perfil-label">Nom i cognoms</label>
                        <input id="nom" type="text" class="form-control" value="<?php echo $_SESSION['usuari'][1]; ?>" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="correu" class="perfil-label">Correu Electrònic</label>
                        <input id="correu" type="text" class="form-control" value="<?php echo $_SESSION['usuari'][2]; ?>" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="incidencies" class="perfil-label">Telefon</label>
                        <input id="incidencies" type="text" class="form-control" value="<?php echo $_SESSION['usuari'][3]; ?>" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="incidencies" class="perfil-label">Rol</label>
                        <input id="incidencies" type="text" class="form-control" value="<?php echo $_SESSION['usuari'][4]; ?>" readonly>
                    </div>
                </div>
            </div>

            <!-- Botó per tornar a l'inici -->
            <div class="text-center mt-4 mb-4">
                <a href="index.php?controller=Login&method=bienvenido" class="btn" id="volver">Torna a l'inici</a>
            </div>
        </div>
    </div>
</body>

</html>
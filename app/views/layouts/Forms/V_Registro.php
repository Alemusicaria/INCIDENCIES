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
    </div>

    <div class="main p-3">
        <div class="tittle-page">
            <h2>Afegeix Usuari</h2>
        </div>

        <form action="index.php?controller=Registro&method=ingresar_usuario" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Nombre">Nombre Completo </label>
                <input type="text" class="form-control" id="Nombre" name="Nombre"required>
            </div>

            <div class="form-group">
                <label for="Correo">Email </label>
                <input type="email" class="form-control" id="Correo" name="Correo"required>
            </div>

            <div class="form-group">
                <label for="Contraseña">Contraseña </label>
                <input type="password" class="form-control" id="Contraseña" name="Contraseña"required>
            </div>

            <div class="form-group">
                <label for="Ntelefono">Teléfono</label>
                <input type="text" class="form-control" id="Ntelefono" name="Ntelefono" required>
            </div>

            <div class="form-group">
                <label for="Rol">Cargo</label>
                <div class="radio-group">
                    <input type="radio" class="btn-check" name="Rol" id="Professor" value="Professor" required>
                    <label class="btn btn-outline-success" for="Professor">Professor</label>

                    <input type="radio" class="btn-check" name="Rol" id="Tecnic" value="Tecnic" required>
                    <label class="btn btn-outline-danger" for="Tecnic">Tecnic</label>

                    <input type="radio" class="btn-check" name="Rol" id="Admin" value="Admin" required>
                    <label class="btn btn-outline-warning" for="Admin">Admin</label>
                </div>
            </div>

            <div class="form-group">
                <label for="Foto">Foto Usuario</label>
                <input type="file" class="form-control" name="Foto" id="Foto">
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>


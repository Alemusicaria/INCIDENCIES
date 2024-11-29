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

        <div class="espacio-grande">
        <div class="espacio-medio">
        <div class="w-100">

        <div class="card">
            <div class="card-header">
                <i class="lni lni-pencil-alt"></i>
                Formulari
            </div>

            <div class="card-body">
                <form action="index.php?controller=Registro&method=ingresar_usuario" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="perfil-label" for="Nombre">Nombre Completo </label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>

                    <div class="form-group">
                        <label class="perfil-label" for="Correo">Email </label>
                        <input type="email" class="form-control" id="Correo" name="Correo" required>
                    </div>

                    <div class="form-group">
                        <label class="perfil-label" for="Contraseña">Contraseña </label>
                        <input type="password" class="form-control" id="Contraseña" name="Contraseña" required>
                    </div>

                    <div class="form-group">
                        <label class="perfil-label" for="Ntelefono">Teléfono</label>
                        <input type="text" class="form-control" id="Ntelefono" name="Ntelefono" required>
                    </div>

                    <div class="form-group">
                        <label class="perfil-label" for="Rol">Cargo</label>
                        <div class="form-group d-flex w-100">
                            <input type="radio" class="btn-check" name="Rol" id="Professor" value="Professor" required>
                            <label class="btn btn-outline-success" for="Professor">Professor</label>

                            <input type="radio" class="btn-check" name="Rol" id="Tecnic" value="Tecnic" required>
                            <label class="btn btn-outline-danger" for="Tecnic">Tecnic</label>

                            <input type="radio" class="btn-check" name="Rol" id="Admin" value="Admin" required>
                            <label class="btn btn-outline-warning" for="Admin">Admin</label>
                        </div>
                    </div>
                    <div id="tecnico-fields" style="display: none;">
                        <div class="input-container">
                            <i class="fas fa-tools"></i>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Selecciona un tipus</option>
                                <option value="Calefacció">Calefacció</option>
                                <option value="Electricitat">Electricitat</option>
                                <option value="Fontaner">Fontaner</option>
                                <option value="Informàtica">Informàtica</option>
                                <option value="Fusteria">Fusteria</option>
                                <option value="Ferrer">Ferrer</option>
                                <option value="Obres">Obres</option>
                                <option value="Audiovisual">Audiovisual</option>
                                <option value="Equips de seguretat">Equips de seguretat</option>
                                <option value="Neteja de clavegueram">Neteja de clavegueram</option>
                                <option value="Altres">Altres</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="perfil-label" for="Foto">Foto Usuario</label>
                        <input type="file" class="form-control" name="Foto" id="Foto">
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>

        </div>
        </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    document.querySelectorAll('input[name="Rol"]').forEach(function(elem) {
        elem.addEventListener('change', function() {
            var tecnicoFields = document.getElementById('tecnico-fields');
            if (this.value === 'Tecnic') {
                tecnicoFields.style.display = 'block';
            } else {
                tecnicoFields.style.display = 'none';
            }
        });
    });
</script>
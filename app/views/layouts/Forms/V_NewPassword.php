<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Contrasenya</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="public/css/stylesLogin.css">

    <script>
        function validatePasswords() {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            if (newPassword !== confirmPassword) {
                alert('Les contrasenyes no coincideixen.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="contenedor-recuperar">
        <h2>Nova Contrasenya</h2>

        <div class="img-forgot">
            <img src="Images/password.png" alt="">
        </div>

        <form action="index.php?controller=Login&method=update_password" method="post" onsubmit="return validatePasswords()">
            
            <label class="label-enviar" for="new_password">Nova Contrasenya</label>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Ingresa tu nova contrasenya" required>

                <!-- Botón de mostrar contraseña -->
                <button type="button" class="eye-icon" onclick="togglePasswordVisibility('new_password')">
                    <i class="fas fa-eye"></i> <!-- Ojo abierto -->
                </button>
            </div>
            
            <label class="label-enviar" for="confirm_password">Confirma la Contrasenya</label>
            <div class="input-container">
                <i class="fas fa-lock-open"></i>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirma tu nova contrasenya" required>

                <!-- Botón de mostrar contraseña -->
                <button type="button" class="eye-icon" onclick="togglePasswordVisibility('confirm_password')">
                    <i class="fas fa-eye"></i> <!-- Ojo abierto -->
                </button>
            </div>

            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'], ENT_QUOTES, 'UTF-8'); ?>">

            <button type="submit" class="enviar">Actualitzar Contrasenya</button>
        </form>


        <script src="assets/js/visibilidad.js?v=1"></script>
    </div>
    
</body>

</html>
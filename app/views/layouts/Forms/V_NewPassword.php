<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Contrasenya</title>
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
    <h2>Nova Contrasenya</h2>
    <form action="index.php?controller=Login&method=update_password" method="post" onsubmit="return validatePasswords()">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'], ENT_QUOTES, 'UTF-8'); ?>">
        <label for="new_password">Nova Contrasenya:</label>
        <input type="password" id="new_password" name="new_password" required>
        <label for="confirm_password">Confirma la Contrasenya:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <button type="submit">Actualitzar Contrasenya</button>
    </form>
</body>
</html>
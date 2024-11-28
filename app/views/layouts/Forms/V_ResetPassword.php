<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperació de Contrasenya</title>
</head>
<body>
    <h2>Recuperació de Contrasenya</h2>
    <form action="index.php?controller=Login&method=send_reset_email" method="post">
        <label for="email">Correu electrònic:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
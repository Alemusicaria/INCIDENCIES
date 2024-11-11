<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurar Contrasenya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Restaurar Contrasenya</h2>
        <p>Introdueix una nova contrasenya per restaurar-la:</p>
        <form>
            <div class="mb-3">
                <label for="nova-contrasenya" class="form-label">Nova Contrasenya:</label>
                <input type="password" class="form-control" id="nova-contrasenya" required>
            </div>
            <div class="mb-3">
                <label for="confirma-contrasenya" class="form-label">Confirma Contrasenya:</label>
                <input type="password" class="form-control" id="confirma-contrasenya" required>
            </div>
            <button type="submit" class="btn btn-primary">Restaurar Contrasenya</button>
            <a href="perfil.php" class="btn btn-secondary">Cancel·lar</a>
        </form>
    </div>
</body>

</html>
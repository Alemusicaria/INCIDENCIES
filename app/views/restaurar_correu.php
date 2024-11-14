<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurar Correu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Restaurar Correu</h2>
        <p>Introdueix el nou correu electrònic per restaurar-lo:</p>
        <form>
            <div class="mb-3">
                <label for="nou-correu" class="form-label">Nou Correu Electrònic:</label>
                <input type="email" class="form-control" id="nou-correu" required>
            </div>
            <button type="submit" class="btn btn-primary">Restaurar Correu</button>
            <a href="perfil.php" class="btn btn-secondary">Cancel·lar</a>
        </form>
    </div>
</body>
</html>
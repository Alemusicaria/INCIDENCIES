<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connectar amb la base de dades
$servername = "localhost";
$username = "apratc_aprat";
$password = "AleixSteveLeandro123";
$dbname = "apratc_Incidencies";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Obtenim l'ID de la incidència
$id = $_GET['id'];

// Preparem la consulta per obtenir la incidència per ID
$sql = "SELECT * FROM incidencies WHERE id_incidencia = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$incidencia = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detall Incidència</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h1>Detall Incidència</h1>
        <p><strong>Títol:</strong> <?= $incidencia['titol_fallo'] ?></p>
        <p><strong>Descripció:</strong> <?= $incidencia['descripcio'] ?></p>
        <p><strong>Prioritat:</strong> <?= $incidencia['prioritat'] ?></p>
        <p><strong>Ubicació:</strong> <?= $incidencia['ubicacio'] ?></p>
        <p><strong>Data:</strong> <?= $incidencia['data_incidencia'] ?></p>
        <!-- Afegeix més detalls segons el que necessitis -->
        <a href="index.html" class="btn btn-primary">Tornar</a>
    </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>
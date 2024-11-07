<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connectar amb la base de dades
$servername = "localhost";
$username = "root"; // Canvia-ho pel teu nom d'usuari
$password = ""; // Canvia-ho per la teva contrasenya
$dbname = "incidencies"; // Canvia-ho pel teu nom de base de dades

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Obtenim la data passada com a paràmetre
$data = $_GET['data'];

// Preparem la consulta per obtenir només les incidències de la data especificada
$sql = "SELECT * FROM incidencies WHERE DATE(data_incidencia) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $data);
$stmt->execute();
$result = $stmt->get_result();

$incidencies = [];
while ($row = $result->fetch_assoc()) {
    $incidencies[] = $row;
}

// Retornar les incidències en format JSON
header('Content-Type: application/json');
echo json_encode($incidencies);

$stmt->close();
$conn->close();

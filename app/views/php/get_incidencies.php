<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connectar amb la base de dades
$servername = "localhost";
$username = "root"; // Canvia-ho pel teu nom d'usuari
$password = ""; // Canvia-ho per la teva contrasenya
$dbname = "apratc_Incidencies"; // Canvia-ho pel teu nom de base de dades

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Comprovem si s'ha passat la data com a paràmetre GET
if (!isset($_GET['data']) || empty($_GET['data'])) {
    echo json_encode(['error' => 'Data no especificada']);
    exit();
}

// Validar que la data segueix el format YYYY-MM-DD
$data = $_GET['data'];
if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $data)) {
    echo json_encode(['error' => 'Format de data no vàlid. Utilitza YYYY-MM-DD']);
    exit();
}

// Preparem la consulta per obtenir les incidències de la data especificada i les seves ubicacions
$sql = "SELECT i.*, s.planta, s.sala 
        FROM incidencies i 
        LEFT JOIN sales s ON i.id_ubicacio = s.id 
        WHERE DATE(i.data_incidencia) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $data);
$stmt->execute();
$result = $stmt->get_result();

$incidencies = [];
while ($row = $result->fetch_assoc()) {
    $ubicacio = (!empty($row['planta']) && !empty($row['sala']))
        ? "{$row['planta']}:{$row['sala']}"
        : "Ubicació no disponible";

    $incidencies[] = [
        'id' => $row['id'],
        'titol_fallo' => $row['titol_fallo'],
        'descripcio' => $row['descripcio'],
        'tipus_incidencia' => $row['tipus_incidencia'],
        'ubicacio' => $ubicacio,
        'data_incidencia' => $row['data_incidencia'],
        'estat' => $row['estat'],
        'prioritat' => $row['prioritat'],
        'imatges' => $row['imatges']
    ];
}


// Retornar les incidències en format JSON
header('Content-Type: application/json');
echo json_encode($incidencies);

$stmt->close();
$conn->close();

<?php
session_start();

// Comprovem si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    echo "No estàs logejat.";
    exit();
}

$cerca = isset($_GET['q']) ? $_GET['q'] : '';
if (empty($cerca)) {
    echo "No s'ha introduït cap cerca.";
    exit();
}

// Connexió a la base de dades
include('connexio.php');

$usuari_id = $_SESSION['id'];

// Consulta per cercar usuaris per nom
$query = "
    SELECT id, nom_cognoms 
    FROM usuaris 
    WHERE nom_cognoms LIKE ? AND id != ?
";

$stmt = $conn->prepare($query);
$param = '%' . $cerca . '%';
$stmt->bind_param('si', $param, $usuari_id);
$stmt->execute();
$resultat = $stmt->get_result();

if ($resultat->num_rows > 0) {
    while ($row = $resultat->fetch_assoc()) {
        echo "<p><a href='crear_conversa.php?usuari_id=" . $row['id'] . "'>" . htmlspecialchars($row['nom_cognoms']) . "</a></p>";
    }
} else {
    echo "<p>No s'han trobat resultats.</p>";
}

$stmt->close();
$conn->close();

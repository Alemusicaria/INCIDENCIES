<?php
session_start();

$cerca = isset($_GET['q']) ? $_GET['q'] : '';
if (empty($cerca)) {
    echo "No s'ha introduït cap cerca.";
    exit();
}

// Connexió a la base de dades
require_once 'app/models/connexio.php';

$usuari_id = $_SESSION['usuari'][0];

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

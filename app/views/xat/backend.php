<?php
// Configuració de la base de dades
$servername = "localhost";
$username = "apratc_aprat";
$password = "AleixSteveLeandro123";
$dbname = "apratc_Incidencies";

// Crear la connexió
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar connexió
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Funció per crear una conversa
function crear_conversa($usuari1_id, $usuari2_id) {
    global $conn;
    
    // Comprovar si ja existeix una conversa entre els dos usuaris
    $sql = "SELECT id FROM converses WHERE (usuari1_id = $usuari1_id AND usuari2_id = $usuari2_id) 
            OR (usuari1_id = $usuari2_id AND usuari2_id = $usuari1_id)";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Si ja existeix, retornem la conversa existent
        return $result->fetch_assoc()['id'];
    } else {
        // Si no existeix, creem una nova conversa
        $sql = "INSERT INTO converses (usuari1_id, usuari2_id) VALUES ($usuari1_id, $usuari2_id)";
        if ($conn->query($sql) === TRUE) {
            return $conn->insert_id; // Retornem l'ID de la nova conversa
        } else {
            return null;
        }
    }
}

// Funció per afegir un missatge
if (isset($_POST['missatge'], $_POST['usuari1_id'], $_POST['usuari2_id'])) {
    $usuari1_id = $_POST['usuari1_id'];
    $usuari2_id = $_POST['usuari2_id'];
    $missatge = $_POST['missatge'];

    // Crear o obtenir la conversa
    $conversa_id = crear_conversa($usuari1_id, $usuari2_id);
    
    if ($conversa_id) {
        $sql = "INSERT INTO missatges (conversa_id, usuari_id, missatge) VALUES ('$conversa_id', '$usuari1_id', '$missatge')";
        if ($conn->query($sql) === TRUE) {
            echo "Missatge enviat!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error creant la conversa.";
    }
}

// Recuperar els missatges de la conversa entre dos usuaris
if (isset($_GET['usuari1_id'], $_GET['usuari2_id'])) {
    $usuari1_id = $_GET['usuari1_id'];
    $usuari2_id = $_GET['usuari2_id'];

    // Obtenim l'ID de la conversa
    $conversa_id = crear_conversa($usuari1_id, $usuari2_id);

    // Recuperem els missatges d'aquesta conversa
    $sql = "SELECT m.missatge, m.data_missatge, u.nom_cognoms 
            FROM missatges m 
            JOIN usuaris u ON m.usuari_id = u.id
            WHERE m.conversa_id = $conversa_id ORDER BY m.data_missatge ASC";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div><strong>" . $row['nom_cognoms'] . ":</strong> " . $row['missatge'] . "<br><small>" . $row['data_missatge'] . "</small></div>";
        }
    } else {
        echo "No hi ha missatges";
    }
}

$conn->close();
?>

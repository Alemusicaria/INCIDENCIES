<?php
// Iniciar la sessió
session_start();

// Connexió a la base de dades
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apratc_Incidencies";

// Crear connexió
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar connexió
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Comprovar si l'usuari ha enviat el formulari
if (isset($_POST['correu'], $_POST['contrasenya'])) {
    $correu = $_POST['correu'];
    $contrasenya = $_POST['contrasenya'];

    // Preparar i executar la consulta per buscar l'usuari
    $sql = "SELECT * FROM usuaris WHERE correu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correu);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si l'usuari existeix
    if ($result->num_rows > 0) {
        // Agafar les dades de l'usuari
        $row = $result->fetch_assoc();

        // Comparar la contrasenya de text pla
        if ($contrasenya === $row['contrasenya']) {
            // Emmagatzemar l'ID de l'usuari a la sessió
            $_SESSION['id'] = $row['id'];
            $_SESSION['nom'] = $row['nom_cognoms'];

            // Redirigir a la pàgina de xat
            header('Location: xat.php');
            exit();
        } else {
            echo "Credencials incorrectes.";
        }
    } else {
        echo "Credencials incorrectes.";
    }
}

$conn->close();

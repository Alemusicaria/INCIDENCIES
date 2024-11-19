<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Agafem l'ID de la URL
$id_incidencia = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id_incidencia <= 0) {
    die("ID d'incidència no vàlid.");
}

// Connexió a la base de dades
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apratc_incidencies";

// Crear connexió
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Error de connexió a la base de dades.");
}

// Preparem la consulta per obtenir la incidència
$sql = "SELECT * FROM incidencies WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparant la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id_incidencia);
$stmt->execute();
$result = $stmt->get_result();

// Comprovem si la incidència existeix
if ($result->num_rows > 0) {
    $incidencia = $result->fetch_assoc(); // Obtenim la primera fila
} else {
    die("Incidència no trobada.");
}

$stmt->close();
$conn->close();
?>

<?php
include("layouts/header/header.php"); // Aquí se incluye la barra lateral
?>

<body>
    <div class="wrapper">
        <?php
        include("layouts/menu/menu.php"); // Aquí se incluye la barra lateral
        ?>
        <div class="main p-3">
            <div class="tittle-page">
                <h1>Detalls de la incidència</h1>
            </div>
            <?php
            include("layouts/Forms/V_MostrarInfo.php"); // Aquí se incluye la barra lateral
            ?>
        </div>
    </div>
    <?php
    include("layouts/footer/footer.php");
    ?>
</body>

</html>
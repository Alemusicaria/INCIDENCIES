<?php
session_start();
include('connexio.php');

// Comprovem si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$usuari_id = $_SESSION['id'];

// Comprovem si s'ha enviat el formulari per crear la conversa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuari_destinatari']) && !empty($_POST['usuari_destinatari'])) {
        $usuari_destinatari_id = $_POST['usuari_destinatari'];

        // Comprovar si ja existeix una conversa entre els dos usuaris
        $query = "
            SELECT id
            FROM xats
            WHERE (usuari1_id = ? AND usuari2_id = ?) 
               OR (usuari1_id = ? AND usuari2_id = ?)
        ";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "iiii", $usuari_id, $usuari_destinatari_id, $usuari_destinatari_id, $usuari_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                // Si ja existeix una conversa, redirigir a la conversa existent
                mysqli_stmt_bind_result($stmt, $xat_id);
                mysqli_stmt_fetch($stmt);
                header('Location: xat_detall.php?xat_id=' . $xat_id);
                exit();
            } else {
                // Si no existeix, crear una nova conversa
                $query = "
                    INSERT INTO xats (usuari1_id, usuari2_id)
                    VALUES (?, ?)
                ";

                if ($stmt = mysqli_prepare($conn, $query)) {
                    mysqli_stmt_bind_param($stmt, "ii", $usuari_id, $usuari_destinatari_id);
                    if (mysqli_stmt_execute($stmt)) {
                        // Redirigir a la nova conversa
                        $xat_id = mysqli_insert_id($conn);
                        header('Location: xat_detall.php?xat_id=' . $xat_id);
                        exit();
                    } else {
                        echo "Error al crear la conversa: " . mysqli_error($conn);
                    }
                }
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        echo "Has de seleccionar un usuari per crear la conversa.";
    }
}

// Obtenir llistat d'usuaris tècnics i professors
$query = "
    SELECT id, nom_cognoms
    FROM usuaris
    WHERE rol IN ('Professor', 'Tecnic') AND id != ? 
    ORDER BY nom_cognoms ASC
";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $usuari_id);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);
}

?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nova conversa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Crear nova conversa</h1>

        <form method="POST">
            <label for="usuari_destinatari">Selecciona un usuari:</label>
            <select name="usuari_destinatari" id="usuari_destinatari" required>
                <option value="">Selecciona un usuari</option>
                <?php while ($row = mysqli_fetch_assoc($resultat)): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nom_cognoms']; ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Crear conversa</button>
        </form>

        <a href="xat.php">Tornar a les converses</a>
    </div>
</body>

</html>

<?php
// Tancar la connexió a la base de dades
mysqli_close($conn);
?>
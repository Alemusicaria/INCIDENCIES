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
    $usuari_destinatari_id = $_POST['usuari_destinatari'];

    // Comprovar si ja existeix una conversa entre els dos usuaris
    $query = "
        SELECT id
        FROM xats
        WHERE (usuari1_id = $usuari_id AND usuari2_id = $usuari_destinatari_id) 
           OR (usuari1_id = $usuari_destinatari_id AND usuari2_id = $usuari_id)
    ";
    $resultat = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultat) > 0) {
        // Si ja existeix una conversa, redirigir a la conversa existent
        $row = mysqli_fetch_assoc($resultat);
        header('Location: xat_detall.php?xat_id=' . $row['id']);
        exit();
    } else {
        // Si no existeix, crear una nova conversa
        $query = "
            INSERT INTO xats (usuari1_id, usuari2_id)
            VALUES ($usuari_id, $usuari_destinatari_id)
        ";
        if (mysqli_query($conn, $query)) {
            // Redirigir a la nova conversa
            $xat_id = mysqli_insert_id($conn);
            header('Location: xat_detall.php?xat_id=' . $xat_id);
            exit();
        } else {
            echo "Error al crear la conversa: " . mysqli_error($conn);
        }
    }
}

// Obtenir llistat d'usuaris tècnics i professors
$query = "
    SELECT id, nom_cognoms
    FROM usuaris
    WHERE rol IN ('Professor', 'Tecnic') AND id != $usuari_id
";
$resultat = mysqli_query($conn, $query);

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
            <select name="usuari_destinatari" id="usuari_destinatari">
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
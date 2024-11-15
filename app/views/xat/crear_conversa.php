<?php
session_start();
include('connexio.php');

// Comprovem si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$usuari_id = $_SESSION['id'];

// Buscar usuaris per mostrar-los en la llista
$query_usuaris = "SELECT id, nom_cognoms FROM usuaris WHERE id != $usuari_id";
$resultat_usuaris = mysqli_query($conn, $query_usuaris);

// Buscar usuaris amb una cerca
if (isset($_POST['cerca'])) {
    $cerca = mysqli_real_escape_string($conn, $_POST['cerca']);
    $query_usuaris = "SELECT id, nom_cognoms FROM usuaris WHERE id != $usuari_id AND nom_cognoms LIKE '%$cerca%'";
    $resultat_usuaris = mysqli_query($conn, $query_usuaris);
}

// Crear un xat nou quan l'usuari fa clic en un usuari
if (isset($_GET['usuari_id'])) {
    $usuari_destinatari = $_GET['usuari_id'];

    // Comprovar si ja existeix un xat entre els dos usuaris
    $query_xat = "SELECT id FROM xats WHERE (usuari1_id = $usuari_id AND usuari2_id = $usuari_destinatari) OR (usuari1_id = $usuari_destinatari AND usuari2_id = $usuari_id)";
    $resultat_xat = mysqli_query($conn, $query_xat);
    $xat = mysqli_fetch_assoc($resultat_xat);

    // Si no existeix el xat, crear-lo
    if (!$xat) {
        $query_crear_xat = "INSERT INTO xats (usuari1_id, usuari2_id) VALUES ($usuari_id, $usuari_destinatari)";
        mysqli_query($conn, $query_crear_xat);
        $xat_id = mysqli_insert_id($conn); // ID del nou xat

        // Redirigir a la pàgina del xat amb el nou xat creat
        header("Location: xat_detall.php?xat_id=$xat_id");
        exit();
    } else {
        // Si el xat ja existeix, redirigir directament al xat
        header("Location: xat_detall.php?xat_id=" . $xat['id']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Conversa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Crea una nova conversa</h1>
            <form action="tancar_sessio.php" method="post">
                <button class="logout-btn" type="submit">Tancar sessió</button>
            </form>
        </header>

        <section class="cerca-usuari">
            <form method="POST">
                <input type="text" name="cerca" placeholder="Cerca usuaris..." required>
                <button type="submit">Cercar</button>
            </form>
        </section>

        <section class="llista-usuari">
            <ul>
                <?php while ($usuari = mysqli_fetch_assoc($resultat_usuaris)): ?>
                    <li>
                        <a href="crear_conversa.php?usuari_id=<?php echo $usuari['id']; ?>">
                            <?php echo htmlspecialchars($usuari['nom_cognoms']); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>

        <a href="xat.php">Tornar a les converses</a>
    </div>
</body>

</html>
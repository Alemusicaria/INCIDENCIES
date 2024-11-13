<?php
session_start();
include('connexio.php');

// Comprovem si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$usuari_id = $_SESSION['id'];

// Comprovem que 'conversa_id' està definit a la URL
if (isset($_GET['conversa_id'])) {
    $conversa_id = $_GET['conversa_id'];

    // Comprovem si la conversa existeix
    $query_conversa = "
        SELECT id, usuari1_id, usuari2_id 
        FROM converses_privades
        WHERE id = $conversa_id AND (usuari1_id = $usuari_id OR usuari2_id = $usuari_id)
    ";
    $resultat_conversa = mysqli_query($conn, $query_conversa);
    $conversa = mysqli_fetch_assoc($resultat_conversa);

    if (!$conversa) {
        echo "Conversa no trobada o no autoritzat a veure-la.";
        exit();
    }

    // Obtenir els missatges de la conversa
    $query_missatges = "
        SELECT m.missatge, m.data, u.nom_cognoms
        FROM missatges m
        JOIN usuaris u ON m.usuari_id = u.id
        WHERE m.conversa_id = $conversa_id
        ORDER BY m.data ASC
    ";
    $resultat_missatges = mysqli_query($conn, $query_missatges);
} else {
    echo "Conversa no trobada.";
    exit();
}

// Afegir un missatge a la conversa privada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['missatge'])) {
    $missatge = mysqli_real_escape_string($conn, $_POST['missatge']);

    $query_inserir = "
        INSERT INTO missatges (conversa_id, usuari_id, missatge, data)
        VALUES ($conversa_id, $usuari_id, '$missatge', NOW())
    ";

    if (mysqli_query($conn, $query_inserir)) {
        header("Location: xat_detall.php?conversa_id=$conversa_id");
        exit();
    } else {
        echo "Error al enviar el missatge: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xat Privat</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Xat amb <?php echo get_nom_conversa($conversa, $conn); ?></h1>
            <form action="tancar_sessio.php" method="post">
                <button class="logout-btn" type="submit">Tancar sessió</button>
            </form>
        </header>

        <!-- Missatges del xat privat -->
        <section class="missatges">
            <?php if (isset($resultat_missatges) && mysqli_num_rows($resultat_missatges) > 0): ?>
                <ul>
                    <?php while ($missatge = mysqli_fetch_assoc($resultat_missatges)): ?>
                        <li>
                            <strong><?php echo $missatge['nom_cognoms']; ?>:</strong>
                            <p><?php echo $missatge['missatge']; ?></p>
                            <small><?php echo date("d/m/Y H:i", strtotime($missatge['data'])); ?></small>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No hi ha missatges en aquest xat.</p>
            <?php endif; ?>
        </section>

        <!-- Formulari per enviar un missatge -->
        <section class="enviar-missatge">
            <form method="POST">
                <textarea name="missatge" placeholder="Escriu el teu missatge aquí..." required></textarea>
                <button type="submit">Enviar missatge</button>
            </form>
        </section>

        <a href="xat.php">Tornar a la llista de converses</a>
    </div>
</body>

</html>

<?php
// Funció per obtenir el nom de l'usuari amb qui estàs xatejant
function get_nom_conversa($conversa, $conn)
{
    $usuari_id = ($conversa['usuari1_id'] == $_SESSION['id']) ? $conversa['usuari2_id'] : $conversa['usuari1_id'];
    $query = "SELECT nom_cognoms FROM usuaris WHERE id = $usuari_id";
    $resultat = mysqli_query($conn, $query);
    $usuari = mysqli_fetch_assoc($resultat);
    return $usuari['nom_cognoms'];
}
?>
<?php
session_start();
include('connexio.php');

// Comprovem si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$usuari_id = $_SESSION['id'];

// Obtenim l'ID de l'usuari des de la URL
if (isset($_GET['usuari_id'])) {
    $usuari_id_destinatari = $_GET['usuari_id'];

    // Obtenir el nom de l'usuari destinatari
    $query_usuari = "SELECT nom_cognoms FROM usuaris WHERE id = $usuari_id_destinatari";
    $resultat_usuari = mysqli_query($conn, $query_usuari);
    if ($resultat_usuari) {
        $usuari_destinatari = mysqli_fetch_assoc($resultat_usuari);
    } else {
        echo "Error en la consulta per obtenir l'usuari.";
        exit();
    }

    if (!$usuari_destinatari) {
        echo "Usuari no trobat.";
        exit();
    }

    // Obtenir els missatges entre l'usuari logejat i el destinatari
    $query_missatges = "
    SELECT m.missatge, m.data, u.nom_cognoms
    FROM missatges m
    JOIN usuaris u ON m.usuari_id = u.id
    WHERE (m.usuari_id = $usuari_id AND m.destinatari_id = $usuari_id_destinatari)
    OR (m.usuari_id = $usuari_id_destinatari AND m.destinatari_id = $usuari_id)
    ORDER BY m.data ASC
";
    $resultat_missatges = mysqli_query($conn, $query_missatges);

    if (!$resultat_missatges) {
        echo "Error en la consulta dels missatges: " . mysqli_error($conn);
        exit();
    }
}

// Afegir un missatge a la base de dades
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['missatge'])) {
    $missatge = mysqli_real_escape_string($conn, $_POST['missatge']);

    $query_inserir = "
        INSERT INTO missatges (usuari_id, destinatari_id, missatge, data)
        VALUES ($usuari_id, $usuari_id_destinatari, '$missatge', NOW())
    ";

    if (mysqli_query($conn, $query_inserir)) {
        header("Location: usuari_detall.php?usuari_id=$usuari_id_destinatari");
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
    <title>Usuari - Detall</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Conversant amb: <?php echo $usuari_destinatari['nom_cognoms']; ?></h1>
            <form action="tancar_sessio.php" method="post">
                <button class="logout-btn" type="submit">Tancar sessió</button>
            </form>
        </header>

        <!-- Missatges amb l'usuari -->
        <section class="missatges">
            <?php if (mysqli_num_rows($resultat_missatges) > 0): ?>
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
                <p>No hi ha missatges amb aquest usuari.</p>
            <?php endif; ?>
        </section>

        <!-- Formulari per enviar un missatge -->
        <section class="enviar-missatge">
            <form method="POST">
                <textarea name="missatge" placeholder="Escriu el teu missatge aquí..." required></textarea>
                <button type="submit">Enviar missatge</button>
            </form>
        </section>

        <a href="xat.php">Tornar a les converses</a>
    </div>
</body>

</html>
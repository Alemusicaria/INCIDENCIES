<?php
session_start();
include('connexio.php');

// Comprovem si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$usuari_id = $_SESSION['id'];

// Obtenim l'ID del grup des de la URL
if (isset($_GET['grup_id'])) {
    $grup_id = $_GET['grup_id'];

    // Obtenir el nom del grup
    $query_grup = "SELECT nom FROM grups WHERE id = $grup_id";
    $resultat_grup = mysqli_query($conn, $query_grup);
    $grup = mysqli_fetch_assoc($resultat_grup);

    if (!$grup) {
        echo "Grup no trobat.";
        exit();
    }

    // Obtenir els missatges del grup
    $query_missatges = "
        SELECT m.missatge, m.data, u.nom_cognoms
        FROM missatges m
        JOIN usuaris u ON m.usuari_id = u.id
        WHERE m.grup_id = $grup_id
        ORDER BY m.data ASC
    ";
    $resultat_missatges = mysqli_query($conn, $query_missatges);
}

// Afegir un missatge a la base de dades
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['missatge'])) {
    $missatge = mysqli_real_escape_string($conn, $_POST['missatge']);

    $query_inserir = "
        INSERT INTO missatges (grup_id, usuari_id, missatge, data)
        VALUES ($grup_id, $usuari_id, '$missatge', NOW())
    ";

    if (mysqli_query($conn, $query_inserir)) {
        header("Location: grup_detall.php?grup_id=$grup_id");
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
    <title>Grup - Detall</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Grup: <?php echo $grup['nom']; ?></h1>
            <form action="tancar_sessio.php" method="post">
                <button class="logout-btn" type="submit">Tancar sessió</button>
            </form>
        </header>

        <!-- Missatges del grup -->
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
                <p>No hi ha missatges en aquest grup.</p>
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
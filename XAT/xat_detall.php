<?php
session_start();
include('connexio.php');

// Comprovem si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$usuari_id = $_SESSION['id'];

// Obtenim l'ID del xat des de la URL
if (isset($_GET['xat_id'])) {
    $xat_id = $_GET['xat_id'];

    // Obtenir el nom de l'altre usuari en el xat
    $query_conversant = "
    SELECT CASE 
               WHEN x.usuari1_id = ? THEN u2.nom_cognoms
               ELSE u1.nom_cognoms
           END AS usuari_conversant
    FROM xats x
    JOIN usuaris u1 ON x.usuari1_id = u1.id
    JOIN usuaris u2 ON x.usuari2_id = u2.id
    WHERE x.id = ? AND (x.usuari1_id = ? OR x.usuari2_id = ?)
    ";

    $stmt = mysqli_prepare($conn, $query_conversant);
    mysqli_stmt_bind_param($stmt, 'iiii', $usuari_id, $xat_id, $usuari_id, $usuari_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $conversant = mysqli_fetch_assoc($result);

    if (!$conversant) {
        echo "Xat no trobat.";
        exit();
    }

    // Obtenir els missatges del xat
    $query_missatges = "
        SELECT m.missatge, m.data, u.nom_cognoms
        FROM missatges m
        JOIN usuaris u ON m.usuari_id = u.id
        WHERE m.xat_id = ?
        ORDER BY m.data ASC
    ";

    $stmt_missatges = mysqli_prepare($conn, $query_missatges);
    mysqli_stmt_bind_param($stmt_missatges, 'i', $xat_id);
    mysqli_stmt_execute($stmt_missatges);
    $resultat_missatges = mysqli_stmt_get_result($stmt_missatges);
}

// Afegir un missatge a la base de dades
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['missatge'])) {
    $missatge = mysqli_real_escape_string($conn, $_POST['missatge']);

    $query_inserir = "
        INSERT INTO missatges (xat_id, usuari_id, missatge, data)
        VALUES (?, ?, ?, NOW())
    ";

    $stmt_inserir = mysqli_prepare($conn, $query_inserir);
    mysqli_stmt_bind_param($stmt_inserir, 'iis', $xat_id, $usuari_id, $missatge);

    if (mysqli_stmt_execute($stmt_inserir)) {
        header("Location: xat_detall.php?xat_id=$xat_id");
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
    <title>Conversació amb <?php echo $conversant['usuari_conversant']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Conversació amb: <?php echo $conversant['usuari_conversant']; ?></h1>
            <form action="tancar_sessio.php" method="post">
                <button class="logout-btn" type="submit">Tancar sessió</button>
            </form>
        </header>

        <!-- Missatges del xat -->
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
                <p>No hi ha missatges en aquesta conversa.</p>
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
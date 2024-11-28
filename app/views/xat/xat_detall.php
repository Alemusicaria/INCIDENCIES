<?php
require_once 'app/models/connexio.php';
$usuari_id = $_SESSION['usuari'][0];

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
        WHERE m.xat_id = $xat_id
        ORDER BY m.data ASC
    ";

    $resultat_missatges = mysqli_query($conn, $query_missatges);
}

// Afegir un missatge a la base de dades
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['missatge'])) {
    $missatge = mysqli_real_escape_string($conn, $_POST['missatge']);

    $query_inserir = "
        INSERT INTO missatges (xat_id, usuari_id, missatge, data)
        VALUES ($xat_id, $usuari_id, '$missatge', NOW())
    ";

    if (mysqli_query($conn, $query_inserir)) {
        header("Location: index.php?controller=Login&method=xat_detall&xat_id=$xat_id");
        exit();
    } else {
        echo "Error al enviar el missatge: " . mysqli_error($conn);
    }
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php include("app/views/layouts/header/header.php"); ?>
<link rel="stylesheet" href="public/css/styleXat.css">
<style>
    .btn-chat {
        display: none;
    }
</style>

<body>
    <div class="wrapper">

        <?php
        include("app/views/layouts/menu/menu.php");
        ?>

        <main class="main">
            <div class="fondo-xatamb">
                <a href="index.php?controller=Login&method=xat" class="volver-icono">
                    <i class="lni lni-chevron-left"></i>
                </a>

                <h1><?php echo $conversant['usuari_conversant']; ?></h1>
            </div>

            <div class="p-3">
                <!-- Missatges del xat -->
                <section class="missatges">
                    <?php if (mysqli_num_rows($resultat_missatges) > 0): ?>
                        <ul>
                            <?php while ($missatge = mysqli_fetch_assoc($resultat_missatges)): ?>
                                <li>
                                    <strong><?php echo $missatge['nom_cognoms']; ?></strong>
                                    <p><?php echo $missatge['missatge']; ?></p>
                                    <small><?php echo date("d/m/Y H:i", strtotime($missatge['data'])); ?></small>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <p>No hi ha missatges en aquest grup.</p>
                    <?php endif; ?>
                </section>
            </div>

            <!-- Formulari per enviar un missatge -->
            <section class="enviar-missatge">
                <form method="POST">
                    <textarea name="missatge" row="1" placeholder="Escriu el teu missatge aquí..." required></textarea>
                    <button type="submit">
                        <i class="lni lni-telegram-original"></i>
                    </button>
                </form>
            </section>
        </main>

        <!--
        <main class="main p-3">
            <header>
                <h1><?php echo $conversant['usuari_conversant']; ?></h1>
            </header>

            <-- Missatges del xat --
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

            <-- Formulari per enviar un missatge --
            <section class="enviar-missatge">
                <form method="POST">
                    <textarea name="missatge" placeholder="Escriu el teu missatge aquí..." required></textarea>
                    <button type="submit">Enviar missatge</button>
                </form>
            </section>

            <a href="index.php?controller=Login&method=xat" class="btn btn-primary">Tornar a les converses</a>
        </main> -->
    </div>
</body>

</html>
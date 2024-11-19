<?php
        require_once 'app\models\connexio.php';

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
        header("Location: index.php?controller=Login&method=grup_detall&grup_id=$grup_id");
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

<body>
    <div class="wrapper">
        <?php include("app/views/layouts/menu/menu.php"); ?>
        <main class="main p-3">
            <header>
                <h1>Grup: <?php echo $grup['nom']; ?></h1>
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

            <a href="index.php?controller=Login&method=xat" class="btn btn-primary">Tornar a les converses</a>
        </main>
    </div>
</body>

</html>
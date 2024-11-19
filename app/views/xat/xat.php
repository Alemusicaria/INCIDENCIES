<?php
session_start();
include('connexio.php');

// Comprovem si l'usuari està logejat
if (!isset($_SESSION['id'])) {
    header('Location: login.html');
    exit();
}

$usuari_id = $_SESSION['id'];

// Inicialitzem les variables per a les converses i els grups
$resultat_converses = false;
$resultat_grups = false;

// Cercar xats i grups de forma dinàmica
if (isset($_GET['cerca'])) {
    $cerca = $_GET['cerca'];
    $query_converses = "
    SELECT x.id, 
           CASE 
               WHEN x.usuari1_id = ? THEN u2.nom_cognoms
               ELSE u1.nom_cognoms
           END AS usuari_conversant
    FROM xats x
    JOIN usuaris u1 ON x.usuari1_id = u1.id
    JOIN usuaris u2 ON x.usuari2_id = u2.id
    WHERE (x.usuari1_id = ? OR x.usuari2_id = ?)
    AND (u1.nom_cognoms LIKE ? OR u2.nom_cognoms LIKE ?)
";
    $stmt = mysqli_prepare($conn, $query_converses);
    $cerca = '%' . $cerca . '%';  // Afegir comodins per la cerca
    mysqli_stmt_bind_param($stmt, 'iiiss', $usuari_id, $usuari_id, $usuari_id, $cerca, $cerca);
    mysqli_stmt_execute($stmt);
    $resultat_converses = mysqli_stmt_get_result($stmt);

    $query_grups = "
        SELECT g.id, g.nom
        FROM grups g
        JOIN membres_grup mg ON g.id = mg.grup_id
        WHERE mg.usuari_id = $usuari_id
        AND g.nom LIKE '%$cerca%'
    ";
    $resultat_grups = mysqli_query($conn, $query_grups);
} else {
    // Consulta per obtenir tots els xats de l'usuari
    $query_converses = "
    SELECT x.id, 
           CASE 
               WHEN x.usuari1_id = ? THEN u2.nom_cognoms
               ELSE u1.nom_cognoms
           END AS usuari_conversant
    FROM xats x
    JOIN usuaris u1 ON x.usuari1_id = u1.id
    JOIN usuaris u2 ON x.usuari2_id = u2.id
    WHERE (x.usuari1_id = ? OR x.usuari2_id = ?)
    ";
    $stmt = mysqli_prepare($conn, $query_converses);
    mysqli_stmt_bind_param($stmt, 'iii', $usuari_id, $usuari_id, $usuari_id);
    mysqli_stmt_execute($stmt);
    $resultat_converses = mysqli_stmt_get_result($stmt);

    // Consulta per obtenir tots els grups de l'usuari
    $query_grups = "
        SELECT g.id, g.nom
        FROM grups g
        JOIN membres_grup mg ON g.id = mg.grup_id
        WHERE mg.usuari_id = $usuari_id
    ";
    $resultat_grups = mysqli_query($conn, $query_grups);
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
include("app/views/layouts/header/header.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les meves converses i grups</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Funció per fer la cerca de manera dinàmica amb AJAX
        function cercar() {
            var cerca = document.getElementById("cercador").value;

            // Enviar la petició AJAX
            $.ajax({
                url: 'xat.php',
                type: 'GET',
                data: {
                    cerca: cerca
                },
                success: function(response) {
                    // Actualitzar el contingut de les converses i grups
                    $('#usuaris').html($(response).find('#usuaris').html());
                    $('#grups').html($(response).find('#grups').html());
                }
            });
        }
    </script>
</head>

<body>
    <div class="container">
        <header>
            <h1>Converses i grups</h1>
            <form action="tancar_sessio.php" method="post">
                <button class="logout-btn" type="submit">Tancar sessió</button>
            </form>
        </header>

        <!-- Cercador dinàmic -->
        <section class="cercador">
            <input type="text" id="cercador" placeholder="Cerca una conversa o grup" oninput="cercar()">
            <a href="crear_conversa.php" class="crear-xat-btn">
                <img src="../Images/Login/Fondo1.png" alt="Crear Xat" style="width:50px">
            </a>
        </section>

        <!-- Converses individuals -->
        <section class="converses" id="usuaris">
            <h3>Xats</h3>
            <?php if ($resultat_converses && mysqli_num_rows($resultat_converses) > 0): ?>
                <ul>
                    <?php while ($row = mysqli_fetch_assoc($resultat_converses)): ?>
                        <li>
                            <a href="xat_detall.php?xat_id=<?php echo $row['id']; ?>">
                                <?php echo $row['usuari_conversant']; ?>
                            </a>
                        </li>

                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No tens converses actives.</p>
            <?php endif; ?>
        </section>

        <!-- Grups -->
        <section class="converses" id="grups">
            <h3>Grups</h3>
            <?php if ($resultat_grups && mysqli_num_rows($resultat_grups) > 0): ?>
                <ul>
                    <?php while ($row = mysqli_fetch_assoc($resultat_grups)): ?>
                        <li>
                            <a href="grup_detall.php?grup_id=<?php echo $row['id']; ?>">
                                <?php echo $row['nom']; ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No tens grups creats.</p>
            <?php endif; ?>
        </section>
    </div>
</body>

</html>
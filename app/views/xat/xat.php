<?php
require_once 'app/models/connexio.php';

$usuari_id = $_SESSION['usuari'][0];
$resultat_converses = false;
$resultat_grups = false;

// Cercar xats i grups de forma dinàmica
if (isset($_GET['cerca'])) {
    $cerca = '%' . $_GET['cerca'] . '%';
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
    mysqli_stmt_bind_param($stmt, 'iiiss', $usuari_id, $usuari_id, $usuari_id, $cerca, $cerca);
    mysqli_stmt_execute($stmt);
    $resultat_converses = mysqli_stmt_get_result($stmt);

    $query_grups = "
        SELECT g.id, g.nom
        FROM grups g
        JOIN membres_grup mg ON g.id = mg.grup_id
        WHERE mg.usuari_id = ?
        AND g.nom LIKE ?
    ";
    $stmt_grups = mysqli_prepare($conn, $query_grups);
    mysqli_stmt_bind_param($stmt_grups, 'is', $usuari_id, $cerca);
    mysqli_stmt_execute($stmt_grups);
    $resultat_grups = mysqli_stmt_get_result($stmt_grups);
} else {
    $query_converses = "
    SELECT x.id, 
           CASE 
               WHEN x.usuari1_id = ? THEN u2.nom_cognoms
               ELSE u1.nom_cognoms
           END AS usuari_conversant
    FROM xats x
    JOIN usuaris u1 ON x.usuari1_id = u1.id
    JOIN usuaris u2 ON x.usuari2_id = u2.id
    WHERE x.usuari1_id = ? OR x.usuari2_id = ?
    ";
    $stmt = mysqli_prepare($conn, $query_converses);
    mysqli_stmt_bind_param($stmt, 'iii', $usuari_id, $usuari_id, $usuari_id);
    mysqli_stmt_execute($stmt);
    $resultat_converses = mysqli_stmt_get_result($stmt);

    $query_grups = "
        SELECT g.id, g.nom
        FROM grups g
        JOIN membres_grup mg ON g.id = mg.grup_id
        WHERE mg.usuari_id = ?
    ";
    $stmt_grups = mysqli_prepare($conn, $query_grups);
    mysqli_stmt_bind_param($stmt_grups, 'i', $usuari_id);
    mysqli_stmt_execute($stmt_grups);
    $resultat_grups = mysqli_stmt_get_result($stmt_grups);
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php include("app/views/layouts/header/header.php"); ?>
<link rel="stylesheet" href="public/css/styleXat.css?v=1">

<body>
    <div class="wrapper">

        <?php
        include("app/views/layouts/menu/menu.php");
        ?>

        <main class="main">

            <!-- Fondo de la Imatge -->
            <div class="fondo-xat">
                <div class="text-chat">
                    <label>Chat</label>
                </div>
            </div>

            <header class="header">
                <h1>Les meves converses i grups</h1>
            </header>

            <!-- Cercador dinàmic -->
            <section class="cercador">
                <input type="text" id="cercador" class="cercador-input" placeholder="Cerca una conversa o grup" oninput="cercar()">
                <a href="crear_conversa.php" class="crear-xat-btn btn btn-primary"> Crear XAT </a>
            </section>

            <!-- Converses individuals -->
            <section class="converses" id="usuaris">
                <h3>Xats</h3>
                <?php if ($resultat_converses && mysqli_num_rows($resultat_converses) > 0): ?>
                    <ul>
                        <?php while ($row = mysqli_fetch_assoc($resultat_converses)): ?>
                            <li>
                                <a href="index.php?controller=Login&method=xat_detall&xat_id=<?php echo $row['id']; ?>">
                                    <?php echo htmlspecialchars($row['usuari_conversant']); ?>
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
                                <a href="index.php?controller=Login&method=grup_detall&grup_id=<?php echo $row['id']; ?>">
                                    <?php echo htmlspecialchars($row['nom']); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No tens grups creats.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function cercar() {
            var cerca = document.getElementById("cercador").value;
            $.ajax({
                url: 'xat.php',
                type: 'GET',
                data: {
                    cerca: cerca
                },
                success: function(response) {
                    $('#usuaris').html($(response).find('#usuaris').html());
                    $('#grups').html($(response).find('#grups').html());
                }
            });
        }
    </script>
</body>

</html>
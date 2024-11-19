<?php
include('connexio.php');
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

<body>
    <div class="wrapper">
        <?php include("app/views/layouts/menu/menu.php"); ?>
        <main class="main p-3">
            <header>
                <h1>Xat amb <?php echo $conversant['usuari_conversant']; ?></h1>
            </header>

            <!-- Missatges del xat -->
            <section class="missatges" id="missatges">
                <!-- Els missatges es carregaran dinàmicament -->
            </section>

            <!-- Formulari per enviar un missatge -->
            <section class="enviar-missatge">
                <form id="formulari_missatge">
                    <textarea name="missatge" placeholder="Escriu el teu missatge aquí..." required></textarea>
                    <button type="submit">Enviar missatge</button>
                </form>
            </section>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            // Carregar els missatges inicials
            loadMessages();

            // Enviar un missatge
            $('#formulari_missatge').submit(function(event) {
                event.preventDefault();
                var missatge = $('textarea[name="missatge"]').val();

                $.ajax({
                    url: 'enviar_missatge.php',
                    method: 'POST',
                    data: {
                        missatge: missatge,
                        xat_id: <?php echo $xat_id; ?>
                    },
                    success: function(response) {
                        // Un cop enviat, actualitzar la llista de missatges
                        loadMessages();
                        $('textarea[name="missatge"]').val(''); // Netejar el text input
                    }
                });
            });

            // Funció per carregar els missatges
            function loadMessages() {
                $.ajax({
                    url: 'carregar_missatges.php',
                    method: 'GET',
                    data: {
                        xat_id: <?php echo $xat_id; ?>
                    },
                    success: function(response) {
                        $('#missatges').html(response); // Afegir els missatges al contingut de la pàgina
                    }
                });
            }

            // Opcional: refrescar cada cert temps per actualitzar els missatges (per exemple, cada 3 segons)
            setInterval(loadMessages, 3000); // Actualitza cada 3 segons
        });
    </script>
</body>

</html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once 'app/models/connexio.php'; // Connexió a la base de dades

// Inicialitzar valors per defecte
$id_usuari = $_SESSION['usuari'][0] ?? null;
$nom = $_SESSION['usuari'][1] ?? 'Usuari desconegut';
$correu = "Desconegut";
$nombre_incidencies = 0;
$perfil_imatge = "perfil.png"; // Imatge per defecte

if ($id_usuari) {
    // Consulta SQL per obtenir el correu, nombre d'incidències i la imatge de perfil
    $sql = "
        SELECT 
            u.correu AS correu,
            COUNT(i.id) AS nombre_incidencies,
            u.foto AS foto
        FROM 
            usuaris u
        LEFT JOIN 
            incidencies i 
        ON 
            u.id = i.id_usuari
        WHERE 
            u.id = ?
        GROUP BY 
            u.id, u.correu, u.foto
    ";

    if ($stmt = $conn->prepare($sql)) {
        // Enllaçar paràmetre
        $stmt->bind_param('i', $id_usuari);
        $stmt->execute();
        $result = $stmt->get_result(); // Obtenir resultats

        if ($row = $result->fetch_assoc()) {
            $correu = $row['correu'];
            $nombre_incidencies = $row['nombre_incidencies'];
            $perfil_imatge = $row['foto'] ?? 'perfil.png'; // Si no hi ha foto, utilitzar la per defecte
        }

         $stmt->close(); // Tancar la consulta preparada
    } else {
        die("Error en preparar la consulta: " . $conn->error);
    }
}

include("layouts/header/header.php"); // Incloure el header
?>

<body>
    <div class="wrapper">
        <?php
        include("layouts/menu/menu.php"); // Incloure la barra lateral
        ?>

        <!-- Contingut principal del perfil -->
        <div class="main">
            <!-- Fondo de la Imatge -->
            <div class="fondo-perfil">
                <!-- Imatge de Perfil -->
                <div class="perfil-img mb-3">
                    <img src="<?php echo $perfil_imatge; ?>" alt="Perfil" class="perfil-img">
                </div>

                <a href="#">Cambiar foto de perfil</a>
            </div>

            <!-- Dades de l'usuari -->
            <div class="card m-4">
                <div class="card-header">
                    <i class="lni lni-user"></i>
                    Dades de l'Usuari
                </div>

                <div class="card-body">
                    <div class="mb-2">
                        <label for="nom" class="perfil-label">Nom i cognoms</label>
                        <input id="nom" type="text" class="form-control" value="<?php echo htmlspecialchars($nom); ?>" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="correu" class="perfil-label">Correu Electrònic</label>
                        <input id="correu" type="text" class="form-control" value="<?php echo htmlspecialchars($correu); ?>" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="incidencies" class="perfil-label">Nombre d'Incidències Creades</label>
                        <input id="incidencies" type="text" class="form-control" value="<?php echo htmlspecialchars($nombre_incidencies); ?>" readonly>
                    </div>
                </div>
            </div>

            <!-- Botó per tornar a l'inici -->
            <div class="text-center mt-4 mb-4">
                <a href="index.php?controller=Login&method=bienvenido" class="btn" id="volver">Torna a l'inici</a>
            </div>
        </div>
    </div>
</body>

</html>
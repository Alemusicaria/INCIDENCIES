<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'app/models/connexio.php'; // Connexió a la base de dades

// Inicialitzar valors per defecte
$id_usuari = $_SESSION['id'] ?? null;
$nom = $_SESSION['usuario'] ?? 'Usuari desconegut';
$correu = "Desconegut";
$nombre_incidencies = 0;

if ($id_usuari) {
    // Consulta SQL per obtenir el correu i el nombre d'incidències
    $sql = "
        SELECT 
            u.correu AS correu,
            COUNT(i.id) AS nombre_incidencies
        FROM 
            usuaris u
        LEFT JOIN 
            incidencies i 
        ON 
            u.id = i.id_usuari
        WHERE 
            u.id = ?
        GROUP BY 
            u.id, u.correu
    ";

    if ($stmt = $conn->prepare($sql)) {
        // Enllaçar paràmetre
        $stmt->bind_param('i', $id_usuari);
        $stmt->execute();
        $result = $stmt->get_result(); // Obtenir resultats

        if ($row = $result->fetch_assoc()) {
            $correu = $row['correu'];
            $nombre_incidencies = $row['nombre_incidencies'];
        }

        $stmt->close(); // Tancar la consulta preparada
    } else {
        die("Error en preparar la consulta: " . $conn->error);
    }
}

include("layouts/header/header.php"); // Aquí se incluye el header
?>

<body>
    <div class="wrapper">
        <?php
        include("layouts/menu/menu.php"); // Aquí se incluye la barra lateral
        ?>

        <!-- Contingut principal del perfil -->
        <div class="main">
            <!-- Fondo de la Imagen -->
            <div class="fondo-perfil">
                <!-- Imagen de Perfil -->
                <div class="perfil-img mb-3">
                    <img src="Images/Login/perfil.png" alt="Perfil" class="perfil-img">
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
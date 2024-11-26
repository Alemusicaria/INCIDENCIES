<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
include("app/views/layouts/header/header.php"); // Aquí se incluye la barra lateral
?>

<body>
    <div class="wrapper">
        <?php
        include("app/views/layouts/menu/menu.php"); // Aquí se incluye la barra lateral
        ?>

        <div class="main p-3">
            <div class="tittle-page">
                <h2>Totes les Incidències</h2>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Taula d'incidencies
                </div>

                <div class="card-body">
                    <!-- Contenedor para permitir scroll horizontal -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titol</th>
                                    <th>Creador</th>
                                    <th>Descripcio</th>
                                    <th>Tipus Incidència</th>
                                    <th>Id Ubicacion</th>
                                    <th>Data Incidencia</th>
                                    <th>Estat</th>
                                    <th>Prioritat</th>
                                    <th>Imatges</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once('app/models/connexio.php');


                                // ID de l'usuari autenticat
                                $idUsuari = $_SESSION['usuari'][0]; // Assegura't que tens aquesta variable definida

                                // Consulta per obtenir les incidències de l'usuari
                                $sql = "SELECT id, creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, estat, prioritat, imatges 
                                FROM incidencies
                                WHERE habilitado = 1";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                // Comprovar si hi ha resultats
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . htmlspecialchars($row['titol_fallo']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['creador_nom_cognoms']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['descripcio']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['tipus_incidencia']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['id_ubicacio']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['data_incidencia']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['estat']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['prioritat']) . "</td>";
                                        // Imatges
                                        echo "<td>";
                                        if (!empty($row['imatges'])) {
                                            $imatges = explode(',', $row['imatges']);
                                            foreach ($imatges as $imatge) {
                                                echo "<img src='$imatge' class='img-thumbnail' width='100' height='100'>";
                                            }
                                        } else {
                                            echo "No hi ha imatges";
                                        }
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>No hi ha incidències creades per aquest usuari.</td></tr>";
                                }

                                $stmt->close();
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
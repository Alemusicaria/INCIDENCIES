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

            <div class="espacio-grande">
                <div class="espacio-medio">

                    <!-- Tarjeta 1 -->
                    <?php
                    require_once('app/models/connexio.php');

                    // ID de l'usuari autenticat
                    $idUsuari = $_SESSION['usuari'][0]; // Asegúrate de tener esta variable definida

                    // Consulta per obtenir les incidències de l'usuari
                    $sql = "SELECT id, creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, estat, prioritat, imatges 
                            FROM incidencies
                            WHERE habilitado = 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Comprovar si hi ha resultats
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc())    {
                            // Datos de la incidencia
                            $id = $row['id'];
                            $creador = $row['creador_nom_cognoms'];
                            $titol = $row['titol_fallo'];
                            $descripcio = $row['descripcio'];
                            $tipus = $row['tipus_incidencia'];
                            $ubicacio = $row['id_ubicacio'];
                            $data = $row['data_incidencia'];
                            $estat = $row['estat'];
                            $prioritat = $row['prioritat'];
                            $imatge = $row['imatges'] ?: 'Images/imgpreg.png'; // Imagen predeterminada si no hay

                            // Renderizar la tarjeta
                            echo "
                            <div class='card mb-3' style='width: 18rem;'>
                                <img class='card-img-top' src='$imatge' alt='Imatge de la incidència'>

                                <!-- Contenido de la tarjeta -->
                                <div class='card-body'>
                                    <h5 class='card-title'><strong>$titol</strong></h5>
                                    <p class='card-text'>$descripcio</p>
                                </div>

                                <!-- Información adicional -->
                                <ul class='list-group list-group-flush'>
                                    <li class='list-group-item'><strong>Usuari: </strong>$creador</li>
                                    <li class='list-group-item'><strong>Tipus: </strong>$tipus</li>
                                    <li class='list-group-item'><strong>Ubicació: </strong>$ubicacio</li>
                                    <li class='list-group-item'><strong>Data: </strong>$data</li>
                                    <li class='list-group-item'><strong>Estat: </strong>$estat</li>
                                    <li class='list-group-item'><strong>Prioritat: </strong>$prioritat</li>
                                </ul>

                                <!-- Botones -->
                                <div class='card-body w-100 d-flex justify-content-center gap-2'>
                                    <a href='view.php?id=$id' class='card-link'>
                                        <button type='button' class='btn btn-outline-primary'>
                                            <i class='bi bi-eye'></i>
                                        </button>
                                    </a>
                                    <a href='edit.php?id=$id' class='card-link'>
                                        <button type='button' class='btn btn-outline-warning'>
                                            <i class='bi bi-pencil'></i>
                                        </button>
                                    </a>
                                    <a href='delete.php?id=$id' class='card-link' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta incidencia?\")'>
                                        <button type='button' class='btn btn-outline-danger'>
                                            <i class='bi bi-trash'></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No hi ha incidències creades per aquest usuari.</td></tr>";
                    }
                    
                    ?>

                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="Images/Foto_Perfiles/6745a5290e12b.png" alt="Card image cap">

                        <!-- Contenido de la tarjeta -->
                        <div class="card-body">
                            <h5 class="card-title"><strong>Titulo</strong></h5>
                            <p class="card-text">Descripcio label label label label label label label label label label label label label label label label label label label label label label label </p>
                        </div>

                        <!-- Información adicional -->
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Usuario: </strong>Pepe Perez</li>
                            <li class="list-group-item"><strong>Tipus: </strong>Ferrer</li>
                            <li class="list-group-item"><strong>Ubicacio: </strong>Piso 2 • Sala 003</li>
                            <li class="list-group-item"><strong>Data: </strong>11/04/2024</li>
                            <li class="list-group-item"><strong>Estat: </strong>Pendent</li>
                            <li class="list-group-item"><strong>Prioritat: </strong>Baja</li>
                        </ul>

                        <!-- Botones -->
                        <div class="card-body w-100 d-flex justify-content-center gap-2">

                            <a href="#" class="card-link">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="bi bi-eye"></i> <!-- Ícono de Bootstrap para ver -->
                                </button>
                            </a>

                            <a href="#" class="card-link">
                                <button type="button" class="btn btn-outline-warning">
                                    <i class="bi bi-pencil"></i> <!-- Ícono de Bootstrap para ver -->
                                </button>
                            </a>

                            <a href="#" class="card-link">
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i> <!-- Ícono de Bootstrap para ver -->
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!--
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Taula d'incidencies
                </div>

                <--
                <div class="card-body">
                    <-- Contenedor para permitir scroll horizontal --
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
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
                </div> --
            </div> -->
        </div>
    </div>
</body>
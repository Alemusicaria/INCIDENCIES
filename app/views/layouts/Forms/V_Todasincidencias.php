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
                            $imatge = !empty($row['imatges']) && file_exists($row['imatges']) ? $row['imatges'] : 'Images/imgpreg.png';

                            // Asignar color basado en el estado
                            $colorestat = 'black'; // Color predeterminado
                            if ($estat === 'Pendent') {
                                $colorestat = '#5A9BD5';
                            } elseif ($estat === 'En Progrés') {
                                $colorestat = '#A9A9A9';
                            } elseif ($estat === 'Resolta') {
                                $colorestat = '#FFA500';
                            }

                            // Asignar color basado en la prioridad
                            $color = 'black'; // Color predeterminado
                            if ($prioritat === 'Alta') {
                                $color = '#dc3545';
                            } elseif ($prioritat === 'Mitjana') {
                                $color = '#ffc107';
                            } elseif ($prioritat === 'Baixa') {
                                $color = '#198754';
                            }

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
                                    <li class='list-group-item'>
                                        <strong>Estat: </strong> 
                                        <strong style='color: $colorestat;'>$estat</strong>                                        
                                    </li>

                                    <li class='list-group-item'>
                                        <strong>Prioritat: </strong>
                                        <strong style='color: $color;'>$prioritat</strong>
                                    </li>
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
                </div>
            </div>

        </div>
    </div>
</body>
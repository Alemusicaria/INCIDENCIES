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

                    <?php
                    require_once('app/models/connexio.php');

                    // Orden por defecto
                    $orden = 'data_incidencia'; // Cambia a tu campo por defecto si es necesario

                    // Verificar si hay un parámetro de orden en la URL
                    if (isset($_GET['orden'])) {
                        $orden = $_GET['orden'];

                        // Validar el valor de 'orden' para evitar inyección SQL
                        $valores_permitidos = ['prioritat', 'estat', 'data_incidencia'];
                        if (!in_array($orden, $valores_permitidos)) {
                            $orden = 'data_incidencia'; // Volver al valor por defecto
                        }
                    }

                    // ID de l'usuari autenticat
                    $idUsuari = $_SESSION['usuari'][0]; // Asegúrate de tener esta variable definida

                    // Consulta para obtener las incidencias del usuario
                    $sql = "SELECT id, creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, estat, prioritat, imatges 
                            FROM incidencies
                            WHERE habilitado = 1
                            ORDER BY $orden ASC";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    ?>

                    <form method="GET" class="mb-3">
                        <label for="orden">Ordenar por:</label>
                        <select name="orden" id="orden" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
                            <option value="data_incidencia" <?php echo $orden == 'data_incidencia' ? 'selected' : ''; ?>>Fecha</option>
                            <option value="prioritat" <?php echo $orden == 'prioritat' ? 'selected' : ''; ?>>Prioridad</option>
                            <option value="estat" <?php echo $orden == 'estat' ? 'selected' : ''; ?>>Estado</option>
                        </select>

                        <!-- Campo oculto para mantener otros parámetros -->
                        <?php foreach ($_GET as $key => $value): ?>
                            <?php if ($key !== 'orden'): ?>
                                <input type="hidden" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($value); ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </form>


                    <!-- Tarjeta 1 -->
                    <?php
                    /*
                    // ID de l'usuari autenticat
                    $idUsuari = $_SESSION['usuari'][0]; // Asegúrate de tener esta variable definida

                    // Consulta per obtenir les incidències de l'usuari
                    $sql = "SELECT id, creador_nom_cognoms, titol_fallo, descripcio, tipus_incidencia, id_ubicacio, data_incidencia, estat, prioritat, imatges 
                            FROM incidencies
                            WHERE habilitado = 1
                            ORDER BY $orden ASC";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();*/

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
                                    <a href='index.php?controller=Info_Incidencias&method=mostrar_incidencia&id=$id' class='card-link'>
                                        <button type='button' class='btn btn-outline-primary'>
                                            <i class='bi bi-eye'></i>
                                        </button>
                                    </a>
                                    <!--
                                    <a href='index.php?controller=Editar_Incidencia&method=verificar_id_incidencia&id=$id' class='card-link'>
                                        <button type='button' class='btn btn-outline-warning'>
                                            <i class='bi bi-pencil'></i>
                                        </button>
                                    </a>
                                    
                                    <a href='index.php?controller=Eliminar&method=eliminar_incidencia&id=$id' class='card-link' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta incidencia?\")'>
                                        <button type='button' class='btn btn-outline-danger'>
                                            <i class='bi bi-trash'></i>
                                        </button>
                                    </a>-->
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
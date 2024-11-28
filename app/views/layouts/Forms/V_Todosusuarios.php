<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
include("app/views/layouts/header/header.php"); // Aquí se incluye la barra lateral
?>
<style>
    .btn-success {
        background-color: #28a745;
        /* Verd */
        border-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
        /* Vermell */
        border-color: #dc3545;
    }

    .btn-primary {
        background-color: #007bff;
        /* Blau */
        border-color: #007bff;
    }
</style>

<body>
    <div class="wrapper">
        <?php
        include("app/views/layouts/menu/menu.php"); // Aquí se incluye la barra lateral
        ?>

        <div class="main p-3">
            <div class="tittle-page">
                <h2>Taula de Usuaris</h2>
            </div>


            <div class="espacio-grande">
                <div class="espacio-medio">
                    <div class="w-100">

                        <div class='card mt-2 mb-2'>
                            <div class='card-header'>
                                <i class='fas fa-user'></i>
                                Usuari
                            </div>

                            <div class='cont-card-body card-body'>

                                <div class='contenido'>

                                    <div class='contenido1'>
                                        <!-- Contenedor de la foto y los botones -->
                                        <div class='foto-usuario'>
                                            <img src='Images/Foto_Perfiles/user.png' alt='Foto de perfil' class='img-thumbnail'>
                                        </div>

                                        <div class='botones'>
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-input">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class='datos-usuario'>
                                        <span><strong>Correu Electrònic: </strong>
                                        </span><br>
                                        <span><strong>Telefon: </strong>
                                        </span><br>
                                        <span><strong>Rol: </strong>
                                        </span><br>
                                        <span><strong>Data de Registre: </strong>
                                        </span><br>
                                        <span><strong>Habilitat: </strong>
                                        </span><br>

                                        
                                    </div>

                                </div>

                            </div>

                        </div>



                        <!--
                        <?php
                        require_once('app/models/connexio.php');

                        // ID de l'usuari autenticat
                        $idUsuari = $_SESSION['usuari'][0]; // Assegura't que tens aquesta variable definida

                        // Consulta per obtenir les dades dels usuaris
                        $sql = "SELECT id, nom_cognoms, correu, telefon, rol, habilitat, data_registre, foto  
                        FROM usuaris";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Comprovar si hi ha resultats
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $foto = $row['foto'] ? $row['foto'] : 'Images/Foto_Perfiles/user.png';

                                echo "<div class='card mt-2 mb-2'>";

                                echo "<div class='card-header'>";
                                echo "<i class='fas fa-user'></i>" . $row['nom_cognoms'];;
                                echo "</div>";

                                echo "<div class='cont-card-body card-body'>";

                                echo "<div class='contenido'>";

                                echo "<div class='foto-usuario'>";
                                echo "<img src='" . $foto . "' alt='Foto de perfil' class='img-thumbnail'>";
                                echo "</div>";

                                echo "<div class='datos-usuario'>";
                                echo "<span><strong>Correu Electrònic: </strong>" . $row['correu'] . "</span><br>";
                                echo "<span><strong>Telefon: </strong>" . $row['telefon'] . "</span><br>";
                                echo "<span><strong>Rol: </strong>" . $row['rol'] . "</span><br>";
                                echo "<span><strong>Data de Registre: </strong>" . $row['data_registre'] . "</span><br>";
                                echo "<span><strong>Habilitat: </strong>" . ($row['habilitat'] == 1 ? 'Habilitat' : 'Deshabilitat') . "</span><br>";
                                echo "</div>";

                                echo "</div>";

                                echo "</div>";

                                echo "</div>";
                            }
                        }

                        ?> -->
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Taula d'incidències
                </div>

                <div class="card-body">
                    <!-- Contenedor para permitir scroll horizontal -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom i Cognoms</th>
                                    <th>Correu Electrònic</th>
                                    <th>Telèfon</th>
                                    <th>Rol</th>
                                    <th>Data de Registre</th>
                                    <th>Foto</th>
                                    <th>Accions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once('app/models/connexio.php');

                                // ID de l'usuari autenticat
                                $idUsuari = $_SESSION['usuari'][0]; // Assegura't que tens aquesta variable definida

                                // Consulta per obtenir les incidències de l'usuari
                                $sql = "SELECT id, nom_cognoms, correu, telefon, rol, habilitat, data_registre, foto  
                                FROM usuaris";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                // Comprovar si hi ha resultats
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['nom_cognoms'] . "</td>";
                                        echo "<td>" . $row['correu'] . "</td>";
                                        echo "<td>" . $row['telefon'] . "</td>";
                                        echo "<td>" . $row['rol'] . "</td>";
                                        echo "<td>" . $row['data_registre'] . "</td>";
                                        // Imatges
                                        $foto = $row['foto'] ? $row['foto'] : 'Images/Login/user.png';
                                        echo "<td class='text-center'><img src='" . $foto . "' class='img-thumbnail' width='80' height='80'></td>";

                                        if ($row['habilitat'] == 0) {
                                            echo "<td><form method='POST' action='index.php?controller=Perfil&method=habilitar'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' class='btn btn-success' style='background-color: #28a745'>Habilitar</button>
                                                    </form><hr>";
                                        } else if ($row['habilitat'] == 1) {
                                            echo "<td><form method='POST' action='index.php?controller=Perfil&method=deshabilitar'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' class='btn btn-danger'style='background-color: #dc3545'>Deshabilitar</button>
                                                    </form><hr>";
                                        }

                                        echo "<form method='POST' action='index.php?controller=Perfil&method=editar'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' class='btn btn-primary'>Editar</button>
                                                    </form>
                                            </td>";
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
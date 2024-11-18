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
                    Table
                </div>

                <div class="card-body">
                    <!-- Contenedor para permitir scroll horizontal -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom i Cognom</th>
                                    <th>Correu</th>
                                    <th>Telefon</th>
                                    <th>Rol</th>
                                    <th>Data Registre</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Juan Perez</td>
                                    <td>juan@example.com</td>
                                    <td>123456789</td>
                                    <td>Professor</td>
                                    <td>2021-10-01</td>
                                    <td><img src="Images/Login/perfil.png" alt="Perfil" class="perfil-img"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Ana García</td>
                                    <td>ana@example.com</td>
                                    <td>987654321</td>
                                    <td>Tecnic</td>
                                    <td>2021-10-02</td>
                                    <td>No hay foto</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Carlos Ruiz</td>
                                    <td>carlos@example.com</td>
                                    <td>456789123</td>
                                    <td>Admin</td>
                                    <td>2021-10-03</td>
                                    <td><img src="Images/Login/perfil.png" alt="Perfil" class="perfil-img"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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
                    <i class="lni lni-pencil-alt"></i>
                    Formulari
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom i Cognom</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Rol</th>
                                <th>Fecha de Ingreso</th>
                                <th>foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Juan</td>
                                <td>juan@example.com</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ana</td>
                                <td>González</td>
                                <td>ana@example.com</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Carlos</td>
                                <td>López</td>
                                <td>carlos@example.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
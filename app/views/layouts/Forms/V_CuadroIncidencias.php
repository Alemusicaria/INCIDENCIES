
<table>
    <thead>
        <tr>
            <td>Id</td>
            <td>Título del Fallo</td>
            <td>Información</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
    </thead>
    <tbody>
    <?php
            $mysql = new mysqli("localhost", "root", "", "incidencies");
            if ($mysql->connect_error) {
                die('Problemas con la conexión a la base de datos');
            }

            // Obtener ID del usuario en sesión
            $nombre = $_SESSION['usuario'];
            $query_usuario = "SELECT id FROM usuaris WHERE nom_cognoms = '$nombre'";
            $result_usuario = $mysql->query($query_usuario);
            $row_usuario = $result_usuario->fetch_assoc();
            $id_usuario_sesion = $row_usuario['id'];

            while ($reg = $TablaIncidencias->fetch_array())
            {
                echo "<tr>";
                echo "<td>" . $reg['id'] . "</td>";
                echo "<td>" . $reg['titol_fallo'] . "</td>";
                "<td>" . $reg['id_usuario'] . "</td>"; // Asegúrate de que 'id_usuario' existe en la tabla

                // Verificar que la incidencia pertenezca al usuario en sesión
                if ($reg['id_usuario'] == $id_usuario_sesion) {
                    echo '<td><a href="index.php?controller=Info_Incidencias&method=mostrar_incidencia&id=' . $reg['id'] . '" class="btn btn-danger btn-sm">Informacion</a></td>';
                    echo '<td><a href="index.php?controller=...&method=...&codigo=' . $reg['id'] . '" class="btn btn-danger btn-sm">Actualizar</a></td>';
                    echo '<td><a href="index.php?controller=...&method=...&codigo=' . $reg['id'] . '" class="btn btn-danger btn-sm">Eliminar</a></td>';
                }
                echo "</tr>";
            }
    ?>
</tbody>
</table>

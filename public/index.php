<?php require '../app/views/layouts/header.php'; ?>

<h1>Llistat d'incidències</h1>
<a href="index.php?action=create">Nova incidència</a>

<table>
    <thead>
        <tr>
            <th>Títol</th>
            <th>Data inici</th>
            <th>Data final</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($incidencies as $incidencia) : ?>
            <tr>
                <td><?= htmlspecialchars($incidencia['title']) ?></td>
                <td><?= htmlspecialchars($incidencia['start_date']) ?></td>
                <td><?= htmlspecialchars($incidencia['end_date']) ?></td>
                <td><a href="index.php?action=delete&id=<?= $incidencia['id'] ?>">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require '../app/views/layouts/footer.php'; ?>

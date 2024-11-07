<?php require '../app/views/layouts/header.php'; ?>

<h1>Nova Incidència</h1>

<form method="POST" action="index.php?action=create">
    <label for="title">Títol</label>
    <input type="text" name="title" id="title" required>

    <label for="start_date">Data inici</label>
    <input type="date" name="start_date" id="start_date" required>

    <label for="end_date">Data final</label>
    <input type="date" name="end_date" id="end_date" required>

    <button type="submit">Crear Incidència</button>
</form>

<?php require '../app/views/layouts/footer.php'; ?>
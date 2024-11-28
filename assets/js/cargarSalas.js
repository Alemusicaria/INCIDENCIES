function cargarSalas()
{
        const planta = document.getElementById('Planta').value;
        const salaSelect = document.getElementById('Salon');
        
        // Limpiar el campo de salas antes de llenarlo
        salaSelect.innerHTML = '<option value="">Cargando...</option>';

        // Hacer la solicitud AJAX
        fetch('index.php?controller=Incidencias&method=obtenerSalas', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'planta=' + encodeURIComponent(planta)
        })
        .then(response => response.json())
        .then(data => {
            salaSelect.innerHTML = '<option value="">Selecciona una sala</option>';
            data.forEach(sala => {
                const option = document.createElement('option');
                option.value = sala;
                option.textContent = sala;
                salaSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar las salas:', error);
            salaSelect.innerHTML = '<option value="">Error al cargar salas</option>';
        });
}


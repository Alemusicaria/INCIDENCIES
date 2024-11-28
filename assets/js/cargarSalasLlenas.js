document.addEventListener('DOMContentLoaded', function () {
    const plantaSeleccionada = document.getElementById('Planta').value;
    const salaSeleccionada = document.getElementById('Salon').getAttribute('data-sala-seleccionada');

    if (plantaSeleccionada) {
        cargarSalas(plantaSeleccionada, salaSeleccionada);
    }
});

function cargarSalas(planta = null, salaSeleccionada = null) {
    const plantaActual = planta || document.getElementById('Planta').value;
    const salaSelect = document.getElementById('Salon');

    // Limpiar el campo de salas antes de llenarlo
    salaSelect.innerHTML = '<option value="">Cargando...</option>';

    // Hacer la solicitud AJAX
    fetch('index.php?controller=Incidencias&method=obtenerSalas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'planta=' + encodeURIComponent(plantaActual)
    })
    .then(response => response.json())
    .then(data => {
        salaSelect.innerHTML = '<option value="">Selecciona una sala</option>';
        data.forEach(sala => {
            const option = document.createElement('option');
            option.value = sala;
            option.textContent = sala;

            // Preseleccionar la sala si coincide con la incidencia
            if (salaSeleccionada && salaSeleccionada === sala) {
                option.selected = true;
            }

            salaSelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error al cargar las salas:', error);
        salaSelect.innerHTML = '<option value="">Error al cargar salas</option>';
    });
}

// Actualiza las salas cada vez que el usuario cambie de planta
document.getElementById('Planta').addEventListener('change', function () {
    cargarSalas();
});
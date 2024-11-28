// Función para manejar el cambio del estado de habilitación
function updateHabilitat(id, isChecked) {
    // Crear un objeto FormData para enviar los datos a través de POST
    var formData = new FormData();
    formData.append('id', id);  // Agregar el id del usuario
    formData.append('habilitat', isChecked ? 1 : 0);  // 1 para habilitar, 0 para deshabilitar

    // Crear la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?controller=Perfil&method=updateHabilitat', true);

    // Cuando la solicitud se completa
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Si el estado se actualizó correctamente, opcionalmente puedes hacer algo aquí
            console.log('Estado actualizado');
        } else {
            console.error('Error al actualizar el estado');
        }
    };

    // Enviar los datos
    xhr.send(formData);
}

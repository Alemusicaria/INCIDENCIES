function cargarSalas() {
    // Obtener el valor seleccionado en el campo "Planta"
    var plantaSeleccionada = document.getElementById("Planta").value;

    // Crear una solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cargar_salas.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Manejar la respuesta del servidor
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Actualizar el contenido del select de "Salón" con las opciones recibidas
            document.getElementById("Salon").innerHTML = xhr.responseText;
        }
    };

    // Enviar los datos al servidor
    xhr.send("planta=" + encodeURIComponent(plantaSeleccionada));
}
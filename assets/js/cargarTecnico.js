document.getElementById("Categoria").addEventListener("change", cargarTecnicos);
document.getElementById("SeleccionarTecnico").addEventListener("change", mostrarNumeroTecnico);
document.getElementById("EnviarWhatsApp").addEventListener("click", enviarWhatsApp);

function mostrarFormularioTecnicos() {
    const tecnicoSeleccionado = document.getElementById("Tecnico").value;
    const formularioTecnicos = document.getElementById("formularioTecnicos");
    formularioTecnicos.style.display = tecnicoSeleccionado === "Si" ? "block" : "none";
}

function cargarTecnicos() {
    const categoria = document.getElementById("Categoria").value;

    if (categoria) {
        fetch(`index.php?controller=Incidencias&method=obtenerTecnicosPorCategoria`, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `categoria=${encodeURIComponent(categoria)}`
        })
        .then(response => response.json())
        .then(data => {
            const tecnicoSelect = document.getElementById("SeleccionarTecnico");
            tecnicoSelect.innerHTML = '<option value="">Selecciona un técnico</option>';
            data.forEach(tecnico => {
                tecnicoSelect.innerHTML += `<option value="${tecnico.id}" data-numero="${tecnico.numero}">${tecnico.nombre}</option>`;
            });
        })
        .catch(err => console.error("Error al cargar los técnicos:", err));
    }
}

function mostrarNumeroTecnico() {
    const tecnicoSelect = document.getElementById("SeleccionarTecnico");
    const tecnicoId = tecnicoSelect.value;

    if (tecnicoId) {
        // Petición AJAX para obtener el número del técnico
        fetch(`index.php?controller=Incidencias&method=obtenerNumeroTecnico`, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `tecnico_id=${encodeURIComponent(tecnicoId)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.numero) {
                document.getElementById("NumeroTecnico").value = data.numero; // Actualizar el campo
            } else {
                alert("No se encontró el número del técnico.");
            }
        })
        .catch(err => console.error("Error al obtener el número del técnico:", err));
    } else {
        document.getElementById("NumeroTecnico").value = ""; // Vaciar si no hay técnico seleccionado
    }
}

function enviarWhatsApp() {
    const numeroTecnico = document.getElementById("NumeroTecnico").value; // Número del técnico
    const mensaje = document.getElementById("Mensaje").value; // Mensaje del usuario

    console.log("Número del técnico:", numeroTecnico); // Verificar el valor

    if (!numeroTecnico) {
        alert("Selecciona un técnico para enviarle el mensaje.");
        return;
    }

    if (!mensaje) {
        alert("Escribe un mensaje para el técnico.");
        return;
    }

    // Asegurarse de que el número de teléfono esté limpio de caracteres no válidos
    const numeroFormateado = numeroTecnico.replace(/[^0-9+]/g, '');

    console.log("Número formateado:", numeroFormateado); // Verificar el formato

    // Codificar el mensaje para asegurar que se pase correctamente por la URL
    const mensajeCodificado = encodeURIComponent(mensaje);

    console.log("Mensaje codificado:", mensajeCodificado); // Verificar el mensaje codificado

    // Construir la URL para WhatsApp
    const urlWhatsApp = `https://wa.me/${numeroFormateado}?text=${mensajeCodificado}`;

    console.log("URL de WhatsApp:", urlWhatsApp); // Verificar la URL generada

    // Abrir la URL en una nueva ventana/pestaña
    window.open(urlWhatsApp, "_blank");
}
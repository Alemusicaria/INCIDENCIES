document.getElementById("Categoria").addEventListener("change", cargarTecnicos);
document.getElementById("SeleccionarTecnico").addEventListener("change", mostrarNumeroTecnico);
document.getElementById("EnviarWhatsApp").addEventListener("click", enviarWhatsApp);
document.getElementById("Tecnico").addEventListener("change", mostrarFormularioTecnicos); // Agregamos el evento para detectar el cambio en "Tecnico"

// Función para mostrar u ocultar el formulario y los botones
function mostrarFormularioTecnicos() {
    const tecnicoSeleccionado = document.getElementById("Tecnico").value;
    const formularioTecnicos = document.getElementById("formularioTecnicos");
    const botonWhatsApp = document.getElementById("EnviarWhatsApp");
    const botonGuardar = document.getElementById("Guardar");

    // Mostrar el formulario de técnicos y el botón adecuado dependiendo de la selección
    if (tecnicoSeleccionado === "Si") {
        formularioTecnicos.style.display = "block";  // Muestra el formulario de técnicos
        botonWhatsApp.style.display = "inline-block";  // Muestra el botón "Guardar i Enviar a WhatsApp"
        botonGuardar.style.display = "none";  // Oculta el botón "Guardar"
    } else {
        formularioTecnicos.style.display = "none";  // Oculta el formulario de técnicos
        botonWhatsApp.style.display = "none";  // Oculta el botón "Guardar i Enviar a WhatsApp"
        botonGuardar.style.display = "inline-block";  // Muestra el botón "Guardar"
    }
}

// Función para cargar los técnicos disponibles según la categoría seleccionada
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
                tecnicoSelect.innerHTML += `<option value="${tecnico.id}" data-numero="${tecnico.telefon}">${tecnico.nom_cognoms}</option>`;
            });
        })
        .catch(err => console.error("Error al cargar los técnicos:", err));
    }
}

// Función para mostrar el número de teléfono del técnico seleccionado
function mostrarNumeroTecnico() {
    const tecnicoSelect = document.getElementById("SeleccionarTecnico");
    const tecnicoId = tecnicoSelect.value;

    if (tecnicoId) {
        fetch(`index.php?controller=Incidencias&method=obtenerNumeroTecnico`, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `tecnico_id=${encodeURIComponent(tecnicoId)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.numero) {
                document.getElementById("NumeroTecnico").value = data.numero;
            } else {
                alert("No se encontró el número del técnico.");
            }
        })
        .catch(err => console.error("Error al obtener el número del técnico:", err));
    } else {
        document.getElementById("NumeroTecnico").value = "";  // Vaciar si no hay técnico seleccionado
    }
}

// Función para enviar el mensaje por WhatsApp
function enviarWhatsApp() {
    const numeroTecnico = document.getElementById("NumeroTecnico").value;
    const mensaje = document.getElementById("Mensaje").value;

    if (!numeroTecnico) {
        alert("Selecciona un técnico para enviarle el mensaje.");
        return;
    }

    if (!mensaje) {
        alert("Escribe un mensaje para el técnico.");
        return;
    }

    const numeroFormateado = numeroTecnico.replace(/[^0-9+]/g, '');  // Limpiar número

    const mensajeCodificado = encodeURIComponent(mensaje);  // Codificar mensaje

    const urlWhatsApp = `https://wa.me/${numeroFormateado}?text=${mensajeCodificado}`;  // Crear URL

    // Abrir WhatsApp con la URL generada
    window.open(urlWhatsApp, "_blank");
}

function togglePasswordVisibility(id) {
    var passwordField = document.getElementById(id);
    var eyeIcon = passwordField.nextElementSibling.querySelector('i'); // Encontrar el ícono del ojo

    if (passwordField.type === "password") {
        passwordField.type = "text"; // Muestra la contraseña
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash'); // Cambia el ícono a "ojo cerrado"
    } else {
        passwordField.type = "password"; // Oculta la contraseña
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye'); // Cambia el ícono a "ojo abierto"
    }
}

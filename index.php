
<?php
session_start(); // Inicia la sesión para poder acceder a las variables de sesión
require_once "autoload.php"; // Asegúrate de que este archivo exista y esté configurado correctamente

    if (isset($_GET["controller"])) {
        $controller = $_GET["controller"];

        if (class_exists($controller)) {
            $controller = $controller . "Controller"; // Agrega "Controller" al nombre de la clase

            // Verifica si la clase del controlador existe antes de instanciarla
            if (class_exists($controller)) {
                $controller = new $controller(); // Crea una instancia del controlador

                if (isset($_GET["method"])) {
                    $method = $_GET["method"];

                    // Verifica si el método existe en el controlador
                    if (method_exists($controller, $method)) {
                        $controller->$method(); // Llama al método correspondiente
                    } else {
                        echo "No existe el método " . htmlspecialchars($method); // Escapa la salida para evitar inyección de HTML
                    }
                } else {
                    echo "No existe el método en el controlador " . htmlspecialchars($controller);
                }
            } else {
                echo "No existe la clase del controlador " . htmlspecialchars($controller);
            }
        } else {
            echo "No existe el controlador " . htmlspecialchars($controller);
        }
    } else {
        // Carga el formulario de registro si no se especifica un controlador
        require("app/views/layouts/Forms/V_Registro.php");  
    }
    ?>

<?php

// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar la sesión
session_start();

require_once "autoload.php";

?>

<?php

    if (isset($_GET["controller"])) { // Comprueba si hay un controlador en la URL
        $controller = $_GET["controller"]; // Obtiene el controlador de la URL

        $controller = "C_" . $controller; // Asigna el nombre del controlador con el prefijo C_

        if (class_exists($controller)) { // Verifica que la clase existe
            $controller= new $controller(); // Instancia el controlador

            if (isset($_GET["method"])) { // Comprueba si hay un metodo en la URL
                $method = $_GET["method"]; // Obtiene el metodo de la URL

                if (method_exists($controller, $method)) { // Verifica que el metodo existe
                    $controller->$method(); // Llama al metodo del controlador
                } else {
                    echo "ERROR: Metodo no existe " . $method;
                }
            } else {
                echo "ERROR: Contorlador no existe " . $controller;
            }
        }
    } else {
        // Mostrar el login por defecto si no hay controlador en la URL
        // require "app/Views/Forms/V_Login.php";
        require "public/index.php";
    }
?>
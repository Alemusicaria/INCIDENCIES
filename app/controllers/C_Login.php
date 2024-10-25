<?php

require("Models/M_Login.php");

class C_Login {
    
    public function __construct() {
    }

    public function mostrarLogin() {
        require_once "Views/Formularios/V_Login.php";
    }

}

?>
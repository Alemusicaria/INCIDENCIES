<?php
require 'app/models/registro.php';

class RegistroController
{
    public function registro()
    {
        require "app/views/layouts/Forms/V_Registro.php";
    }

    public function ingresar_usuario()
    {
        $nuevo_usuario = new registro();
        if ($nuevo_usuario->Nuevo_Usuario()) {
            header("Location: index.php?controller=Login&method=bienvenido");
        } else {
            header("Location: index.php?controller=Registro&method=registro");
        }
    }
}
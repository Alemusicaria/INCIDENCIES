<?php 

function autocargar($classname){
    include "app/controllers/" .  $classname . ".php";
}

spl_autoload_register("autocargar");

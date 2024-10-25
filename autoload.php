<?php

function autocargar($classname){
    require_once("Controllers/" . $classname . ".php");
}

spl_autoload_register("autocargar");

?>
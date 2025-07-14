<?php
    require_once 'controladores/TareaControlador.php';

    $controlador = new TareaControlador();
    $acction = $_GET['action'] ?? 'listar';

    if(method_exists($controlador, $acction)) {
        $controlador->$acction();
    } else {
        echo 'Accion no valida';
    }
?>
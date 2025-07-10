<?php 
    require 'sql/db.php';

    $id = $_GET['id'];
    $conn->query("UPDATE crud SET is_completado = 1 WHERE id = $id");

    header("Locatinon: index.php");
    exit();
?>
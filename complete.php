<?php 
    require 'sql/db.php';

    $id = $_GET['id'];
    $conn->query("UPDATE crud SET is_completado = 1 WHERE id = $id");

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE crud SET is_completado = 1 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    }

    header("Location: index.php");
    exit();
    
?>

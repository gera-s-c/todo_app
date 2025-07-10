<?php
    require 'sql/db.php';
    
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);
    
        $stmt = $conn->prepare("DELETE FROM crud WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    
    header("Location: index.php");
    exit();
?>
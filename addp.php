<?php 
    require 'sql/db.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title']);
        $descripcion = trim($_POST['descripcion']);
        $due_date = $_POST['due_date'];
    
        if($title === '' || $due_date === '') {
            header('Location: index.php');
            exit();
        }
    
        $today = date('y-m-d');
        if($due_date < $today) {
            header('Locatin: index.php');
            exit();
        }
    
        $stmt = $conn->prepare("INSERT INTO crud (title, descricpcion, due_date) VALUE (?, ?, ?)");
        $stmt->bind_param("sss", $tilte, $descripcion, $due_date);
        $stmt->execute();
    }
    
    header("Location: index.php");
    exit();
?>
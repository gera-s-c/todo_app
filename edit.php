<?php
    require 'sql/db.php';

    $id = $_GET['id'] ?? null;

    // Validar que el ID esté presente
    if (!$id) {
        die("ID no válido.");
    }

    // Obtener los datos actuales de la tarea
    $result = $conn->query("SELECT * FROM crud WHERE id = $id");
    $crud = $result->fetch_assoc();

    if (!$crud) {
        die("Tarea no encontrada.");
    }

    // Procesar formulario POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST['title'];
        $desc = $_POST['descripcion'];
        $due = $_POST['due_date'];

        // Validación de fecha
        if ($due < date('Y-m-d')) {
            die("La fecha no puede ser anterior a hoy.");
        }
            header("Location: index.php");
            exit();

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Tarea</title>
</head>
<body class="contenedor body-contenedor">
    <h2>Editar tarea</h2>

    <form method="POST" action="create.php" id="taskForm" class="from-contenedor">
        <div class="div-contenedor">
            <label for="title" class="from-label">Titulo</label>
            <input type="text" class="from-control" name="title" required placeholder="Titulo">
        </div>
        <div class="div-contenedor">
            <label for="descripcion" class="from-label">Descripcion</label>
            <textarea class="from-control" name="descripcion" placeholder="Descripcion (opcional)"></textarea>
        </div>
        <div class="divcontenedor">
            <label for="due_date" class="from-lable">Fecha de vencimiento</label>
            <input type="date" class="from-control" name="due_date" min="<?= date('y-m-d') ?>" require>
        </div>
        <button type="submit" class="bnt bnt-primary">Crear</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
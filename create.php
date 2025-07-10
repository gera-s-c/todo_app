<?php
require 'sql/db.php';

if($_SERVER["REQUEST_METHOD"]  === "POST") {
    $title = $_POST['titulo'];
    $desc = $_POST['discripcion'];
    $due = $_POST['due_date'];

    if($due < date('y-m-s')) {
        die("La fecha de vancimiento no puede ser pasada");
    }

    $stmt = $conn->prepare("INSERT INTO crud (title, descricion, due_date) VALUES (?, ?, ?");
    $stmt->bind_param("sss", $title, $desc, $due);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <title>Crear Tarea</title>
    </head>
    <body class="contenedor body-contenedor">
        <h2>Crear Nueva Tarea</h2>
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
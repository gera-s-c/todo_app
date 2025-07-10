<?php
require 'sql/db.php';
$result = $conn->query("SELECT * FROM crud ORDER BY is_completado ASC, due_date ASC");

?>

<!--Tabla de tareas-->
<a href="create.php" class="btn btn-success">Nueva Tarea</a>
<ul>
    <?php while($row = $result->fetch_assoc()): ?>
        <li class="<?= $row['is_completado'] ? 'completado' : '' ?>">
            <?= htmlspecialchars($row['title']) ?> - <?=$row['due_date'] ?>
            <?php if(!$row['is_completado']): ?>
                <a href="complete.php?=<?= $row['id'] ?>">Completar</a>
            <?php endif; ?>
            <a href="edit.php?id=<?= $row['id'] ?>">Editar</a>
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar tarea?')">Eliminar</a>
        </li>
    <?php endwhile; ?>
</ul>
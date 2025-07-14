<?php
    require_once 'modelos/Conexion.php';

    class tarea
    {
        private $conn;

        public function __contructor()
        {
            $this->conn = Conexion::obtenerConexion();
        }

        // Creacion de tarea
        public function crearTarea($titulo, $descripcion, $fecha)
        {
            $sql = "INSERT INTO tareas(tareas_titulo, tareas_descripcion, tareas_vancimiento, tareas_creacion, tareas_completada, tareas_eliminada)
                    VALUE (:titulo, :descripcion, :fecha, NOW(), 0, 0)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':titulo' => $titulo,
                ':descripcion' => $descripcion,
                ':fecha' => $fecha
            ]);
        }

        // Obtener tareas no eliminadas
        public function obtenerTodas()
        {
            $sql = "SELECT * FROM tareas WHERE tareas_eliminada = 0 ORDER BY tarea_completada ASC, tarea_vencimiento ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener tarea por id
        public function obtenerPorId($id)
        {
            $sql = "SELECT * FROM tareas WHERE tareas_id = :id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Eliminar tarea
        public function actualizarTarea($id, $titulo, $descripcion, $fecha)
        {
            $sql = "UPDATE tareas
                    SET tareas_titulo = :titulo,
                        tareas_descripcion = :descripcion,
                        tareas_vencimiento = :fecha
                    WHERE tareas_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':titulo' => $titulo,
                ':descripcion' => $descripcion,
                ':fecha' => $fecha
            ]);
        }

        // Eliminar una tarea
        public function eliminarTarea($id)
        {
            $sql = "UPDATE tareas SET tarea_eliminar = 1 WHERE tareas_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
        }
    }
?>

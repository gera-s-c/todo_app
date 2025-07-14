<?php
    require_once 'modelos/tarea.php';

    class TareaControlador
    {
        private $modelo;

        public function __construct()
        {
            $this->modelo = new Tarea();
        }

        // Mosttrar tareas
        public function listar()
        {
            $tareas = $this->modelo->obtenerTodas();
        }

        // Formulario crear tarea
        public function crear()
        {
            include 'vistas/tareas/crear.php';
        }

        // Formulario de guardar tarea
        public function guardar()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $titulo = $_POST['titulo'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $fecha = $_POST['fecha'] ?? '';

                if(!empty($titulo) && !empty($fecha)) {
                    $this->modelo->crearTarea($titulo, $descripcion, $fecha);
                }
            }
            header('Location: index.php?action=listar');
        }

        // formulario de editar
        public function editar()
        {
            $id = $_GET['id'] ?? null;
            if($id) {
                $tarea = $this->modelo->obtenerPorId($id);
                include 'vistas/tareas/editar.php';
            } else {
                echo 'ID no valido';
            }
        }

        //Actualizar tarea
        public function actualizar()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
                $fecha = $_POST['fecha'];

                if($id && $titulo && $fecha) {
                    $this->modelo->actualizarTarea($id, $titulo, $descripcion,  $fecha);
                }
                header('Location: index.php?action=listar');
            }
        }

        // Elimina
        public function eliminar()
        {
            $id = $_GET['id'] ?? null;
            if($id) {
                $this->modelo->eliminarTarea('id');
            }
            header('Location: index.php?action=listar');
        }
    }
?>
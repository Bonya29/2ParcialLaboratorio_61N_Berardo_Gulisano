<?php

// Controlador para manejar todas las operaciones del todo list
class rutinasController extends Controller {
    
    // Título específico para este controlador
    protected $title = 'Lista de Rutinas';
    
    /**
     * Página principal - mostrar todas las rutinas
     */
    function index() {
        // Obtener todas las rutinas con detalles
        $rutinas = rutinasModel::getAllWithDetails();

        // Datos para la vista
        $data = [
            'rutinas' => $rutinas,
            'page_title' => 'Mis Rutinas'
        ];
        
        // Renderizar vista directamente sin pasar por to_Object
        View::render('rutinasList', $data);
    }
    
    /**
     * Mostrar formulario para agregar nueva rutina
     */
    function add() {
        $data = [
            'page_title' => 'Agregar Nueva Rutina'
        ];
        // Renderizar vista directamente sin pasar por to_Object
        View::render('addRutina', $data);
    }
    
    /**
     * Mostrar formulario para editar rutina existente
     */
    function edit() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('rutinas', 'ID de rutina inválido', 'danger');
            return;
        }

        $id = $_GET['id'];
        $rutina = rutinasModel::find($id);

        if (!$rutina) {
            $this->redirectWithMessage('rutinas', 'Rutina no encontrada', 'danger');
            return;
        }

        // 🔹 Obtener los tipos únicos de la base de datos
        $tipos = Db::query("SELECT DISTINCT tipo FROM rutina")->fetchAll(PDO::FETCH_COLUMN);

        $data = [
            'page_title' => 'Editar Rutina',
            'rutina' => $rutina,
            'tipos' => $tipos
        ];

        View::render('editRutina', $data);
    }
    
    /**
     * Procesar formulario de nueva rutina
     */
    function store() {
        // Validar datos requeridos
        if (!$this->validatePost(['nombre'])) {
            $this->redirectWithMessage('rutinas/add', 'Debe ingresar un nombre para la rutina', 'warning');
            return;
        }
        
        // Preparar datos
        $rutinaData = [
            'nombre' => trim($_POST['nombre']),
            'tipo' => $_POST['tipo'] ?? 'otro',
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'duracion' => (int) ($_POST['duracion'] ?? 0),
            'frecuencia' => $_POST['frecuencia'] ?? 'diaria'
        ];

        // Crear rutina
        rutinasModel::create($rutinaData);
        
        // Redireccionar con mensaje de éxito
        $this->redirectWithMessage('rutinas', 'Rutina agregada exitosamente', 'success');
    }
    
    /**
     * Procesar formulario de edición de rutina
     */
    function update() {
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            $this->redirectWithMessage('rutinas', 'ID de rutina inválido', 'danger');
            return;
        }
        
        if (!$this->validatePost(['nombre'])) {
            $this->redirectWithMessage('rutinas/edit?id=' . $_POST['id'], 'Debe ingresar un nombre para la rutina', 'warning');
            return;
        }
        
        $id = $_POST['id'];

        // Verificar que la rutina existe
        $rutina = rutinasModel::find($id);
        if (!$rutina) {
            $this->redirectWithMessage('rutinas', 'Rutina no encontrada', 'danger');
            return;
        }
        
        // Preparar datos
        $rutinaData = [
            'nombre' => trim($_POST['nombre']),
            'tipo' => $_POST['tipo'] ?? 'otro',
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'duracion' => (int) ($_POST['duracion'] ?? 0),
            'frecuencia' => $_POST['frecuencia'] ?? 'diaria'
        ];
        
        // Actualizar rutina
        rutinasModel::update($id, $rutinaData);
        
        // Redireccionar con mensaje de éxito
        $this->redirectWithMessage('rutinas', 'Rutina actualizada exitosamente', 'success');
    }
    
    /**
     * Eliminar rutina
     */
    function delete() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $this->redirectWithMessage('rutinas', 'ID de rutina inválido', 'danger');
            return;
        }
        
        $id = $_GET['id'];
        
        // Verificar que la tarea existe
        $rutina = rutinasModel::find($id);
        if (!$rutina) {
            $this->redirectWithMessage('rutinas', 'Rutina no encontrada', 'danger');
            return;
        }
        
        // Eliminar rutina
        rutinasModel::delete($id);

        $this->redirectWithMessage('rutinas', 'Rutina eliminada exitosamente', 'info');
    }
}
?>
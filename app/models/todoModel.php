<?php

// Modelo para manejar las operaciones de la tabla todos
class todoModel extends Model {
    
    // Nombre de la tabla en la base de datos
    protected $table = 'todos';
    
    // Campos que se pueden llenar masivamente
    protected $fillable = ['task', 'description', 'important', 'priority', 'completed'];
    
    /**
     * Obtener todas las tareas con información adicional
     * @return array Array de tareas con datos procesados
     */
    public static function getAllWithDetails() {
        $todos = self::all();
        
        // Procesar cada tarea para agregar información adicional
        foreach ($todos as &$todo) {
            $todo['priority_text'] = Todo::getPriorityText($todo['priority']);
            $todo['priority_color'] = Todo::getPriorityColor($todo['priority']);
            $todo['formatted_date'] = date('d/m/Y H:i', strtotime($todo['created_at']));
        }
        
        return $todos;
    }
    
    /**
     * Obtener tareas completadas
     * @return array Array de tareas completadas
     */
    public static function getCompleted() {
        $result = Db::query("SELECT * FROM todos WHERE completed = 1 ORDER BY updated_at DESC");
        return $result->fetchAll();
    }
    
    /**
     * Obtener tareas pendientes
     * @return array Array de tareas pendientes
     */
    public static function getPending() {
        $result = Db::query("SELECT * FROM todos WHERE completed = 0 ORDER BY priority DESC, created_at ASC");
        return $result->fetchAll();
    }

    /**
     * Obtener tareas completadas
     * @return array Array de tareas completadas
     */
    public static function getImportant() {
        $result = Db::query("SELECT * FROM todos WHERE important = 1 ORDER BY updated_at DESC");
        return $result->fetchAll();
    }
    
    /**
     * Buscar tareas por texto
     * @param string $search Texto a buscar
     * @return array Array de tareas encontradas
     */
    public static function search($search) {
        $result = Db::query("
            SELECT * FROM todos 
            WHERE task LIKE ? OR description LIKE ? 
            ORDER BY created_at DESC
        ", ["%{$search}%", "%{$search}%"]);
        return $result->fetchAll();
    }
}
?>

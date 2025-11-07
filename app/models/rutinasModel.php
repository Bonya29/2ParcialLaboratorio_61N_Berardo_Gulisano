<?php

// Modelo para manejar las operaciones de la tabla rutina
class rutinasModel extends Model {
    
    // Nombre de la tabla en la base de datos
    protected $table = 'rutina';
    
    // Campos que se pueden llenar masivamente
    protected $fillable = ['nombre', 'tipo', 'descripcion', 'duracion', 'frecuencia'];
    
    /**
     * Obtener todas las rutinas con información adicional
     * @return array Array de rutinas con datos procesados
     */
    public static function getAllWithDetails() {
        $rutinas = self::all();
        
        // Procesar cada rutina para agregar información adicional
        foreach ($rutinas as &$rutina) {
            $rutina['tipo_text'] = Rutina::getTipoText($rutina['tipo']);
            $rutina['tipo_color'] = Rutina::getTipoColor($rutina['tipo']);
            $rutina['frecuencia_text'] = Rutina::getFrecuenciaText($rutina['frecuencia']);
            $rutina['duracion_text'] = Rutina::getDuracionText($rutina['duracion']);
        }
        
        return $rutinas;
    }
    
    /**
     * Obtener rutinas diarias
     * @return array Array de rutinas diarias
     */
    public static function getDaily() {
        $result = Db::query("SELECT * FROM rutina WHERE frecuencia = 'diaria' ORDER BY created_at ASC");
        return $result->fetchAll();
    }
    
    /**
     * Obtener rutinas de por medio
     * @return array Array de rutinas de por medio
     */
    public static function getEveryOtherDay() {
        $result = Db::query("SELECT * FROM rutina WHERE frecuencia = 'de por medio' ORDER BY created_at ASC");
        return $result->fetchAll();
    }

    /**
     * Obtener rutinas semanales
     * @return array Array de rutinas semanales
     */
    public static function getWeekly() {
        $result = Db::query("SELECT * FROM rutina WHERE frecuencia = 'semanal' ORDER BY created_at ASC");
        return $result->fetchAll();
    }

    /**
     * Obtener rutinas mensuales
     * @return array Array de rutinas mensuales
     */
    public static function getMonthly() {
        $result = Db::query("SELECT * FROM rutina WHERE frecuencia = 'mensual' ORDER BY created_at ASC");
        return $result->fetchAll();
    }
}
?>
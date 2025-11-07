<?php

// Clase helper para funcionalidades específicas de rutinas
class Rutina {
    /**
     * Obtener el texto de tipos de rutina con inicial en mayusculas
     * @param string $tipo Tipo de rutina en minuscula
     * @return string Texto del tipo de rutina con inicial en mayusculas
     */
    public static function getTipoText($tipo) {
        $tipos = [
            'ejercicio' => 'Ejercicio',
            'meditacion' => 'Meditación',
            'estudio' => 'Estudio',
            'trabajo' => 'Trabajo',
            'compras' => 'Compras',
            'otro' => 'Otro'
        ];
        return $tipos[$tipo] ?? 'Otro';
    }

    /**
     * Obtener el color asociado a un tipo de rutina
     * @param string $tipo Tipo de rutina
     * @return string Color Bootstrap asociado
     */
    public static function getTipoColor($tipo) {
        return [
            'ejercicio' => 'success',
            'meditacion'=> 'info',
            'estudio'   => 'primary',
            'trabajo'   => 'warning',
            'compras'   => 'danger',
            'otro'      => 'dark',
        ][$tipo] ?? 'secondary';
    }

    /**
     * Obtener el texto de frecuencias con otra redaccion
     * @param string $tipo Frecuencia con redacción interna
     * @return string Texto de la frecuencia con redacción prolija
     */
    public static function getFrecuenciaText($frecuencia) {
        $frecuencias = [
            'diaria' => 'Todos los días',
            'de por medio' => 'Día de por medio',
            'semanal' => 'Una vez a la semana',
            'mensual' => 'Una vez al mes',
        ];
        return $frecuencias[$frecuencia] ?? 'Una vez a la semana';
    }

    /**
     * Formatear duración en minutos a formato legible
     * @param int $min Duración en minutos
     * @return string Duración formateada
     */
    public static function getDuracionText(int $min) {
        $min = max(0, (int) $min);

        if ($min < 60) {
            return $min . ' Minuto' . ($min === 1 ? '' : 's');
        }

        $h = intdiv($min, 60);
        $m = $min % 60;

        $horaText = $h . ' Hora' . ($h === 1 ? '' : 's');

        if ($m === 0) {
            return $horaText;
        }

        $minText = $m . ' Minuto' . ($m === 1 ? '' : 's');
        return $horaText . ' y ' . $minText;
    }
}
?>
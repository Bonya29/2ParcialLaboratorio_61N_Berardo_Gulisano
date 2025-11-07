-- Tabla para el sistema de tareas
CREATE TABLE `todos` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `task` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `important` TINYINT(1) DEFAULT 0,
    `completed` TINYINT(1) DEFAULT 0,
    `priority` ENUM('low', 'medium', 'high') DEFAULT 'medium',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo de todos
INSERT INTO `todos` (`task`, `description`, `important`, `completed`, `priority`) VALUES
('Aprender el framework', 'Estudiar la estructura MVC del proyecto', 1, 0, 'high'),
('Crear todo list', 'Implementar funcionalidad completa', 0, 0, 'medium'),
('Documentar código', 'Crear README con flujo de aplicación', 0, 0, 'low'),
('Repasar clases de Laboratorio II', 'Repasar clases grabadas y ayudarse con el material de teams', 1, 0, 'medium'),
('Preparar presentación para Formación Especial II', 'Realizar Presentación sobre las normas de calidad de software', 1, 0, 'high'),
('Hacer Ejercicios de Administración de Proyectos II', 'Completar y entregar las actividades semanales', 0, 1, 'low'),
('Estudiar para el parcial de Matemática IV', 'Revisar apuntes y practicar con ejercicios vistos en clase', 1, 1, 'high');

-- Tabla para el sistema de rutinas
CREATE TABLE `rutina` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(255) NOT NULL,
    `tipo` ENUM('ejercicio', 'meditacion', 'estudio', 'trabajo', 'compras', 'otro') NOT NULL,
    `descripcion` TEXT,
    `duracion` INT NOT NULL,
    `frecuencia` ENUM('diaria', 'de por medio', 'semanal', 'mensual'),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo de rutina
INSERT INTO `rutina` (`nombre`, `tipo`, `descripcion`, `duracion`, `frecuencia`) VALUES
('Salir a correr en la mañana', 'ejercicio', 'Darle 2 vueltas al Parque de las Naciones', 30, 'diaria'),
('Meditación matutina', 'meditacion', 'Ver un video para tener una sesión de meditación guiada para empezar el día', 15, 'diaria'),
('Estudio de programación', 'estudio', 'Dedicar tiempo a aprender nuevas tecnologías y lenguajes de programación y reforzar lo aprendido', 120, 'de por medio'),
('Trabajo en proyecto personal', 'trabajo', 'Avanzar en el desarrollo de mi pagina web', 240, 'semanal'),
('Realizar Compra del Mes', 'compras', 'Hacer la lista y comprar los elementos necesarios para todo el mes', 180, 'mensual'),
('Lectura diaria', 'otro', 'Leer un capítulo de un libro cada día antes de dormir', 20, 'diaria');
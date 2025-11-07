<?php

// Clase Db: Maneja la conexión y operaciones con la base de datos

class Db {

    private static $instance = null;  // Instancia única de la clase
    private $link;                    // Conexión a la base de datos
    private $engine;    // Motor de base de datos (mysql, postgresql, etc.)
    private $host;      // Host de la base de datos
    private $name;      // Nombre de la base de datos
    private $user;      // Usuario de la base de datos
    private $pass;      // Contraseña de la base de datos
    private $charset;   // Codificación de caracteres

    /**
     * Constructor privado para evitar instanciación externa.
     * Inicializa las propiedades y crea la conexión PDO.
     */
    private function __construct() {
        // Configurar propiedades según el entorno (local o producción)
        $this->engine = IS_LOCAL ? LDB_ENGINE : DB_ENGINE;
        $this->host   = IS_LOCAL ? LDB_HOST : DB_HOST;
        $this->name   = IS_LOCAL ? LDB_NAME : DB_NAME;
        $this->user   = IS_LOCAL ? LDB_USER : DB_USER;
        $this->pass   = IS_LOCAL ? LDB_PASS : DB_PASS;
        $this->charset = IS_LOCAL ? LDB_CHARSET : DB_CHARSET;

        // Establecer conexión automáticamente
        $this->connect();
    }

    /**
     * Retorna la instancia única.
     * Si no existe, la crea.
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Crea la conexión PDO y la almacena en $this->link.
     */
    private function connect() {
        try {
            $this->link = new PDO(
                "{$this->engine}:host={$this->host};dbname={$this->name};charset={$this->charset}",
                $this->user,
                $this->pass
            );
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    /**
     * Retorna el objeto PDO actual.
     */
    public function getConnection() {
        return $this->link;
    }

    /**
     * Ejecuta una consulta SQL usando prepared statements.
     */
    public static function query($sql, $params = []) {
        try {
        // Preparar la consulta con la misma instancia
            $db = self::getInstance()->getConnection();
            $stmt = $db->prepare($sql);

        // Ejecutar con parámetros
            $stmt->execute($params);
            
        // Retornar el statement para procesar resultados return $stmt;
            return $stmt;
        } catch (PDOException $e) {
            die('Error en consulta: ' . $e->getMessage());
        }
    }
}
<?php
//require_once __DIR__ . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/config.php';

class Database {
    private static $instance = null;
    private $connection;
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $charset = DB_CHARSET;

    // Constructor privado para Singleton
    private function __construct() {
        $this->connect();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    private function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_PERSISTENT        => true
            ];

            $this->connection = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->handleDatabaseError($e);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    private function handleDatabaseError(PDOException $e) {
        $errorMessage = "Error de base de datos: " . $e->getMessage();
        $errorCode = $e->getCode();
        
        if (ENVIRONMENT === 'development') {
            die($errorMessage);
        } else {
            // En producción, registrar el error y mostrar mensaje genérico
            error_log($errorMessage);
            die("Error del sistema. Por favor intente más tarde.");
        }
    }

    // Evitar la clonación del objeto
    private function __clone() {}
}
?>
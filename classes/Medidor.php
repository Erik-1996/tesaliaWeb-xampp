<?php
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/classes/Database.php';

class Medidor {
    private $db;
    private $tablePrefix = 'medidor_';
    private $cacheFile;
    private $cacheDuration = 10; // Segundos de validez del caché

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->cacheFile = dirname(__DIR__) . '/cache/tables_cache.json';
        
        // Crear directorio de caché si no existe
        if (!file_exists(dirname($this->cacheFile))) {
            mkdir(dirname($this->cacheFile), 0755, true);
        }
    }

    /**
     * Obtiene todas las tablas con sistema de caché automático
     * @return array Lista de nombres de tablas
     */
    public function getAllTables() {
        // Verificar si el caché es válido y existe
        if ($this->isCacheValid()) {
            return $this->getFromCache();
        }
        
        // Obtener datos frescos de la base de datos
        $tables = $this->fetchTablesFromDB();
        
        // Actualizar el caché
        $this->updateCache($tables);
        
        return $tables;
    }

    /**
     * Fuerza la actualización del caché
     * @return array Lista actualizada de tablas
     */
    public function refreshTables() {
        $tables = $this->fetchTablesFromDB();
        $this->updateCache($tables);
        return $tables;
    }

    /**
     * Obtiene solo las tablas de medidores
     * @return array Tablas de medidores
     */
    public function getMedidorTables() {
        $allTables = $this->getAllTables();
        return array_filter($allTables, function($table) {
            return strpos($table, $this->tablePrefix) === 0;
        });
    }

    // ==================== MÉTODOS PRIVADOS ====================

    private function fetchTablesFromDB() {
        $stmt = $this->db->query("SHOW TABLES");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function isCacheValid() {
        return file_exists($this->cacheFile) && 
               (time() - filemtime($this->cacheFile)) < $this->cacheDuration;
    }

    private function getFromCache() {
        return json_decode(file_get_contents($this->cacheFile), true);
    }

    private function updateCache($data) {
        file_put_contents($this->cacheFile, json_encode($data));
    }
}
?>
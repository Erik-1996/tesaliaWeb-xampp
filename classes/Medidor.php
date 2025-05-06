<?php
require_once APP_ROOT . '/classes/Database.php';

class Medidor {
    private $db;
    private $table = 'medidorip67'; // Asumiendo que tienes una tabla con este nombre

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllMedidores() {
        try {
            $stmt = $this->db->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener medidores: " . $e->getMessage());
        }
    }

    public function getMedidorById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener medidor: " . $e->getMessage());
        }
    }

    public function getDatosEnergia($medidorId, $fechaInicio = null, $fechaFin = null) {
        try {
            $query = "SELECT * FROM medidor_{$medidorId}"; // Asumiendo tabla por medidor
            
            $conditions = [];
            $params = [];
            
            if ($fechaInicio) {
                $conditions[] = "fecha >= :fecha_inicio";
                $params[':fecha_inicio'] = $fechaInicio;
            }
            
            if ($fechaFin) {
                $conditions[] = "fecha <= :fecha_fin";
                $params[':fecha_fin'] = $fechaFin;
            }
            
            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }
            
            $query .= " ORDER BY fecha DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener datos de energía: " . $e->getMessage());
        }
    }
}
?>
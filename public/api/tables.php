<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';
require_once dirname(__DIR__, 2) . '/classes/Medidor.php';

header('Content-Type: application/json');

try {
    $action = $_GET['action'] ?? '';
    
    if ($action !== 'get_all') {
        throw new Exception('Acción no válida');
    }

    $medidor = new Medidor();
    $tables = $medidor->getAllTables(); // Usamos tu método existente
    
    echo json_encode([
        'status' => 'success',
        'data' => $tables
    ]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
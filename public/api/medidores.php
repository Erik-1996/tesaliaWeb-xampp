<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';
require_once dirname(__DIR__, 2) . '/classes/Medidor.php';

header('Content-Type: application/json');

try {
    $medidor = new Medidor();
    
    $action = $_GET['action'] ?? '';
    
    switch ($action) {
        case 'get_all_tables':
            $tables = $medidor->getMedidorTables();
            echo json_encode([
                'status' => 'success',
                'data' => $tables
            ]);
            break;
            
        default:
            throw new Exception('Acción no válida');
    }
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
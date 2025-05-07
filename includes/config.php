<?php
// Configuración de entorno
define('ENVIRONMENT', 'development');

// Configuración de rutas (CORREGIDO)
define('APP_ROOT', dirname(__DIR__)); // Ahora apunta a la raíz del proyecto
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', APP_ROOT));

// Resto de tu configuración...
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'data_energia');
define('DB_CHARSET', 'utf8mb4');

// Configuración de errores
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

//echo ($_SERVER['DOCUMENT_ROOT']);
?>
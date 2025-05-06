<?php
// Configuración de entorno
define('ENVIRONMENT', 'development'); // 'production' en entorno real

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Cambiar en producción
define('DB_PASS', '');     // Cambiar en producción
define('DB_NAME', 'data_energia');
define('DB_CHARSET', 'utf8mb4');

// Configuración de seguridad
define('APP_ROOT', dirname(dirname(__FILE__)));
define('BASE_URL', 'http://10.10.23.25/tesaliaWeb-xampp/public');

// Mostrar errores sólo en desarrollo
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>
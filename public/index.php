<?php
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/classes/Medidor.php';

$medidor = new Medidor();
$tablasMedidores = $medidor->getMedidorTables();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medidores Tesalia </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>

    <div id="graphDiv"></div>

    <div class="container">
        <h1>Monitor de Energía Tesalia</h1>
            
            <div id="tables-container" class="mt-4">
                <!-- Las tablas se cargarán aquí via JavaScript -->
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
        
        <div id="data-container" class="mt-4"></div>
    </div>



    <!-- Javascript -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- JS 
    <script type="module" src="../assets/js/main.js"></script>-->
    <script type="module" src="../assets/js/main2.js"></script>
    
</body>
</html>
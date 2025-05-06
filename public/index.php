<?php
require_once APP_ROOT . '/includes/config.php';
require_once APP_ROOT . '/classes/Medidor.php';

try {
    $medidorModel = new Medidor();
    $medidores = $medidorModel->getAllMedidores();
} catch (Exception $e) {
    $error = $e->getMessage();
}

require_once APP_ROOT . '/includes/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Monitor de Energía Tesalia</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <div class="row">
        <?php foreach ($medidores as $medidor): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($medidor['nombre']); ?></h5>
                        <p class="card-text">
                            <strong>Ubicación:</strong> <?php echo htmlspecialchars($medidor['ubicacion']); ?><br>
                            <strong>ID:</strong> <?php echo htmlspecialchars($medidor['id']); ?>
                        </p>
                        <a href="medidores/detalle.php?id=<?php echo $medidor['id']; ?>" class="btn btn-primary">
                            Ver datos detallados
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once APP_ROOT . '/includes/footer.php'; ?>
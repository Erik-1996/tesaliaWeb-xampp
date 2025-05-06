<?php require_once '../includes/config.php'; ?>
<?php require_once '../includes/header.php'; ?>

<div class="container">
    <h1 class="mt-5"><?php echo SITE_NAME; ?></h1>
    <p class="lead">Sistema de monitoreo de energía eléctrica</p>
    
    <div id="medidores-container" class="row">
        <!-- Los medidores se cargarán aquí via JavaScript -->
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
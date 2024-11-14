<?php
require_once 'classes/Transaccion.php';
require_once 'classes/EstadoDeCuenta.php';
require_once 'classes/GeneradorHtml.php'; // Cambiado aquí

session_start();
if (!isset($_SESSION['estadoDeCuenta'])) {
    $_SESSION['estadoDeCuenta'] = new EstadoDeCuenta();
}

$estadoDeCuenta = $_SESSION['estadoDeCuenta'];
$estadoDeCuentaTexto = null;

// Manejar registro de transacciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['descripcion'], $_POST['monto'])) {
        $descripcion = htmlspecialchars($_POST['descripcion']);
        $monto = (float) $_POST['monto'];
        $estadoDeCuenta->registrarTransaccion($descripcion, $monto);
    }

    if (isset($_POST['generar_estado'])) {
        $estadoDeCuentaTexto = $estadoDeCuenta->generarEstadoDeCuenta();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white text-center">
                    <h1>Sistema de Estado de Cuenta</h1>
                </div>
                <div class="card-body">
                    <?= GeneradorHtml::renderFormulario() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h3>Transacciones Registradas</h3>
                </div>
                <div class="card-body">
                    <?= GeneradorHtml::renderTablaTransacciones($estadoDeCuenta->obtenerTransacciones()) ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ($estadoDeCuentaTexto): ?>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="alert alert-info">
                    <h5>Estado de Cuenta Generado</h5>
                    <pre><?= $estadoDeCuentaTexto ?></pre>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


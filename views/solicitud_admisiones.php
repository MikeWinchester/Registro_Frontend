<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admisiones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/style_solicitud_admisiones.css">
</head>
<body>

<?php require __DIR__ . "/components/navbar.php"?>
    <div class="container-a">
        <div class="form-container">
            <h1>Verificar Estado de Solicitud</h1>
            <p>Por favor, ingresa tu número de solicitud para verificar el estado de la misma.</p>
            <div id="solicitudForm">
                <label for="numeroSolicitud">Ingresar número de solicitud</label>
                <input type="text" id="numeroSolicitud" placeholder="Ej. 123456789" required>
                <button type="button" id="submit-btn">Verificar</button>
            </div>
            <div id="resultado" class="resultado"></div>
        </div>
    </div>
    <?php require __DIR__ . "/components/footer.php";?>
    
    <script type="module" src="/assets/js/solicitudController.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>


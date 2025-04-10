<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error de permisos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <?php require __DIR__ . "/components/navbar.php"?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-danger text-center">
                    <h4 class="alert-heading">¡Acceso denegado!</h4>
                    <p>No tienes los permisos necesarios para acceder a esta página.</p>
                    <hr>
                    <a href="/index.php" class="btn btn-outline-danger">Volver al login</a>
                </div>
            </div>
        </div>
     </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro UNAH</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/style_login.css";>

</head>
<body>
<?php require __DIR__ . "/components/navbar.php"?>
    <section class="form-section">
        <div class="container-form">
            <div class="login-info">
                <div class="info-content">
                    <h2>Se Parte de la UNAH</h2>
                    <p>Recuerda que antes debes completar el proceso de admisión.</p>
                    <a href="?page=landing" class="btn-info">Regresar</a>
                    <p>Para iniciar su proceso de admisión, seleccione este botón.</p>
                    <a href="?page=formulario_admisiones" class="btn-info">Formulario de Admisiones</a>
                </div>
            </div>
            
            <div class="login-form">
                <div class="form-content">
                    <img src="https://nelsonmedinahn.wordpress.com/wp-content/uploads/2017/08/logo-unah.png" alt="Logo UNAH" class="logo">
                    <h2>Inicia Sesión</h2>
                    <p>Ingresa tu número de cuenta y contraseña</p>
                    <form class="form">
                        <div class="input-group">
                            <i class="bi bi-person"></i>
                            <input type="text" class="input-field" placeholder="Número de Cuenta">
                        </div>
                        <div class="input-group">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="input-field" placeholder="Contraseña">
                        </div>
                        <button type="button" class="btn-login">Acceder</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php require __DIR__ . "/components/footer.php"?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

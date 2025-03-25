<!DOCTYPE html>
<html lang="es">
<?php 
 include('components/navbar.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro UNAH</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
   
</head>

<body class="bg-dark">
    <
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100 justify-content-center">
    
            <div class="col-md-6 bg-white text-dark d-flex flex-column justify-content-center align-items-center py-5 rounded-start" style="max-width: 400px;">
                <img src="https://nelsonmedinahn.wordpress.com/wp-content/uploads/2017/08/logo-unah.png" alt="Logo UNAH" class="img-fluid mb-4" style="max-width: 180px;">
                <h2>Inicia Sesión</h2>
                <p>Ingresa tu número de cuenta y contraseña</p>
                
                <p class="text-muted"><a href="?page=landing" class="text-warning">Regresar</a></p>
            </div>

        
            <div class="col-md-6 bg-darkblue text-white p-5 rounded-end" style="max-width: 400px;">
                <form class="container">
                    <div class="mb-3">
                        <label for="accountNumber" class="form-label">Cuenta</label>
                        <input type="text" id="accountNumber" class="form-control rounded-pill" placeholder="Número de Cuenta" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" class="form-control rounded-pill" placeholder="Contraseña" required>
                    </div><br>
                    <button type="button" class="btn btn-warning w-100 py-2 rounded-pill">Acceder</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<style>
    .bg-darkblue {
        background-color: #002146 !important; /* Azul oscuro */
    }
    
    .rounded-start {
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }

    .rounded-end {
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
    }


    .form-control {
        border-radius: 50px !important; 
    }

    .btn-warning {
        border-radius: 50px !important; 
    }


body {
    position: relative;
    min-height: 100vh;
    background-image: url(https://tiempo.hn/wp-content/uploads/2024/02/Diseno-sin-titulo-2024-02-22T140928.765-1.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    backdrop-filter: blur(5px);
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: -1;
}

</style>

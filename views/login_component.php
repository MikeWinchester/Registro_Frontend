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
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <
            <div class="col-12 bg-white text-dark d-flex flex-column justify-content-center align-items-center py-5 rounded" style="max-width: 400px;">
                <img src="https://nelsonmedinahn.wordpress.com/wp-content/uploads/2017/08/logo-unah.png" alt="Logo UNAH" class="img-fluid mb-4" style="max-width: 180px;"><br>
                <h2>Inicia Sesión</h2>
                <p>Ingresa tu número de cuenta y contraseña</p>

                <form class="container">
                    <div class="mb-3">
                        <label for="accountNumber" class="form-label">Cuenta</label>
                        <input type="text" id="accountNumber" class="form-control rounded-pill" placeholder="Número de Cuenta" required style="border: 2px solid #007bff; background-color: #f0f8ff;">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" class="form-control rounded-pill" placeholder="Contraseña" required style="border: 2px solid #007bff; background-color: #f0f8ff;">
                    </div><br>
                
                    <button type="button" class="btn btn-primary w-100  rounded-pill">Acceder</button>
                </form>
        
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<style>
    
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


    .container-fluid {
        max-width: 100%;
        padding: 0;
    }


    .form-control {
        border-radius: 50px !important;
        border: 2px solid #007bff;
        background-color: #f0f8ff;
    }

    .btn-primary {
        background-color: #007bff; /* Color azul */
        border-color: #007bff;
        border-radius: 50px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    
    .rounded {
        border-radius: 20px !important;
    }


    .btn {
        width: 50%;
    }
</style>

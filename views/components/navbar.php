
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>

    <!--<link rel="stylesheet" href="../assets/css/navbar.css">-->
       

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="/Registro_Frontend/assets/css/navbar.css">
    
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container">
    
            <a class="navbar-brand" href="?page=landing">
                <img src="../assets/images/puma.png" alt="Logo UNAH" style="height: 40px; margin-right: 10px;">
                UNAH Registro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=landing">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Matrícula</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#biblioteca">Biblioteca Virtual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#docentes">Docentes</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admisiones
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?page=formulario_admisiones">Formulario de Admisión</a></li>
                            <li><a class="dropdown-item" href="?page=solicitud_admisiones"></a></li>
                            <li><a class="dropdown-item" href="?page=login">Revisores</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?page=login">Acceder</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
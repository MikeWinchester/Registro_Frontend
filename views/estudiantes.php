<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro UNAH</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
     <link rel="stylesheet" href="../assets/css/estudiante/style_estudiantes.css">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <img src="../assets/images/puma.png" alt="Logo UNAH" class="pumita" style="height: 40px; margin-right: 10px;">
            <a class="navbar-brand" href="#">UNAH Estudiante</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="?page=matricula_estudiantes">Matrícula</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=historial_estudiantes">Historial</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=login">Cerrar</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="conjunto_informacion">
        <div class="informacion">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="">
            <div class="info">
                <div>
                    <p class="info_personal"><strong>Cuenta:</strong> 20202020202</p>
                    <p class="info_personal"><strong>Nombre:</strong> Nombre Estudiante</p>
                    <p class="info_personal"><strong>Correo:</strong> estudiante@unah.hn</p>
                </div>
                <div>
                    <p class="info_personal"><strong>Centro:</strong> CIUDAD UNIVERSITARIA</p>
                    <p class="info_personal"><strong>Índice Global:</strong> 70</p>
                </div>
                <div>
                    <p><strong>Descripcion:</strong></p>
                    <textarea id="descripcion" placeholder="Agrega una descripción sobre ti..." rows="3"></textarea>
                </div>
            </div>
        </div>
        
        <div class="table-container">
            <table class="table table-dark table-striped" id="Table">
                <thead>
                    <tr>
                        <th scope="col">Código Asignatura</th>
                        <th scope="col">Nombre Asignatura</th>
                        <th scope="col">Sección</th>
                        <th scope="col">Nota</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><th scope="row">IS802</th><td>Ingeniería de Software</td><td>1100</td><td>100</td></tr>
                    <tr><th scope="row">IS601</th><td>Base de Datos II</td><td>1800</td><td>100</td></tr>
                    <tr><th scope="row">IS820</th><td>Finanzas Administrativas</td><td>1400</td><td>100</td></tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2025 Universidad Nacional Autónoma de Honduras | Todos los derechos reservados</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
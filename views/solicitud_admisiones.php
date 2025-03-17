<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admisiones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admisiones/style_solicitud_admisiones.css">
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="nav_bar">
        <div class="container">
            <img src="../assets/images/puma.png" alt="Logo UNAH" style="height: 40px; margin-right: 10px;">
            <a class="navbar-brand" href="#">UNAH Registro</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="incio.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="formulario_admisiones.php">Inscripcion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#biblioteca" aria-disabled="false">Solicitud</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#docentes">Revisiones</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="form-container">
            <h1>Verificar Estado de Solicitud</h1>
            <p>Por favor, ingresa tu número de solicitud para verificar el estado de la misma.</p>
            <form id="solicitudForm">
                <label for="numeroSolicitud">Ingresar número de solicitud</label>
                <input type="text" id="numeroSolicitud" placeholder="Ej. 123456789" required>
                <button type="submit">Verificar</button>
            </form>
            <div id="resultado" class="resultado"></div>
        </div>
    </div>

    <script>
        document.getElementById('solicitudForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const numeroSolicitud = document.getElementById('numeroSolicitud').value.trim();
        const resultadoDiv = document.getElementById('resultado');
        
        // Simulación de la validación de la solicitud
        let resultado = '';
        if (!numeroSolicitud) {
            resultado = 'Por favor ingresa un número de solicitud.';
            resultadoDiv.className = '';
            resultadoDiv.textContent = resultado;
            return;
        }

        // Validaciones
        if (numeroSolicitud === '123456789') {
            resultado = 'Tu solicitud está en revisión. Por favor, espera mientras se procesa.';
            resultadoDiv.className = 'en-progreso';
        } else if (numeroSolicitud === '987654321') {
            resultado = 'Tu solicitud ha sido aprobada. Estás listo para hacer el examen de admisión.';
            resultadoDiv.className = 'aprobado';
        } else if (numeroSolicitud === '111222333') {
            resultado = 'Tu solicitud ha sido rechazada. Puedes volver a subir los documentos o información requerida.';
            resultadoDiv.className = 'rechazado';
        } else {
            resultado = 'El número de solicitud ingresado no es válido. Verifica y vuelve a intentar.';
            resultadoDiv.className = 'numero-no-valido';
        }

        resultadoDiv.textContent = resultado;
    });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>

<?php
    include('components/footer.php');  // Incluir el archivo del navbar
?>
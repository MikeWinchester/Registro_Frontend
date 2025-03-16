<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión de Solicitudes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admisiones/style_peticiones.css">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="nav_bar">
        <div class="container">
            <img src="../assets/images/puma.png" alt="Logo UNAH" style="height: 40px; margin-right: 10px;">
            <a class="navbar-brand" href="#">UNAH Revision de Solicitud</a>
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

    
   <!-- Contenido principal -->
   <div class="container-solicitudes">
    <div class="titulo">Solicitudes Pendientes</div>

    <div class="solicitudes-row">
      <!-- Columna Izquierda: Listado de solicitudes -->
      <div class="col-izquierda">
        <div class="card-solicitud" onclick="seleccionarSolicitud('1234 56789','Juan Pérez')">
          <h3>Solicitud #1234 56789</h3>
          <p>Estudiante: Juan Pérez</p>
        </div>
        <div class="card-solicitud" onclick="seleccionarSolicitud('9876 54321','Ana García')">
          <h3>Solicitud #9876 54321</h3>
          <p>Estudiante: Ana García</p>
        </div>
        <div class="card-solicitud" onclick="seleccionarSolicitud('1122 33445','María López')">
          <h3>Solicitud #1122 33445</h3>
          <p>Estudiante: María López</p>
        </div>
        <div class="card-solicitud" onclick="seleccionarSolicitud('2233 44556','Carlos Sánchez')">
          <h3>Solicitud #2233 44556</h3>
          <p>Estudiante: Carlos Sánchez</p>
        </div>
      </div>

      <!-- Columna Derecha: Detalles de la solicitud seleccionada -->
      <div class="col-derecha">
        <div class="card-detalle">
          <div>
            <h3 id="solicitudTitulo">Seleccione una Solicitud</h3>
            <p id="solicitudEstudiante">Información del Estudiante</p>
          </div>
          <div class="botones-acciones">
          <i class="bi bi-pencil text-primary fs-3" onclick="verDocumentos()" style="cursor:pointer;"></i>
    <i class="bi bi-check-circle text-success fs-3" onclick="aceptarSolicitud()" style="cursor:pointer;"></i>
    <i class="bi bi-x-circle text-danger fs-3" onclick="rechazarSolicitud()" style="cursor:pointer;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


    <script>
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
  </script>
  <script>
    // Función para simular la selección de una solicitud
    function seleccionarSolicitud(numero, estudiante) {
      document.getElementById('solicitudTitulo').textContent = 'Solicitud #' + numero;
      document.getElementById('solicitudEstudiante').textContent = 'Estudiante: ' + estudiante;
    }

    function verDocumentos() {
      alert('Revisando los documentos de la solicitud...');
    }

    function aceptarSolicitud() {
      alert('Solicitud Aceptada');
    }

    function rechazarSolicitud() {
      alert('Solicitud Rechazada');
    }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    include('components/footer.php');  // Incluir el archivo del navbar
?>
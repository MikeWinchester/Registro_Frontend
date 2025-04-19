

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiante</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
       
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/estudiante.css">
   
 
</head>
<body>

   <?php 


    include('../../components/navbar.php'); 
    ?>

    <div class="container">
        <header>
            <h1><i class="bi bi-journal-bookmark"></i> Mis Cursos</h1>
            <div class="user-info">
                <span>Juan Pérez</span>
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Usuario" width="40" height="40" style="border-radius:50%">
            </div>
        </header>

        <!-- Listado de secciones -->
        <div class="secciones-container">
            <div class="seccion-card" data-seccion-id="matematicas">
                <h3><i class="bi bi-calculator"></i> Matemáticas</h3>
                <p><i class="bi bi-person"></i> Prof. Carlos Rojas</p>
                <p><i class="bi bi-calendar-week"></i> Lunes y Miércoles</p>
                <button class="btn ver-detalle-btn" data-seccion="matematicas">
                    <i class="bi bi-eye"></i> Ver detalles
                </button>
            </div>

            <div class="seccion-card" data-seccion-id="fisica">
                <h3><i class="bi bi-atom"></i> Física</h3>
                <p><i class="bi bi-person"></i> Prof. Ana Mendoza</p>
                <p><i class="bi bi-calendar-week"></i> Martes y Jueves</p>
                <button class="btn ver-detalle-btn" data-seccion="fisica">
                    <i class="bi bi-eye"></i> Ver detalles
                </button>
            </div>
        </div>

        <!-- Detalle de sección (Matemáticas) -->
        <div id="seccion-matematicas" class="seccion-detalle">
            <div class="seccion-header">
                <h2><i class="bi bi-calculator"></i> Matemáticas Avanzadas</h2>
                <button class="btn btn-volver">
                    <i class="bi bi-arrow-left"></i> Volver
                </button>
            </div>

            <div class="tabs">
                <div class="tab active" data-tab="clases">Videos</div>
                <div class="tab" data-tab="integrantes">Integrantes</div>
            
            </div>

            <!-- Contenido de pestañas -->
            <div id="clases" class="tab-content active">
                <div class="clase-item" data-video-url="https://www.youtube.com/embed/ABCD1234">
                    <h4><i class="bi bi-play-circle"></i> Introducción</h4>
                    <p>15/03/2023 - 45 min</p>
                    <div class="video-container">
                        <iframe src="" allowfullscreen></iframe>
                    </div>
                </div>
              
            </div>

            <!-- Pestaña de Integrantes -->
            <div id="integrantes" class="tab-content">
                <div class="search-container" style="margin-bottom:20px">
                    <input type="text" placeholder="Buscar integrantes..." style="padding:8px;width:100%;max-width:300px">
                </div>
                
                <div class="integrantes-container">
                    <!-- Profesor -->
                    <div class="integrante-card">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profesor" class="integrante-avatar">
                        <div>
                            <h4>Carlos Rojas</h4>
                            <span class="integrante-role profesor">Profesor</span>
                            <p><small>crojas@universidad.edu</small></p>
                        </div>
                    </div>

                    <!-- Estudiantes -->
                    <div class="integrante-card">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Estudiante" class="integrante-avatar">
                        <div>
                            <h4>María González</h4>
                            <span class="integrante-role">Estudiante</span>
                            <p><small>mgonzalez@universidad.edu</small></p>
                        </div>
                    </div>

                    <div class="integrante-card">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Estudiante" class="integrante-avatar">
                        <div>
                            <h4>Luis Pérez</h4>
                            <span class="integrante-role">Estudiante</span>
                            <p><small>lperez@universidad.edu</small></p>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar/ocultar detalle de sección
            document.querySelectorAll('.ver-detalle-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const seccionId = this.getAttribute('data-seccion');
                    document.querySelector('.secciones-container').style.display = 'none';
                    document.querySelector(`#seccion-${seccionId}`).style.display = 'block';
                });
            });

            // Volver al listado
            document.querySelector('.btn-volver').addEventListener('click', function() {
                document.querySelector('.secciones-container').style.display = 'grid';
                document.querySelector('.seccion-detalle').style.display = 'none';
            });

            // Cambio de pestañas
            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    const tabId = this.getAttribute('data-tab');
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                    document.getElementById(tabId).classList.add('active');
                });
            });

            // Mostrar videos
            document.querySelectorAll('.clase-item').forEach(item => {
                item.addEventListener('click', function() {
                    const iframe = this.querySelector('iframe');
                    iframe.src = this.getAttribute('data-video-url');
                    this.querySelector('.video-container').style.display = 'block';
                });
            });
        });
    </script>
</body>
</html>
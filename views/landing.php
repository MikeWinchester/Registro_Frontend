
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro UNAH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
  
     <link rel="stylesheet" href="../assets/css/landing.css">
     <link rel="stylesheet" href="../assets/css/navbar.css">
     <link rel="stylesheet" href="../assets/css/footer.css">
     <link rel="stylesheet" href="../assets/css/toastMessage.css">
    
</head>
<body>
<?php require __DIR__ . "../../components/navbar.php"?>
    
    <!-- Hero section con elementos decorativos -->
    <section class="hero">
        <div class="floating-elements">
            <div class="floating-element" style="width: 100px; height: 100px; top: 10%; left: 5%;"></div>
            <div class="floating-element" style="width: 150px; height: 150px; top: 60%; left: 80%;"></div>
            <div class="floating-element" style="width: 80px; height: 80px; top: 30%; left: 70%;"></div>
            <div class="floating-element" style="width: 120px; height: 120px; top: 70%; left: 10%;"></div>
        </div>
        <div class="unah-badge">#1 en Honduras</div>
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h1 class="hero-title">Bienvenidos a la UNAH</h1>
            <p class="hero-subtitle">La institución de educación superior más importante de Honduras, formando profesionales de excelencia desde 1847</p>
            <div class="btn-group">
                <a href="#" class="btn-unah btn-primary-unah">Admisiones 2025</a>
                <a href="#" class="btn-unah btn-secondary-unah">Conoce nuestras carreras</a>
            </div>
        </div>
    </section>

    <!-- Sección de números destacados -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="section-header">
                <h2 class="section-title" style="color: var(--unah-blue);">La UNAH en números</h2>
                <p class="section-subtitle" style="color: #666;">Nuestra trayectoria y alcance nos convierten en la principal universidad del país</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">175+</div>
                    <div class="stat-title">Años de historia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">80+</div>
                    <div class="stat-title">Programas académicos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">7</div>
                    <div class="stat-title">Centros regionales</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">50,000+</div>
                    <div class="stat-title">Estudiantes activos</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de carreras mejorada -->
    <section class="carreras-section">
        <div class="pattern-bg"></div>
        <div class="container carreras-container">
            <div class="section-header">
                <h2 class="section-title">Nuestras Facultades</h2>
                <p class="section-subtitle">Conoce las facultades y escuelas que componen nuestra universidad</p>
            </div>
            <div class="logos-grid">
                <div class="logo-card">
                    <img src="https://ingenieria.unah.edu.hn/assets/Ingenieria/paginas/resena-historica/_resampled/CroppedFocusedImageWyIyMDAiLCIyMDAiLCJ4IiwzXQ/F.I.-LOGO.png" alt="Ingeniería" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ingeniería</div>
                </div>
                
                <div class="logo-card">
                    <img src="https://fcm.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLGZhbHNlLDBd/FCM-LOGO.png" alt="Medicina" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias Médicas</div>
                </div>
                
                <div class="logo-card">
                    <img src="https://cienciasespaciales.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLCJ4IiwxXQ/logofaces-sinfondo.png" alt="Ciencias Espaciales" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias Espaciales</div>
                </div>
                
                <div class="logo-card">
                    <img src="https://ciencias.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLGZhbHNlLDBd/logo-ciencias.png" alt="Ciencias" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias</div>
                </div>
                
                <div class="logo-card">
                    <img src="https://th.bing.com/th/id/R.94d7bd08dc84b6dfe9a112818eaeb7e5?rik=UU%2fuEpw%2fgMaY%2fw&riu=http%3a%2f%2f3.bp.blogspot.com%2f-Sw97PhpS7ro%2fVB3UlHnNnjI%2fAAAAAAAAAB4%2fwHblrRmdJrk%2fs1600%2flogo-cienciaseconomicas.png&ehk=4OZ05ggzyc0Yni2t73VYPAqIvtixZ%2b95%2bLSnvudPylw%3d&risl=&pid=ImgRaw&r=0" alt="Ciencias Económicas" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias Económicas</div>
                </div>
                
                <div class="logo-card">
                    <img src="https://cienciasjuridicas.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLGZhbHNlLDBd/FCJ.png" alt="Derecho" class="facultad-logo">
                    <div class="facultad-name">Facultad de Ciencias Jurídicas</div>
                </div>
                
                <div class="logo-card">
                    <img src="https://humanidades.unah.edu.hn/assets/Uploads/_resampled/CroppedFocusedImageWyIxMTAiLCIxMTAiLGZhbHNlLDBd/logo-humanidades.png" alt="Humanidades" class="facultad-logo">
                    <div class="facultad-name">Facultad de Humanidades</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de noticias -->
    <section class="news-section">
        <div class="stats-container">
            <div class="section-header">
                <h2 class="section-title" style="color: var(--unah-blue);">Noticias y Eventos</h2>
                <p class="section-subtitle" style="color: #666;">Mantente informado sobre lo que acontece en nuestra universidad</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="news-card">
                        <img src="https://www.unah.edu.hn/uploads/news/images/2023/noticia-unah-2023.jpg" class="news-img" alt="Noticia 1">
                        <div class="news-body">
                            <div class="news-date">15 JUNIO 2023</div>
                            <h3 class="news-title">UNAH inaugura nuevo centro de investigación tecnológica</h3>
                            <p class="news-excerpt">El centro contará con laboratorios de última generación para impulsar la innovación en el país.</p>
                            <a href="#" class="facultad-link">Leer más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="news-card">
                        <img src="https://www.unah.edu.hn/uploads/news/images/2023/noticia-unah-2023-2.jpg" class="news-img" alt="Noticia 2">
                        <div class="news-body">
                            <div class="news-date">10 JUNIO 2023</div>
                            <h3 class="news-title">Convocatoria abierta para becas internacionales 2024</h3>
                            <p class="news-excerpt">Oportunidades de estudio en prestigiosas universidades de Europa y América Latina.</p>
                            <a href="#" class="facultad-link">Leer más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="news-card">
                        <img src="https://www.unah.edu.hn/uploads/news/images/2023/noticia-unah-2023-3.jpg" class="news-img" alt="Noticia 3">
                        <div class="news-body">
                            <div class="news-date">5 JUNIO 2023</div>
                            <h3 class="news-title">Foro internacional sobre desarrollo sostenible</h3>
                            <p class="news-excerpt">Expertos discutirán los desafíos del desarrollo sostenible en Honduras y la región.</p>
                            <a href="#" class="facultad-link">Leer más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="toast" class="toast">

    <script type="module">



    <?php require __DIR__ . "/components/footer.php"?>
    <script>
        // Animación para los elementos flotantes
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.floating-element');
            elements.forEach(el => {
                const duration = Math.random() * 20 + 10;
                const delay = Math.random() * 5;
                const direction = Math.random() > 0.5 ? 1 : -1;
                
                el.style.animation = `float ${duration}s ease-in-out ${delay}s infinite alternate`;
                el.style.setProperty('--direction', direction);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


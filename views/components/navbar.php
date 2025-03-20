<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
    
        <a class="navbar-brand" href="landing.php">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Docentes
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="?page=docentes">Docentes</a></li>
                        <li><a class="dropdown-item" href="#">Jefe de departamento</a></li>
                        <li><a class="dropdown-item" href="#">coordinadores</a></li>
                    </ul>
                </li>

                    <!-- Menú desplegable "Admisiones" -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admisiones
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="?page=formulario_admisiones">Formulario de Admisión</a></li>
                        <li><a class="dropdown-item" href="?page=solicitud_admisiones">Solicitud</a></li>
                        <li><a class="dropdown-item" href="?page=revision_admisiones">Revisores</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?page=login">Acceder</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
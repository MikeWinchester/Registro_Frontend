<!-- navbar.php (componente parcial) -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="landing.php">
            <img src="https://serviciosestudiantiles.unah.edu.hn/Content/images/logos/logo-unah-blanco.png" alt="Logo UNAH" style="height: 40px; margin-right: 10px;">
            UNAH Registro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="/matricula_estudiante/home">Matrícula</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=biblioteca_virtual">Biblioteca Virtual</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Docentes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="/teachers/home">Docentes</a></li>
                        <li><a class="dropdown-item" href="/jefes/home">Jefe de departamento</a></li>
                        <li><a class="dropdown-item" href="/coordinadores/home">Coordinadores</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admisiones
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <li><a class="dropdown-item" href="/admissions/form">Formulario de Admisión</a></li>
                        <li><a class="dropdown-item" href="/admissions/check">Solicitud</a></li>
                        <li><a class="dropdown-item" href="/reviewers/login">Revisores</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="/students/login">Pregrado</a></li>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar{
    background-color: #002146;
    padding: 1.15rem;
    border-bottom: 1px solid yellow ;
    width: 100%;
    position: relative;
    z-index: 1030;
}

.navbar-nav .nav-item {
    border: 2px solid transparent;
    border-radius: 5px;
    margin: 0 10px;
    transition: all 0.3s ease;
}

.navbar-nav .nav-item:hover {
    background-color: #f0ad4e;
    border-color: #f0ad4e;
}

.navbar-nav .nav-item a {
    color: white;
    padding: 10px 15px;
}

.navbar-nav .nav-item:hover a {
    color: white;
}

.navbar-nav .dropdown-menu {
    background-color: #002146;
    display: none;
    position: absolute;
    z-index: 1000;
}

.navbar-nav .dropdown-item:hover {
    background-color: #f0ad4e;
    color: white;
}

.navbar-nav .nav-item.dropdown:hover .dropdown-menu {
    display: block;
    opacity: 1;
    visibility: visible;
    transition: all 0.3s ease-in-out;
}

@media (max-width: 991.98px) {
    .navbar-collapse {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #002146;
        padding: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1020;
    }

    .navbar-nav {
        margin-top: 0.5rem;
    }

    .dropdown-menu {
        position: static !important;
        float: none;
        background-color: #002146;
        margin-left: 1rem;
        border: none;
    }
}
</style>

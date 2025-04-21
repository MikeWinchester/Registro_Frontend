
<?php
include('../../components/navbar.php');
session_start();

$allowedRoles = ['Estudiante'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    die(header('Location: /jefe_departamento.php'));
}
?>

<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    
    
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
   <!-- <link rel="stylesheet" href="../assets/css/docentes.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


</head>
<body>


<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 col-lg-3 d-md-block bg-unah-blue sidebar-container">
        <div class="sidebar">
        <ul class="nav flex-column sidebar-nav">
                <li class="nav-item">
                    <a href="#submenuPlan" class="nav-link sidebar-option" data-bs-toggle="collapse" aria-expanded="false" aria-controls="submenuPlan" data-page="#">
                    <i class="bi bi-book"></i> Asignaturas 
                    </a><br>
                
                    <ul class="collapse list-unstyled ps-3" id="submenuPlan">
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_adicionar_asignatura.php"><i class="bi bi-dot"></i> Adicionar Asignatura</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_cancelar_asignatura.php"><i class="bi bi-dot"></i> Cancelar Asignatura</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_lista_espera_asignatura.php"><i class="bi bi-dot"></i> Asignaturas en lista de espera</a></li><br>
                        <li><a href="#" class="text-decoration-none option" data-page="components/estudiante_clases_canceladas.php"><i class="bi bi-dot"></i> Asignaturas canceladas</a></li>
                    </ul>
                </li><br><br>

                <li class="nav-item">
                    <a href="#"  class="nav-link sidebar-option option" data-page="components/forma03.php"><i class="bi bi-calendar"></i> Forma 03</a>
                </li>
            </ul>
        </div>
        </nav>

    
        <main class="col-md-9 col-lg-9 content p-4 bg-white shadow rounded" id="main-content">
            <h2 class="text-center text-secondary">Selecciona una opción del menú</h2>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<script src="/matricula/assets/js/ayncEstudiante.js" type='module'></script>
<script src="/matricula/assets/js/comprobarMatricula.js" type='moudle'></script>

</body>
</html>

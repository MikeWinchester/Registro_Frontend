<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Clases</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    
    <link rel="stylesheet" href="../assets/css/clases.css">


</head>
<body>

<div class="container mt-5">
    <a href="docentes.php" class="back-link">
        <i class="fas fa-arrow-left"></i> Volver
    </a>

    <h2><i class="fas fa-chalkboard-teacher"></i> Clases Asignadas</h2>


    <div id="clasesAccordion" class="accordion">
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    I Periodo 2025
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#clasesAccordion">
                <div class="accordion-body">
                    <div class="accordion" id="secciones1">
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeccion1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeccion1" aria-expanded="true" aria-controls="collapseSeccion1">
                                    Matemáticas - Sección A
                                </button>
                            </h2>
                            <div id="collapseSeccion1" class="accordion-collapse collapse show" aria-labelledby="headingSeccion1" data-bs-parent="#secciones1">
                                <div class="accordion-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Aula</th>
                                                <th>Cupos</th>
                                                <th>Horario</th>
                                                <th>Lista de estudiantes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>101</td>
                                                <td>25</td>
                                                <td>08:00 - 10:00</td>
                                                <td><button class="btn btn-info">Descargar</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeccion2">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeccion2" aria-expanded="true" aria-controls="collapseSeccion2">
                                    Matemáticas - Sección B
                                </button>
                            </h2>
                            <div id="collapseSeccion2" class="accordion-collapse collapse" aria-labelledby="headingSeccion2" data-bs-parent="#secciones1">
                                <div class="accordion-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Aula</th>
                                                <th>Cupos</th>
                                                <th>Horario</th>
                                                <th>Lista de Estudiantes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>102</td>
                                                <td>0</td>
                                                <td>10:00 - 12:00</td>
                                                <td><button class="btn btn-info">Descargar</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secciones Programadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    


  <!-- Secciones Programadas-->

  <div class="container mt-4">
  <h2><i class="fas fa-chalkboard-teacher"></i>Secciones Programadas</h2><br>


<div id="clasesAccordion" class="accordion">
    
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading1">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                Programacion I 
            </button>
        </h2>
        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#clasesAccordion">
            <div class="accordion-body">
                <div class="accordion" id="secciones1">
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeccion1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeccion1" aria-expanded="true" aria-controls="collapseSeccion1">
                            Sección A
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
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>101</td>
                                            <td>25</td>
                                            <td>08:00 - 10:00</td>
                                            <td><button class="btn btn-info">Editar</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeccion2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeccion2" aria-expanded="true" aria-controls="collapseSeccion2">
                        Sección B
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
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>102</td>
                                            <td>0</td>
                                            <td>10:00 - 12:00</td>
                                            <td><button class="btn btn-info">Editar</button></td>
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



    <div class="col-md-12 mt-4">
            <div class="card p-4 shadow">
                <h4 class="text-center">Listas de Espera</h4>
                <table class="table  table-bordered mt-3">
                
        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Clase</th>
                            <th>Seccion</th>
                            <th>Edificio</th>
                            <th>Aula</th>
                            <th>Periodo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Matemáticas</td>
                            <td>1000</td>
                            <td>B2</td>
                            <td>110</td>
                            <td>2025</td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>









</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planificación de Período</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<style>

.table {
    margin-top: 20px;
}
.table th {
    background-color:rgb(3, 117, 239); 
    color: white;
    text-align: center;
}
.table td {
    text-align: center;
}
</style>


    <!-- Contenido principal -->
    <div class="container mt-4">
        <h2 class="text-center">Planificación del Próximo Período</h2>
        <div class="row"><br><br>
            <!-- Formulario para crear sección -->
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h4 class="text-center">Crear Nueva Sección</h4>
                    <div id="form">
                        <div class="mb-3" id="optionClass" >
                            <label class="form-label">Clase</label>
                            <select class="form-select">
                                <option>Seleccione una clase</option>
                            </select>
                        </div>
                        <div class="mb-3" id='optionDoc'>
                            <label class="form-label" >Docente</label>
                            <select class="form-select">
                                <option>Seleccione un docente</option>
                            </select>
                        </div>
                    
                        <div class="mb-3" id='optionCentro'>
                            <label class="form-label" >Centro Universitario</label>
                            <select class="form-select">
                                <option>Seleccione un Centro Universitario</option>
                            </select>
                        </div>
                        
                        <div class="mb-3" id='optionAula'>
                            <label class="form-label">Aula</label>
                            <select class="form-select">
                                <option>Seleccione un aula</option>
                                <option value="1"> Aula303 </option>
                                <option value="2"> Aula304 </option>
                                <option value="3"> Lab2 </option>
                            </select>
                        </div>
        
                        <div class="mb-3">
                        <label class="form-label">Días de Clase</label>
                        <div class="d-flex flex-wrap">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="lunes">
                                <label class="form-check-label" for="lunes">Lunes</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="martes">
                                <label class="form-check-label" for="martes">Martes</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="miercoles">
                                <label class="form-check-label" for="miercoles">Miércoles</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="jueves">
                                <label class="form-check-label" for="jueves">Jueves</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="viernes">
                                <label class="form-check-label" for="viernes">Viernes</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="sabado">
                                <label class="form-check-label" for="sabado">Sábado</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hora de Inicio</label>
                                <input type="time" class="form-control" id='h_ini'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hora de Fin</label>
                                <input type="time" class="form-control" id='h_final'>
                            </div>
                        </div>
                    </div>


                        <div class="mb-3">
                            <label class="form-label">Cupos</label>
                            <input type="number" class="form-control" id='cupos'>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100" id='create' onclick="crearSeccion()">Crear Sección</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secciones Programadas-->
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h4 class="text-center">Secciones Programadas</h4>
                    <div class="row g-3">
                        <!-- Tarjeta de sección -->
                        <div class="col-12">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Matemáticas</h5>
                                    <p class="card-text"><strong>Docente:</strong> Luis Verde</p>
                                    <p class="card-text"><strong>Horario:</strong> Lunes-Viernes  08:00 - 10:00</p>
                                    <p class="card-text"><strong>Cupos:</strong> 30</p>
                                    <div class="d-flex justify-content-between">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#aumentarCuposModal">Aumentar Cupos</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelarModal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Historia</h5>
                                    <p class="card-text"><strong>Docente:</strong> María López</p>
                                    <p class="card-text"><strong>Horario:</strong> Martes 10:00 - 12:00</p>
                                    <p class="card-text"><strong>Cupos:</strong> 25</p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#aumentarCuposModal">Aumentar Cupos</button>
 
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelarModal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                        
                

                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Listas de Espera -->
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

    <!-- Modal para Cancelar Sección -->
    <div class="modal fade" id="cancelarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancelar Sección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Justificación</label>
                    <textarea class="form-control" rows="3" placeholder="Escriba la razón de la cancelación..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger">Confirmar Cancelación</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para Aumentar Cupos -->
<div class="modal fade" id="aumentarCuposModal" tabindex="-1" aria-labelledby="aumentarCuposModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aumentarCuposModalLabel">Aumentar Cupos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="nuevoCupos" class="form-label">Nuevo número de Cupos</label>
                <input type="number" class="form-control" id="nuevoCupos" placeholder="Ingrese la nueva cantidad de cupos" min="1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirmar Cambio</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

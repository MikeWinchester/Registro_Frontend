<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Universitario - Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../../assets/css/toastMessage.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Portal Universitario</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="../dashboard.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../components/profile.php">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../components/chat.php">Chat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../components/grades.php">Notas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../components/requests.php">Trámites</a>
                        </li>
                    </ul>
                <div class="d-flex align-items-center">
                    <span class="text-light me-3" id="userName">Juan Pérez</span>
                    <button class="btn btn-outline-light" id="logoutBtn">Salir</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Notas Académicas</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Evaluación de Profesores</strong>
                    <p>Para ver tus notas completas, debes evaluar a tus profesores.</p>
                </div>
                
                <ul class="nav nav-tabs" id="gradesTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="current-tab" data-bs-toggle="tab" data-bs-target="#current" type="button">Actual</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button">Historial</button>
                    </li>
                </ul>
                
                <div class="tab-content mt-3" id="gradesTabContent">
                    <div class="tab-pane fade show active" id="current" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Clase</th>
                                        <th>Profesor</th>
                                        <th>Nota</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="table-notas">
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="history" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Período</th>
                                        <th>Clase</th>
                                        <th>Profesor</th>
                                        <th>Nota Final</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id='table-hist'>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id='toast' class='toast'>

    </div>

    <!-- Modal para evaluar profesor -->
    <div class="modal fade" id="evaluateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evaluateModalTitle">Evaluar Profesor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                        <input type="hidden" id="teacherId">
                        <div class="mb-3">
                            <label class="form-label">¿Cómo calificarías la claridad de las explicaciones?</label>
                            <div class="rating">
                                <input type="radio" id="star5-exp" name="clarity" value="5"><label for="star5-exp" title="Excelente">5</label>
                                <input type="radio" id="star4-exp" name="clarity" value="4"><label for="star4-exp" title="Muy Bueno">4</label>
                                <input type="radio" id="star3-exp" name="clarity" value="3"><label for="star3-exp" title="Bueno">3</label>
                                <input type="radio" id="star2-exp" name="clarity" value="2"><label for="star2-exp" title="Regular">2</label>
                                <input type="radio" id="star1-exp" name="clarity" value="1"><label for="star1-exp" title="Deficiente">1</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">¿Cómo calificarías la disponibilidad para consultas?</label>
                            <div class="rating">
                                <input type="radio" id="star5-avail" name="availability" value="5"><label for="star5-avail" title="Excelente">5</label>
                                <input type="radio" id="star4-avail" name="availability" value="4"><label for="star4-avail" title="Muy Bueno">4</label>
                                <input type="radio" id="star3-avail" name="availability" value="3"><label for="star3-avail" title="Bueno">3</label>
                                <input type="radio" id="star2-avail" name="availability" value="2"><label for="star2-avail" title="Regular">2</label>
                                <input type="radio" id="star1-avail" name="availability" value="1"><label for="star1-avail" title="Deficiente">1</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">¿Cómo calificarías la justicia en las evaluaciones?</label>
                            <div class="rating">
                                <input type="radio" id="star5-fair" name="fairness" value="5"><label for="star5-fair" title="Excelente">5</label>
                                <input type="radio" id="star4-fair" name="fairness" value="4"><label for="star4-fair" title="Muy Bueno">4</label>
                                <input type="radio" id="star3-fair" name="fairness" value="3"><label for="star3-fair" title="Bueno">3</label>
                                <input type="radio" id="star2-fair" name="fairness" value="2"><label for="star2-fair" title="Regular">2</label>
                                <input type="radio" id="star1-fair" name="fairness" value="1"><label for="star1-fair" title="Deficiente">1</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comentarios adicionales</label>
                            <textarea class="form-control" id="comments" rows="3"></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit"id='submitEvaluation' form="evaluationForm" class="btn btn-primary">Enviar Evaluación</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">© 2023 Universidad Ejemplo. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type='module' src="../../assets/js/grades.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Secciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?university,classroom') no-repeat center center/cover;
            height: 100vh;
            color: black;
        }
        .card-floating {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease-in-out;
        }
        .card-floating:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }
        .card-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>
    <link rel='stylesheet' href="/assets/css/modal.css">
    <link rel='stylesheet' href="/assets/css/toastMessage.css">
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="container">
      
        <div class="d-flex justify-content-center">
            <div class="card card-floating p-4" style="max-width: 500px; width: 100%;">
                <div class="card-header text-center fw-bold">
                     Nueva Sección
                </div>
                <div class="card-body">
                    <div id='form'>
                        <div class="mb-3" id='optionClass'>
                            <label class="form-label" >Clase</label>
                            <select class="form-select">
                                <option>Seleccione una clase</option>
                            </select>
                        </div>
                        <div class="mb-3" id='optionDoc'>
                            <label class="form-label">Docente</label>
                            <select class="form-select" id='docente'>
                                <option>Seleccione un docente</option>
                            </select>
                        </div>
                        <div class="mb-3" id="optionEdi">
                            <label class="form-label">Edificio</label>
                            <select class="form-select">
                                <option>Seleccione un Edificio</option>
                            </select>
                        </div>
                        <div class="mb-3" id="optionAula">
                            <label class="form-label" >Aula</label>
                            <select class="form-select" disabled>
                                <option>Seleccione un aula</option>
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
                                    <select class="form-label" id='hora_ini' disabled>
                                        <option value="" disabled selected>Hora Inicio</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                <select class="form-label" id='hora_fin' disabled>
                                    <option value="" disabled selected>Hora Final</option>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cupos</label>
                            <input type="number" class="form-control" id="cupos" disabled>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-warning w-100" id='btnCrear' disabled>Crear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="toast" class="toast">

        </div>


<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <!-- Header -->
      <div class="modal-header bg-info text-white rounded-top-4">
        <h5 class="modal-title" id="ModalLabel">Secciones</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <!-- Body -->
      <div class="modal-body">
        <h2>Crear Sección</h2>
        <p>¿Estás seguro de crear esta sección?</p>
      </div>
      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" id="cancelar" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="confirmar" class="btn btn-warning">Confirmar</button>
      </div>
    </div>
  </div>
</div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
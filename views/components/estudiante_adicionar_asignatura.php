<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección Profesional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="container_secciones p-5 shadow-lg rounded bg-white mt-5">
                <div class="d-flex flex-row gap-5 justify-content-center align-items-stretch">
                    
         
                    <div class="informacion_area flex-fill p-4 bg-white rounded border shadow-lg">
                        <h5 class="text-primary fw-bold mb-4">Área de Estudio</h5>
                        <label for="area" class="form-label w-100">
                            <select id="area" class="form-select form-control-lg w-100">
                                <option disabled selected>Seleccione un área de estudio</option>
                                <option value="ingenieria_sistemas">Ingeniería en Sistemas</option>
                                <option value="matematicas_puras">Matemáticas Puras</option>
                                <option value="fisica">Física</option>
                                <option value="ingenieria_civil">Ingeniería Civil</option>
                                <option value="mercadotecnia">Mercadotecnia</option>
                            </select>
                        </label>
                    </div>

                
                    <div class="informacion_asignatura flex-fill p-4 bg-white rounded border shadow-lg">
                        <h5 class="text-primary fw-bold mb-4">Asignaturas</h5>
                        <label for="asignatura" class="form-label w-100">
                            <select id="asignatura" class="form-select form-control-lg w-100">
                                <option disabled selected>Seleccione una asignatura</option>
                            </select>
                        </label>
                    </div>

                    <!-- Información de Secciones -->
                    <div class="informacion_seccion flex-fill p-4 bg-white rounded border shadow-lg">
                        <h5 class="text-primary fw-bold mb-4">Sección</h5>
                        <label for="seccion" class="form-label w-100">
                            <select id="seccion" class="form-select form-control-lg w-100">
                                <option disabled selected>Seleccione una sección</option>
                            </select>
                        </label>
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-primary btn-lg shadow">
                        Agregar
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

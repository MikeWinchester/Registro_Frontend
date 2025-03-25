<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vista de Evaluaciones y Historial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border-radius: 15px;
        }
        .card-header, .card-footer {
            background-color: #f7f9fc;
        }
        .form-select, .form-control {
            border-radius: 10px;
            padding: 10px;
        }
        .btn {
            border-radius: 10px;
            padding: 10px 20px;
        }
        .table {
            border-radius: 15px;
            overflow: hidden;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        .table-dark {
            background-color: #343a40;
            color: white;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .shadow {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .text-center {
            color: #333;
        }
        .mt-4 {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row">
     
        <div class="col-md-6 mb-4">
            <div class="card p-4 shadow">
                <h4 class="text-center">Evaluaciones de Estudiantes a Docentes</h4><br><br>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Seleccionar Docente</label>
                        <select class="form-select">
                            <option>Seleccionar Docente</option>
                            <option>Juan Pérez</option>
                            <option>María López</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Seleccionar Materia</label>
                        <select class="form-select">
                            <option>Seleccionar Materia</option>
                            <option>Matemáticas</option>
                            <option>Historia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Seleccionar Periodo</label>
                        <select class="form-select">
                            <option>Seleccionar Periodo</option>
                            <option>2025</option>
                            <option>2024</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Ver Evaluaciones</button>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="col-md-6 mb-4">
            <div class="card p-4 shadow">
                <h4 class="text-center">Historial de Estudiante</h4>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Cuenta del Estudiante</label>
                        <input type="text" class="form-control" placeholder="Ingrese cuenta del Estudiante">
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary w-100" onclick="window.location.href='components/infoEstudiantes.php'">Ver Historial</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Resultados de Evaluaciones (Tabla) -->
    <div class="mt-4">
        <h4 class="text-center">Resultados de Evaluaciones</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Estudiante</th>
                        <th>Calificación</th>
                        <th>Comentarios</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Carlos Martínez</td>
                        <td>4.5</td>
                        <td>Excelente desempeño en la materia.</td>
                        <td>2025-02-20</td>
                    </tr>
                    <tr>
                        <td>Ana Gómez</td>
                        <td>3.8</td>
                        <td>Buena participación, pero necesita mejorar.</td>
                        <td>2025-02-21</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


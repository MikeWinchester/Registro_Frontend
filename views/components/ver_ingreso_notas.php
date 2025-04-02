<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Revisión de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border-radius: 12px;
            border: none;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #003d4d;
            color: white;
            font-weight: bold;
            padding: 20px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .table-header {
            background-color: #005f73;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-primary {
            background-color: #ffcc00;
            color: #333;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #e6b800;
        }
        .group-header {
            background-color: #d9edf7;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Filtrar Notas</div>
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="docente" class="form-label">Docente:</label>
                        <select id="docente" class="form-select">
                            <option>Seleccionar Docente</option>
                            <option>Juan Pérez</option>
                            <option>María López</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="materia" class="form-label">Materia:</label>
                        <select id="materia" class="form-select">
                            <option>Seleccionar Materia</option>
                            <option>Matemáticas</option>
                            <option>Historia</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="periodo" class="form-label">Periodo:</label>
                        <select id="periodo" class="form-select">
                            <option>Seleccionar Periodo</option>
                            <option>2025</option>
                            <option>2024</option>
                        </select>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <h4 class="text-center">Notas Registradas</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-header">
                    <tr>
                        <th>Docente</th>
                        <th>Materia</th>
                        <th>Estudiante</th>
                        <th>Nota</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Grupo: Juan Pérez - Matemáticas -->
                    <tr class="group-header">
                        <td rowspan="3">Juan Pérez</td>
                        <td rowspan="3">Matemáticas</td>
                        <td>Carlos Martínez</td>
                        <td>4.5</td>
                        <td>2025-02-20</td>
                    </tr>
                    <tr>
                        <td>Pedro López</td>
                        <td>4.9</td>
                        <td>2025-02-22</td>
                    </tr>
                    <tr>
                        <td>Laura Sánchez</td>
                        <td>4.2</td>
                        <td>2025-02-25</td>
                    </tr>

                    <!-- Grupo: María López - Historia -->
                    <tr class="group-header">
                        <td rowspan="2">María López</td>
                        <td rowspan="2">Historia</td>
                        <td>Ana Gómez</td>
                        <td>3.8</td>
                        <td>2025-02-21</td>
                    </tr>
                    <tr>
                        <td>Roberto Núñez</td>
                        <td>4.1</td>
                        <td>2025-02-24</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

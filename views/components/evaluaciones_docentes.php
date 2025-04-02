<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evaluaciones a Docentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border-radius: 8px;
            border: none;
            background-color: #ffffff;
        }
        .form-select, .form-control {
            padding: 12px 20px;
            font-size: 16px;
            width: 100%;
            border: 1px solid #99b3cc; /* Azul suave en el borde */
            background-color: #f9fafb;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-select:focus, .form-control:focus {
            border-color: #005f73; /* Azul oscuro en focus */
            box-shadow: 0 0 5px rgba(0, 95, 115, 0.5); /* Sombra azul oscura */
        }
        .btn {
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
            border: none;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #ffcc00; /* Amarillo para el botón */
            color: #333;
        }
        .btn-primary:hover {
            background-color: #e6b800; /* Amarillo más oscuro en hover */
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table-header {
            background-color:rgb(81, 130, 223); /* Azul oscuro para el encabezado */
            color: white;
            font-weight: bold;
        }
        .filter-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Diseño responsivo */
            gap: 20px;
            margin-bottom: 30px;
        }
        .card-header {
            background-color:rgb(106, 153, 240); /* Azul oscuro para el encabezado de la tarjeta */
            color: white;
            font-weight: bold;
            padding: 20px;
        }
        .card-body {
            background-color: #f9fafb;
            padding: 30px;
        }
        .search-btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">Buscar Evaluaciones</div>
        <div class="card-body">
            <form>
                <div class="filter-bar">
                    <div>
                        <label for="docente" class="form-label">Docente:</label>
                        <select id="docente" class="form-select">
                            <option>Seleccionar Docente</option>
                            <option>Juan Pérez</option>
                            <option>María López</option>
                        </select>
                    </div>
                    <div>
                        <label for="asignatura" class="form-label">Asignatura:</label>
                        <select id="asignatura" class="form-select">
                            <option>Seleccionar Asignatura</option>
                            <option>Matemáticas</option>
                            <option>Historia</option>
                        </select>
                    </div>
                    <div>
                        <label for="periodo" class="form-label">Periodo:</label>
                        <select id="periodo" class="form-select">
                            <option>Seleccionar Periodo</option>
                            <option>2025</option>
                            <option>2024</option>
                        </select>
                    </div>
                </div>
                <!-- Botón de búsqueda -->
                <div class="search-btn-container">
                    <button type="submit" class="btn btn-primary">Buscar Evaluaciones</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados de Evaluaciones (Tabla) -->
    <div class="mt-4">
        <h4 class="text-center">Resultados de Evaluaciones</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-header">
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
                    <tr>
                        <td>Pedro López</td>
                        <td>4.9</td>
                        <td>Rendimiento excepcional.</td>
                        <td>2025-02-22</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

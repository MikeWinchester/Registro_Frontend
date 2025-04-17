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
          
        }
        :root {
    --azul-oscuro: #2c5282;
    --azul-medio: #4299e1;
    --azul-claro: #ebf8ff;
    --gris-claro: #f8fafc;
    --gris-medio: #e2e8f0;
    --texto-oscuro: #1a202c;
    --texto-medio: #4a5568;
}

.card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    background-color: white;
    border-top: 4px solid var(--azul-medio);
    padding: 30px;
}

.card-header {
    background-color: white;
    color: var(--texto-oscuro);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--gris-medio);
}



.card-title {
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--texto-oscuro);
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


<div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="bi bi-calendar title-icon"></i>
                    Calificaciones 
                </h4>
            </div>
            <div>

            <div class="filter-bar">
                    <div>
                        <label for="docente" class="form-label">Docente:</label>
                        <select id="docente" class="form-select">
                            <option value="" selected disabled>Selecciones un Docente</option>
                        </select>
                    </div>
                    <div>
                        <label for="asignatura" class="form-label">Asignatura:</label>
                        <select id="asignatura" class="form-select">
                            <option value="" selected disabled>Selecciones una Asignatura</option>
                        </select>
                    </div>
                    <div>
                        <label for="periodo" class="form-label">Periodo:</label>
                        <select id="periodo" class="form-select">
                            <option value="" selected disabled>Selecciones un Periodo</option>
                        </select>
                    </div>
                </div>
                <!-- Botón de búsqueda -->
                <div class="search-btn-container">
                    <button id='search' class="btn btn-primary">Buscar Evaluaciones</button>
                </div>
        </div>


        <div id="loader-eva" class="text-center mt-2" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                
            </div>
        </div>

        <!-- Resultados de Evaluaciones (Tabla) -->
    <div class="mt-4">
        <h4 class="text-center">Resultados de Evaluaciones</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-header">
                    <tr>
                        <th>Asignatura</th>
                        <th>Docente</th>
                        <th>Estudiante</th>
                        <th>N. Cuenta</th>
                        <th>Calificación</th>
                        <th>Observacion</th>
                        <th>Periodo</th>
                    </tr>
                </thead>
                <tbody id='body-table'>
                    
                </tbody>
            </table>
            <div id="loader-table" class="text-center mt-2" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                
            </div>
        </div>


            </div>
    </div>
 </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases en Lista de Espera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }
        /*.container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }*/
        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        .table tbody tr {
            background-color: #f9f9f9;
        }
        .table td {
            vertical-align: middle;
        }
        .instruction-text {
            font-size: 1rem;
            color: #6c757d;
            margin-top: 20px;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Clases en Lista de Espera</h2>

    <!-- Tabla de clases en lista de espera -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Asignatura</th>
                    <th>Sección</th>
                    <th>HI</th>
                    <th>HF</th>
                    <th>Días</th>
                    <th>Edificio</th>
                    <th>Aula UV</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="data-table">
                <!-- Datos estáticos de clases en lista de espera -->
                
             
             
            </tbody>            
        </table>
    </div>
    <div id="loader-esp" class="text-center mt-2" style="display: none;">
        <div class="spinner-border text-primary" role="status">

        </div>
    </div>

 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

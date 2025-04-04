<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelar Asignatura</title>
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
        .btn-cancel {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .btn-cancel:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        .table-responsive {
            margin-top: 30px;
        }
        .instruction-text {
            font-size: 1rem;
            color: #6c757d;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Cancelar Asignatura</h2>

  
    <div class="table-responsive" id='table-asig'>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Asignatura</th>
                    <th>Horario</th>
                    <th>aula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
               
               
            </tbody>
        </table>
    </div>
    <div id="loader-can" class="text-center mt-2" style="display: none;">
        <div class="spinner-border text-primary" role="status">

        </div>
    </div>

    <p class="instruction-text text-center">
        Haz clic en "Cancelar" para eliminar la asignatura seleccionada de tu plan de estudios.
    </p>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

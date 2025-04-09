<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clases Canceladas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }
       /* .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }*/


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
    </style>
</head>
<body>


<div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="bi bi-calendar title-icon"></i>
                    Asignaturas Canceladas
                </h4>
            </div>

            <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Asignatura</th>
                    <th>Sección</th>
                    <th>HTF</th>
                    <th>Días</th>
                    <th>Edificio</th>
                    <th>Aula </th>
                </tr>
            </thead>
            <tbody id='data-can'>
                <!-- Datos estáticos de clases canceladas -->
                
            </tbody>
        </table>
    </div>
    <div id="loader-can" class="text-center mt-2" style="display: none;">
        <div class="spinner-border text-primary" role="status">

        </div>
    </div>

    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

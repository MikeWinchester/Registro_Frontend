<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Espera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c5282;
            --secondary-color: #4299e1;
            --light-blue: #ebf8ff;
            --light-gray: #f8f9fa;
            --border-color: #dee2e6;
            --text-dark: #212529;
            --text-medium: #495057;
        }
        
        body {
            background-color: #f8fafc;
          
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--light-blue), var(--secondary-color));
            color: black;
            padding: 1.25rem;
            border-bottom: none;
        }
        
        .card-title {
            font-weight: 600;
            margin: 0;
            display: flex;
           /* align-items: center;*/
           /* justify-content: center;*/
            gap: 10px;
        }
        
        .table {
            margin-top: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
            padding: 0.75rem 1rem;
            position: sticky;
            top: 0;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: var(--light-blue);
        }
        
        .table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
            color: var(--text-medium);
        }
        
        .table-bordered {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table-bordered thead th:first-child {
            border-top-left-radius: 8px;
        }
        
        .table-bordered thead th:last-child {
            border-top-right-radius: 8px;
        }
        
        .badge-waiting {
            background-color: #f6e05e;
            color: #975a16;
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 50rem;
        }
        
        #loader-espera {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            border-radius: 8px;
        }
        
        .spinner-border {
            width: 2rem;
            height: 2rem;
            border-width: 0.2em;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="bi bi-list-check"></i>
                        Listas de Espera
                    </h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Clase</th>
                                <th>Sección</th>
                                <th>Edificio</th>
                                <th>Aula</th>
                                <th>Periodo</th>
                                <th>N. Espera</th>
                            </tr>
                        </thead>
                        <tbody id='body-table'>
                            <!-- Contenido dinámico -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="loader-espera" class="text-center" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p class="mt-2 text-muted">Cargando listas de espera...</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
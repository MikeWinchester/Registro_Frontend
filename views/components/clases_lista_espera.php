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
}

.card-header {
    background-color: white;
    color: var(--texto-oscuro);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--gris-medio);
}
.card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    background-color: white;
    border-top: 4px solid var(--azul-medio);
}



.card-title {
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--texto-oscuro);
}


        .table {
            margin-top: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead th {
            background-color: var(--primary-color);
            color: black;
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



<div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="bi bi-calendar title-icon"></i>
                    Clases en lista de espera
                </h4>
            </div>
            <div>

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




                    <div id="loader-espera" class="text-center" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p class="mt-2 text-muted">Cargando listas de espera...</p>
        </div>
    </div>

            </div>
    </div>
 </div>


   
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
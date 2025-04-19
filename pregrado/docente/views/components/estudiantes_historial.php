<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Académico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        
        
         /* .container {
            width: 90%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }*/

        h2, h3 {
            text-align: center;
            color: #333;
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

        .info-container {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }

        .info-container p {
            margin: 5px 0;
            font-size: 12px;
        }

        .info-container .photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #ddd;
            margin-right: 20px;
        }

        .table-container {
            margin-top: 20px;
        }

        .table th {
            background-color: #4A90E2;
            color: white;
            text-align: center;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

       
        .search-bar {
            display: flex;
            /*justify-content: center;*/
            /*align-items: center;*/
            gap: 10px;
            padding: 10px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        .search-bar input {
            flex: 1;
            padding: 5px;
            border: 2px solid #4A90E2;
            border-radius: 20px;
            outline: none;
            font-size: 16px;
        }

        .search-bar button {
            background-color: #ffcc00;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            color: #333;
            transition: background 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #e6b800;
        }

    </style>
</head>
<body>


<div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="bi bi-calendar title-icon"></i>
                    Historial Academico
                </h4>
            </div>



            <div class="search-bar">
        <input type="text" class="form-control" id='inputCuenta' placeholder="Buscar por cuenta">
        <button class="btn" id='searchBtn'>Buscar</button>
    </div><br><br>

    <div class="info-container">
        <div class="photo" style="background-image: url('https://via.placeholder.com/120'); background-size: cover; background-position: center;"></div>
        <div>
            <h3>Información del Estudiante</h3><br>
            <div class="row" id='info'>
               
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código de Asignatura</th>
                    <th>Asignatura</th>
                    <th>UV</th>
                    <th>Sección</th>
                    <th>Año</th>
                    <th>Período</th>
                    <th>Calificación</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody id='body-table'>
                
            </tbody>
        </table>

    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

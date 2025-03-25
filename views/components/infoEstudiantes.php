<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Académico</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    
   
    
</head>
<body>

<style>

body {
            background: linear-gradient(to right, #4A90E2, #F6E0A5);
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            text-align: center;
            color: #333;
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

</style>



    <div class="container">
        <h2>Historial Académico</h2><br>

   \
        <div class="mb-4 text-center">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar por cuenta">
                <button class="btn btn-success">Buscar</button>
            </div>
        </div>

        <div class="info-container">
        
            <div class="photo" style="background-image: url('https://via.placeholder.com/120'); background-size: cover; background-position: center;"></div>
            <div>
                <h3>Información del Estudiante</h3><br>
                <div class="row">
                
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> Pedro Pérez</p>
                        <p><strong>Carrera:</strong> Ingeniería en Sistemas</p>
                    </div>
                    
                    <div class="col-md-6">
                        <p><strong>Centro Universitario:</strong> CU Tegucigalpa</p>
                        <p><strong>Índice Global:</strong> 85.4</p>
                        <p><strong>Índice de Período:</strong> 87.2</p>
                    </div>
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
                <tbody>
                    <tr>
                        <td>MAT101</td>
                        <td>Matemáticas I</td>
                        <td>4</td>
                        <td>001</td>
                        <td>2023</td>
                        <td>1</td>
                        <td>85</td>
                        <td>Aprobado</td>
                    </tr>
                    <tr>
                        <td>PRO102</td>
                        <td>Programación</td>
                        <td>3</td>
                        <td>002</td>
                        <td>2023</td>
                        <td>1</td>
                        <td>90</td>
                        <td>Aprobado</td>
                    </tr>
                    <tr>
                        <td>FIS201</td>
                        <td>Física II</td>
                        <td>4</td>
                        <td>003</td>
                        <td>2023</td>
                        <td>2</td>
                        <td>78</td>
                        <td>Aprobado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

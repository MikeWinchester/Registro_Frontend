<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Carga de Período</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        
        body {
            background: linear-gradient(to right, #4A90E2, #F6E0A5);
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

       /* .container {
            width: 100%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px; 
        }*/

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;  
        }

        .download-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;  
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            max-width: 100%;  
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px 15px; 
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 13px;  
            font-family: 'Arial', sans-serif;  
        }

        th {
            background-color: #4A90E2;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        tr:hover td {
            background-color: #e2f4fc;
        }

        tr:first-child td {
            border-top: 2px solid #007bff;
        }

        tr:last-child td {
            border-bottom: 2px solid #007bff;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #777;
            font-size: 12px;  
        }
            
    </style>
</head>
<body>

    <div class="container">
        <h2>Gestión de Carga de Período</h2>

        
        <div class="download-buttons">
            <button class="btn btn-primary">Descargar en Excel</button>
            <button class="btn btn-primary">Descargar en PDF</button>
        </div>

        
        <table>
            <thead>
                <tr>
                    <th>Número de Sección</th>
                    <th>Código de Asignatura</th>
                    <th>Nombre de Asignatura</th>
                    <th>Número de Empleado</th>
                    <th>Docente Asignado</th>
                    <th>Cantidad de Estudiantes</th>
                    <th>Cupos Habilitados</th>
                    <th>Edificio</th>
                    <th>Aula</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>001</td>
                    <td>MAT101</td>
                    <td>Matemáticas Básicas</td>
                    <td>E12345</td>
                    <td>Juan Pérez</td>
                    <td>30</td>
                    <td>35</td>
                    <td>A</td>
                    <td>101</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>FIS101</td>
                    <td>Física Básica</td>
                    <td>E54321</td>
                    <td>María López</td>
                    <td>25</td>
                    <td>30</td>
                    <td>B</td>
                    <td>201</td>
                </tr>
        
            </tbody>
        </table>
    </div>



</body>
</html>

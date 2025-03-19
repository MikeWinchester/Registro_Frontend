<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Académico</title>
    <style>
        /* Estilos generales */
        /*body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4A90E2, #F6E0A5);
            margin: 0;
            padding: 20px;
        }*/

        /*.container {
            width: 90%;
            height: 50%;
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

        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 10px;
            font-size: 14px;
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #218838;
        }

        .info-container {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .info-container p {
            margin: 5px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #4A90E2;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>Historial Académico</h2><br>

        <!-- Filtro de búsqueda -->
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Buscar por nombre o cuenta">
            <button class="search-button">Buscar</button>
        </div>

        <!-- Información del estudiante -->
        <div class="info-container">
            <h3>Información del Estudiante</h3>
            <p><strong>Nombre:</strong> Pedro Pérez</p>
            <p><strong>Carrera:</strong> Ingeniería en Sistemas</p>
            <p><strong>Centro Universitario:</strong> CU Tegucigalpa</p>
            <p><strong>Índice Global:</strong> 85.4</p>
            <p><strong>Índice de Período:</strong> 87.2</p>
        </div>

        <!-- Historial académico -->
        <div class="table-container">
            <h3>Historial Académico</h3>
            <table>
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
                    <!-- Datos de ejemplo -->
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

</body>
</html>

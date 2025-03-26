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

<div class="container mt-5">
    <h2 class="text-center">Clases Canceladas</h2>

    <!-- Tabla de clases canceladas -->
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
            <tbody>
                <!-- Datos estáticos de clases canceladas -->
                <tr>
                    <td>MAT101</td>
                    <td>Matemáticas I</td>
                    <td>A</td>
                    <td>3 HTF</td>
                    <td>Lunes, Miércoles, Viernes</td>
                    <td>Edificio A</td>
                    <td>Aula 101</td>
                </tr>
                <tr>
                    <td>FIS202</td>
                    <td>Física General</td>
                    <td>B</td>
                    <td>4 HTF</td>
                    <td>Martes, Jueves</td>
                    <td>Edificio B</td>
                    <td>Aula 202</td>
                </tr>
                <tr>
                    <td>QUI301</td>
                    <td>Química Orgánica</td>
                    <td>C</td>
                    <td>3 HTF</td>
                    <td>Lunes, Miércoles</td>
                    <td>Edificio C</td>
                    <td>Aula 303</td>
                </tr>
                <tr>
                    <td>BIO401</td>
                    <td>Biología Celular</td>
                    <td>D</td>
                    <td>2 HTF</td>
                    <td>Martes</td>
                    <td>Edificio D</td>
                    <td>Aula 404</td>
                </tr>
                <tr>
                    <td>HIS505</td>
                    <td>Historia Universal</td>
                    <td>E</td>
                    <td>3 HTF</td>
                    <td>Lunes, Viernes</td>
                    <td>Edificio E</td>
                    <td>Aula 505</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

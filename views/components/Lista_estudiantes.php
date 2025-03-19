<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
 
    
    <link rel="stylesheet" href="../../assets/css/lista_estudiantes.css">


    
   
</head>


<body>

    <section class="student-list-section">
        <h2 class="section-title">Lista de Estudiantes</h2>

        <div class="table-wrapper">
            <table class="student-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Numero de cuenta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>juan@example.com</td>
                        <td>882255222</td>
                        <td><button class="btn-action">Ver Detalles</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>María García</td>
                        <td>maria@example.com</td>
                        <td>558852852</td>
                        <td><button class="btn-action">Ver Detalles</button></td>
                    </tr>
                    <!-- Más filas de estudiantes -->
                </tbody>
            </table>
        </div>

        <button class="btn-download">Descargar Lista</button>
    </section>

</body>
</html>

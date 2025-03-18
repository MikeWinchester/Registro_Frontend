<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Clases</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../../assets/css/docentes/clases.css">
</head>
<body>

<a href="docentes.php" class="back-link">◄ Volver</a>

<div class="container">
    <h2 class="mb-4"> Clases Asignadas</h2>

    <table id="tablaClases" class="table table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Materia</th>
                <th>Aula</th>
                <th>Cupos</th>
                <th>Horario</th>
                <th>Estudiantes</th>
            </tr>
        </thead>
        <tbody id="tablaClasesBody">
            <tr>
                <td colspan="5" class="text-center">Cargando datos...</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="../../assets/js/seccionesDocentes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

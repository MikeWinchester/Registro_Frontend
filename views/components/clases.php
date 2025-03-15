<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Clases</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="/Registro_Frontend/assets/css/docentes/clases.css">
</head>
<body>

<a href="docentes.php" class="back-link">◄ Volver</a>

<div class="container">
    <h2 class="mb-4"> Clases Asignadas</h2>

    <table class="table table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Materia</th>
                <th>Grupo</th>
                <th>Sección</th>
                <th>Estudiantes</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Simulación de datos (debería venir de la BD)
                $clases = [
                    ["id" => 1, "materia" => "Matemáticas", "grupo" => "3A", "estudiantes" => 30],
                    ["id" => 2, "materia" => "Historia", "grupo" => "2B", "estudiantes" => 25],
                    ["id" => 3, "materia" => "Física", "grupo" => "1C", "estudiantes" => 28]
                ];
                
                foreach ($clases as $index => $clase) {
                    echo "<tr>
                        <td>".($index + 1)."</td>
                        <td>{$clase['materia']}</td>
                        <td>{$clase['grupo']}</td>
                        <td>{$clase['estudiantes']}</td>
                        <td><a href='lista_estudiantes.php?clase_id={$clase['id']}' class='btn btn-info btn-sm'>Ver lista de estudiantes</a></td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

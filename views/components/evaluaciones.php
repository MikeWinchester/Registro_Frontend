<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    

    <title>Document</title>
</head>
<body>



<div class="card">
    <div class="card-body">
        <h4 class="card-title">📝 Subir Evaluaciones / Calificaciones</h4>
        <label for="claseSeleccionada" class="form-label">Selecciona una clase:</label>
        <select id="claseSeleccionada" class="form-select" onchange="cargarEstudiantes()">
            <option value="" selected disabled>Selecciona una opción</option>
            
        </select>

        <div id="estudiantesContainer" class="mt-4">
            <!-- Aquí se cargarán los estudiantes dinámicamente -->
        </div>

        <button class="btn btn-success mt-3" onclick="guardarNotas()">Guardar Notas</button>
    </div>
</div>


<script src="/assets/js/cargarEstudiantes.js"></script>
<script src="/assets/js/Docente.js"> </script>

    
</body>
</html>

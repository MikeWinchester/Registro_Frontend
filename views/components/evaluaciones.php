<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href="/assets/css/toastMessage.css">

    <title>Document</title>
</head>
<body>



<div class="card">
    <div class="card-body">
        <h4 class="card-title">📝 Subir Evaluaciones / Calificaciones</h4>
        <label for="claseSeleccionada" class="form-label">Selecciona una clase:</label>
        <select id="claseSeleccionada" class="form-select" >
            <option value="" selected disabled>Selecciona una opción</option>
            
        </select>
        <div id="loader-clases" class="text-center mt-2" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                
            </div>
        </div>

        <div id="estudiantesContainer" class="mt-4">
            <div id="loader-lista" class="text-center mt-2" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    
                </div>
            </div>
            
        </div>

        <button id="guardarNotas" class="btn btn-success mt-3" disabled>Guardar Notas</button>
    </div>
   
</div>

<div id="toast" class="toast">

</div>


<script src="/assets/js/manejadorEstudiantes.js"></script>
<script src="/assets/js/Docente.js"> </script>

    
</body>
</html>

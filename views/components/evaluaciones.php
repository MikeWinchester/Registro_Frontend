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

<script>
    function cargarEstudiantes() {
        let clase = document.getElementById("claseSeleccionada").value;
        let container = document.getElementById("estudiantesContainer");
        
        let estudiantes = {
            "1": [
                { id: 101, nombre: "Carlos Gómez" },
                { id: 102, nombre: "Ana Martínez" }
            ],
            "2": [
                { id: 201, nombre: "Pedro Ramírez" },
                { id: 202, nombre: "Sofía López" }
            ]
        };

        let html = `<h5>Lista de Estudiantes</h5><table class="table">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>`;

        if (estudiantes[clase]) {
            estudiantes[clase].forEach(est => {
                html += `<tr>
                            <td>${est.nombre}</td>
                            <td><input type="number" class="form-control" min="0" max="20" id="nota_${est.id}"></td>
                         </tr>`;
            });
        }

        html += `</tbody></table>`;
        container.innerHTML = html;
    }

    function guardarNotas() {
        alert("Notas guardadas correctamente.");
    }
</script>

<script src="/assets/js/Docente.js"> </script>

    
</body>
</html>
async function cargarEstudiantes() {
    let clase = document.getElementById("claseSeleccionada").value;
    let container = document.getElementById("estudiantesContainer");

    if (!clase) return; 

    try {
        let response = await fetch(`http://localhost:3806/matricula/estudiantes/${clase}`);
        let result = await response.json(); 

        if (!result.data || result.data.length === 0) {
            container.innerHTML = `<p class="text-warning">No hay estudiantes en esta clase.</p>`;
            return;
        }

        let html = `<h5>Lista de Estudiantes</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Número de Cuenta</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>`;

        result.data.forEach(est => {
            html += `<tr>
                        <td>${est.NombreCompleto}</td>
                        <td>${est.NumeroCuenta}</td>
                        <td><input type="number" class="form-control" min="0" max="20" id="nota_${est.EstudianteID}"></td>
                     </tr>`;
        });

        html += `</tbody></table>`;
        container.innerHTML = html;
    } catch (error) {
        console.error("Error al obtener estudiantes:", error);
        container.innerHTML = `<p class="text-danger">Error al cargar estudiantes.</p>`;
    }
}

// Asegurar que el evento `onchange` se asigne correctamente
document.addEventListener("DOMContentLoaded", function() {
    let select = document.getElementById("claseSeleccionada");
    if (select) {
        select.addEventListener("change", cargarEstudiantes);
    }
});

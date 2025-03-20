async function cargarEstudiantes() {
    let clase = document.getElementById("claseSeleccionada").value;
    let container = document.getElementById("estudiantesContainer");

    if (!clase) return; 

    try {
        let response = await fetch(`${env.API_URL}/matricula/estudiantes/${clase}`);
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
                        <td><input id='${est.EstudianteID}' type="number" class="form-control notas" min="0" max="20" id="nota_${est.EstudianteID}"></td>
                     </tr>`;
        });

        html += `</tbody></table>`;
        container.innerHTML = html;
    } catch (error) {
        console.error("Error al obtener estudiantes:", error);
        container.innerHTML = `<p class="text-danger">Error al cargar estudiantes.</p>`;
    }
}

async function guardarNotas(){
    const notas = document.querySelectorAll('.notas');

    let clase = document.getElementById("claseSeleccionada").value;
    let est = {};
    let num = 0;

    notas.forEach(nota => {
        num += 1;
        if(nota.value){
           est[`Estudiante${num}`] = {'EstudianteId' : nota.id , 'SeccionId' : clase, 'Nota': nota.value};
        }
    });

    console.log(JSON.stringify(est));
    try {
        let response = await fetch("http://localhost:3806/notas/asignar", {
            method: "POST", 
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(est)
        });

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        
        console.log("Notas guardadas correctamente");

    } catch (error) {
        console.error("Error al enviar notas:", error);
    }  
}



document.addEventListener("DOMContentLoaded", function() {
    let select = document.getElementById("claseSeleccionada");
    const btnNotas = document.querySelector("#guardarNotas");

    if (select) {
        select.addEventListener("change", cargarEstudiantes);
    }

    if (btnNotas) {
        btnNotas.addEventListener("click", guardarNotas);
    }
});



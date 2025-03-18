document.addEventListener("DOMContentLoaded", function () {

    setTimeout(() => {
        const clasesAsignadasCard = document.querySelector(".clases");

        
        clasesAsignadasCard.addEventListener("click", function (event) {
            event.preventDefault();

            cargarClases();
        });
        
    }, 500);
});

async function cargarClases() {
    
    try {
        //Cambiar la url para conectar con el backend (.ENV.APIURL {$idDocente})
        const response = await fetch("http://localhost:3806/secciones/docente/1");

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();
        

        const mainContent = document.querySelector("#main-content");
        if (!mainContent) {
            return;
        }

        let tablaHTML = `
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
        `;

        if (jsonResponse.data && jsonResponse.data.length > 0) {
            jsonResponse.data.forEach((clase, index) => {
                tablaHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${clase.Asignatura}</td>
                        <td>${clase.Aula}</td>
                        <td>${clase.CupoMaximo}</td>
                        <td>${clase.Horario}</td>
                        <td><a href="lista_estudiantes.php?clase=${encodeURIComponent(clase.Asignatura)}" class="btn btn-info btn-sm">Ver lista de estudiantes</a></td>
                    </tr>
                `;
            });
        } else {
            tablaHTML += `<tr><td colspan='5' class='text-center'>No se encontraron secciones.</td></tr>`;
        }

        tablaHTML += `</tbody></table>`;

        mainContent.innerHTML = tablaHTML;

    } catch (error) {
        console.error("Error al obtener las secciones:", error);
    }
}

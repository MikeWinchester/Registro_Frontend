document.addEventListener("DOMContentLoaded", function () {

    setTimeout(() => {
        const clasesAsignadasCard = document.querySelector("#clases");
        const perfilCard = document.querySelector("#perfil");
        const listCard = document.querySelector("#evaluacion");

        
        clasesAsignadasCard.addEventListener("click", function (event) {
            event.preventDefault();

            cargarClases();
        });
        perfilCard.addEventListener("click", function (event) {
            event.preventDefault();
            cargarPerfil();
        });
        listCard.addEventListener("click", function(event){
            event.preventDefault();
            listarClases();
        })
        
    }, 500);
});

async function cargarClases() {
    try {
        const response = await fetch("http://localhost:3806/secciones/docente/1");
        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();
        const data = jsonResponse.data;
        const container = document.querySelector("#clasesAccordion");

        if (!container) return;

        if (!data || data.length === 0) {
            container.innerHTML = `<p class="text-warning text-center">No hay clases asignadas.</p>`;
            return;
        }

        // Agrupar las clases por Periodo
        let periodos = {};
        data.forEach(clase => {
            if (!periodos[clase.PeriodoAcademico]) {
                periodos[clase.PeriodoAcademico] = [];
            }
            periodos[clase.PeriodoAcademico].push(clase);
        });

        let html = "";

        Object.keys(periodos).forEach((periodo, index) => {
            let periodoId = `periodo${index}`;
            html += `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading${periodoId}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapse${periodoId}" aria-expanded="true">
                            ${periodo}
                        </button>
                    </h2>
                    <div id="collapse${periodoId}" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="accordion" id="secciones${periodoId}">
            `;

            periodos[periodo].forEach(clase => {
                let claseId = `clase${clase.SeccionID}`;
                html += `
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading${claseId}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse${claseId}" aria-expanded="false">
                                ${clase.Asignatura} - Aula ${clase.Aula}
                            </button>
                        </h2>
                        <div id="collapse${claseId}" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Aula</th>
                                            <th>Cupos</th>
                                            <th>Horario</th>
                                            <th>Lista de Estudiantes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>${clase.Aula}</td>
                                            <td>${clase.CupoMaximo}</td>
                                            <td>${clase.Horario}</td>
                                            <td>
                                                <a href="lista_estudiantes.php?seccion=${clase.SeccionID}" 
                                                   class="btn btn-info btn-sm">
                                                    Ver Lista
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                `;
            });

            html += `
                        </div> 
                    </div> 
                </div>
            `;
        });

        container.innerHTML = html;

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}

// Cargar automáticamente cuando se inicie la página
document.addEventListener("DOMContentLoaded", cargarClases);


async function cargarPerfil() {
    try {
        // Cambiar la URL para conectar con el backend (.ENV.APIURL {$idDocente})
        const response = await fetch("http://localhost:3806/docentes/1");

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        const mainContent = document.querySelector("#main-content");
        if (!mainContent) {
            return;
        }

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            mainContent.innerHTML = `<div class="alert alert-warning text-center">No se encontró información del perfil.</div>`;
            return;
        }

        // Obtener los datos del primer perfil
        const perfil = jsonResponse.data[0];

        // Generar la tarjeta de perfil dinámicamente
        let perfilHTML = `
            <div class="card">
                <div class="card-body text-center">
                    <img src="/Registro_Frontend/assets/images/perfil.jpg" alt="Foto de perfil" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    <h4 class="card-title">${perfil.NombreCompleto}</h4>
                    <p class="card-text">📧 Correo: ${perfil.Correo}</p>
                    <p class="card-text">🔢 Número de Cuenta: ${perfil.NumeroCuenta}</p>
                    <p class="card-text">🔢 Centro: ${perfil.NombreCentro}</p>
                    <p class="card-text">🏫 Departamento: Matemáticas</p>
                    <p class="card-text">📅 Fecha de ingreso: 10/08/2015</p>
                    <button class="btn btn-primary mt-2">Editar Perfil</button>
                </div>
                <div class="card-footer">
                    <a href="#" class="text-muted">Ver más detalles</a>
                </div>
            </div>
        `;

        // Reemplazar el contenido del `#main-content`

        mainContent.innerHTML = perfilHTML;
    } catch (error) {
        console.error("Error al obtener el perfil:", error);
    }
}

async function listarClases() {
    
    try {
        //Cambiar la url para conectar con el backend (.ENV.APIURL {$idDocente})
        const response = await fetch("http://localhost:3806/secciones/docente/1");

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();
        

        const mainContent = document.querySelector("#claseSeleccionada");
        if (!mainContent) {
            return;
        }

        let listaHTML = ``;

        if (jsonResponse.data && jsonResponse.data.length > 0) {
            jsonResponse.data.forEach((clase, index) => {
                listaHTML += `
                   <option value="${clase.SeccionID}">${clase.Asignatura}</option>
                `;
            });
        } else {
            listaHTML += `<tr><td colspan='5' class='text-center'>No se encontraron secciones.</td></tr>`;
        }

        mainContent.innerHTML += listaHTML;

    } catch (error) {
        console.error("Error al obtener las secciones:", error);
    }
}
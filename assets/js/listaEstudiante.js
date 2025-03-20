import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

const Seccion = obtenerParametroURL("Id");


async function listadoEstudiantes(){
    try {
        let container = document.querySelector('#main-content');
        let response = await fetch(`${env.API_URL}/matricula/estudiantes/${Seccion}`);
        
        let result = await response.json(); 
        
        if (!result.data || result.data.length === 0) {
            
            container.innerHTML = `<p class="text-warning">No hay estudiantes en esta clase.</p>`;
            return;
        }

        let html = `<table class="student-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Numero de cuenta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody >`;

        index = 0;
        result.data.forEach(est => {
            index += 1;
            html += `<tr>
                        <td>${index}</td>
                        <td>${est.NombreCompleto}</td>
                        <td>${est.CorreoInstitucional}</td>
                        <td>${est.NumeroCuenta}</td>
                        <td><button class="btn-action">Ver Detalles</button></td>
                    </tr>
                    `;
        });

        html += `</tbody>
            </table>`;

        
        container.innerHTML = html;
    } catch (error) {
        
        console.error("Error al obtener estudiantes:", error);
        container.innerHTML = `<p class="text-danger">Error al cargar estudiantes.</p>`;
    }
}


function obtenerParametroURL(nombre) {
    const params = new URLSearchParams(window.location.search);
    return params.get(nombre);
}

document.addEventListener("DOMContentLoaded", function() {
    if (Seccion) {
        listadoEstudiantes(Seccion);
    } else {
        console.log("No se encontró el parámetro 'Id' en la URL.");
    }
});

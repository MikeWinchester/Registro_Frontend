import loadEnv from "./getEnv.mjs";
const env = await loadEnv();
const Seccion = obtenerParametroURL("Id");


async function listadoEstudiantes(Seccion){
    
    const container = document.querySelector('#main-content');        

    try {
        
        console.log(Seccion)

        let response = await fetch(`${env.API_URL}/matricula/estudiantes/seccion`,{
            method:"GET",
            headers : {
                "seccionid" : Seccion
            }
        });
        
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
                    </tr>
                </thead>
                <tbody >`;

        let index = 0;
        result.data.forEach(est => {
            index += 1;
            html += `<tr class="estudiantes"}>
                        <td>${index}</td>
                        <td class='nombre'>${est.nombre_completo}</td>
                        <td>${est.correo}</td>
                        <td class='cuenta'>${est.numero_cuenta}</td>
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


await listadoEstudiantes(Seccion);

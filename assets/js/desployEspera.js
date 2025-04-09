import loadEnv from "../../matricula/assets/js/getEnv.mjs";
import { showToast } from "../../global_components/assets/js/toastMessage.mjs";
const env = await loadEnv();

async function desployTable() {
    const estudianteid = localStorage.getItem("estudiante");
    const tableContainer = document.querySelector("#data-table");
    const loader = document.querySelector('#loader-esp')

    try {
        loader.style.display = "block";

        const response = await fetch(`${env.API_URL}/esp/estu`, {
            method: "GET",
            headers: {
                "estudianteid": estudianteid,
                "Content-Type": "application/json"
            }
        });

        const jsonResponse = await response.json();
        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            tableContainer.innerHTML = "<tr><td colspan='9'>No hay clases disponibles</td></tr>";
            return;
        }

        const fragment = document.createDocumentFragment();

        jsonResponse.data.forEach(seccion => {
            const row = document.createElement("tr");
            row.id = `seccion-${seccion.seccion_id}`;

            const [h_ini, h_fin] = seccion.horario.split("-");

            row.innerHTML = `
                <td>${seccion.codigo}</td>
                <td>${seccion.nombre}</td>
                <td>${h_ini.replace(":", "")}</td>
                <td>${h_ini}</td>
                <td>${h_fin}</td>
                <td>${seccion.dias}</td>
                <td>${seccion.edificio}</td>
                <td>${seccion.aula}</td>
                <td><button class="btn btn-info btn-eliminar" data-id="${seccion.seccion_id}">Eliminar</button></td>
            `;

            fragment.appendChild(row);
        });

        tableContainer.innerHTML = ""; 
        tableContainer.appendChild(fragment);

    } catch (error) {
        console.error(error);
    } finally {
        
        loader.style.display = "none";
        
    }
}

async function eliminarSeccion(seccionId) {
    const estudianteid = localStorage.getItem("estudiante");
    try {
        const response = await fetch(`${env.API_URL}/esp/eliminar`, {
            method: "DELETE",
            headers: { 
                "estudianteid" : estudianteid,
                "seccionid" : seccionId,
                "Content-Type": "application/json" 
            }
        });

        document.querySelector(`#seccion-${seccionId}`)?.remove();
        console.log(`Sección ${seccionId} eliminada correctamente`);
        
        if(response){
            showToast('Se ha eliminado de la lsita de espera', 'success');
        }else{
            showToast('No se ha podido eliminar de la lsita de espera', 'error');
        }

    } catch (error) {
        console.error("Error al eliminar:", error);
    }
}

export {desployTable, eliminarSeccion};
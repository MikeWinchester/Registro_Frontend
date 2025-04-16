import loadEnv from "./getEnv.mjs";

const env = await loadEnv();
const endpointgetval = `${env.API_URL}/estudiante/get/id`;

async function desployTable() {
    const estudianteid = await getVal();
    const tableContainer = document.querySelector("#data-table");
    const loader = document.querySelector('#loader-esp')

    try {
        loader.style.display = "block";

        const response = await fetch(`${env.API_URL}/esp/estu/${estudianteid}`, {
            method: "GET",
            headers: {
                
                "Content-Type": "application/json",
                "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
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
        DOMEvent()
        loader.style.display = "none";
        
    }
}

async function eliminarSeccion(seccionId) {
    const estudianteid = await getVal();

    console.log(estudianteid + " " + seccionId);

    try {
        const response = await fetch(`${env.API_URL}/esp/eliminar/sec/${seccionId}/est/${estudianteid}`, {
            method: "DELETE",
            headers: { 

                "Content-Type": "application/json",
                "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
            }
        });

        document.querySelector(`#seccion-${seccionId}`)?.remove();
        console.log(`Sección ${seccionId} eliminada correctamente`);
        
    } catch (error) {
        console.error("Error al eliminar:", error);
    }
}

function DOMEvent(){
    const btns = document.querySelectorAll('.btn-eliminar');
 
    btns.forEach(btn => {
     btn.addEventListener("click", async () => {
         const id = btn.getAttribute("data-id");
         await eliminarSeccion(id);
     });
     });

     console.log(btns);
 }

async function getVal(){
    
    const est = localStorage.getItem('estudiante');
    
    const res = await fetch(`${endpointgetval}/${est}`, {
        method: "GET",
        headers: {
            
            "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
        }
    });

    if (!res.ok) {
        throw new Error("Error al obtener el valor");
    }

    const result = await res.json();
    return result.data.id;

    
}

export {desployTable, eliminarSeccion};
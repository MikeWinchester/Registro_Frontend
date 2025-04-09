import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

async function desployTable(){
    let estudianteid = localStorage.getItem("estudiante");
    const tableContainer = document.querySelector('#data-can');
    const loader = document.querySelector('#loader-can')
    let table = ''

    loader.style.display = 'Block'
    try {
        
        const response = await fetch(`${env.API_URL}/can/estu`, {
            method : "GET",
            headers : {
                "estudianteid" : estudianteid,
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        })

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            return;
        }

        jsonResponse.data.forEach(seccion => {
            const hora = seccion.horario
            const h_ini = hora.split("-")[0];

            table +=`
                    <tr>
                        <td>${seccion.codigo}</td>
                        <td>${seccion.nombre}</td>
                        <td>${h_ini.replace(":", "")}</td>
                        <td>${hora}</td>
                        <td>${seccion.dias}</td>
                        <td>${seccion.edificio}</td>
                        <td>${seccion.aula}</td>
                    </tr>`
        });

        tableContainer.innerHTML = table;

    } catch (error) {
        console.error(error);
    } finally {
        
        loader.style.display = "none";
     
    }
}

export {desployTable};
import loadEnv from "./getEnv.mjs";
const env = await loadEnv();
const endpointgetval = `${env.API_URL}/estudiante/get/id`;

async function desployTable(){
    const estudianteid = await getVal();
    const tableContainer = document.querySelector('#data-can');
    const loader = document.querySelector('#loader-can')
    let table = ''

    loader.style.display = 'Block'
    try {
        
        const response = await fetch(`${env.API_URL}/can/estu/${estudianteid}`, {
            method : "GET",
            headers : {
                
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        })

        const jsonResponse = await response.json();

        if(jsonResponse.message){
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
        }

    } catch (error) {
        console.error(error);
    } finally {
        
        loader.style.display = "none";
     
    }
}

async function getVal(){
    
    const est = localStorage.getItem('estudiante');
    
    const res = await fetch(`${endpointgetval}/${est}`, {
        method: "GET",
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });

    if (!res.ok) {
        throw new Error("Error al obtener el valor");
    }

    const result = await res.json();
    return result.data.id;

    
}

export {desployTable};
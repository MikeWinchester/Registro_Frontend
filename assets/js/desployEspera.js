estudianteid = localStorage.getItem("estudiante");

document.addEventListener("DOMContentLoaded", function(){

desployTable();
})

async function desployTable(){
    const tableContainer = document.querySelector('#data-table');
    table = ''
    try {
        console.log(estudianteid)
        const response = await fetch("http://localhost:3806/esp/estu", {
            method : "GET",
            headers : {
                "estudianteid" : estudianteid,
                "Content-Type": "application/json"
            }
        })

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        jsonResponse.data.forEach(seccion => {
            const hora = seccion.horario
            const h_ini = hora.split("-")[0];
            const h_fin = hora.split("-")[1];

            table +=`
                    <tr id='${seccion.seccion_id}'>
                        <td>${seccion.codigo}</td>
                        <td>${seccion.nombre}</td>
                        <td>${h_ini.replace(":", "")}</td>
                        <td>${h_ini}</td>
                        <td>${h_fin}</td>
                        <td>${seccion.dias}</td>
                        <td>${seccion.edificio}</td>
                        <td>${seccion.aula}</td>
                        <td><button class="btn btn-info" id='btn-${seccion.seccion_id}'>Detalles</button></td>
                    </tr>`
        });

        tableContainer.innerHTML = table;

    } catch (error) {
        console.error(error);
    }
}
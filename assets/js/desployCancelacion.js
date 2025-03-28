estudianteid = localStorage.getItem("estudiante");

document.addEventListener("DOMContentLoaded", function(){

desployTable();
})

async function desployTable(){
    const tableContainer = document.querySelector('#data-can');
    table = ''
    try {
        console.log(estudianteid)
        const response = await fetch("http://localhost:3806/can/estu", {
            method : "GET",
            headers : {
                "estudianteid" : estudianteid,
                "Content-Type": "application/json"
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
    }
}
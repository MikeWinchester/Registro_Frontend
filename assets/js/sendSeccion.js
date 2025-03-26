async function crearSeccion(){
    let clase = document.querySelector("#optionClass select").value;
    let docente = document.querySelector("#optionDoc select").value;
    let centro = document.querySelector("#optionCentro select").value;
    let aula = document.querySelector('#optionAula select').value

    let diasSeleccionados = [];
    document.querySelectorAll(".form-check-input:checked").forEach(checkbox => {
        diasSeleccionados.push(checkbox.nextElementSibling.textContent.trim());
    });

    dias = diasSeleccionados.map(dia => dia.substring(0, 3)).join(", ");

    let horaInicio = document.querySelector("#h_ini").value;
    let horaFin = document.querySelector("#h_final").value;

    
    let cupos = document.querySelector("#cupos").value;

    seccion = {"docente_id" : docente, "aula_id" : aula, "horario" : `${horaInicio}-${horaFin}`, "cupo_maximo" : cupos, "clase_id" : clase, "dias" : dias, "periodo_academico" : '2025-I'};

    console.log(seccion)
    try {
        let response = await fetch("http://localhost:3806/secciones/create", {
            method: "POST", 
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(seccion)
        });

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        
        console.log("Seccion guardada correctamente");

    } catch (error) {
        console.error("Error al enviar Seccion:", error);
    }  
}

async function aulas(val){
    const aulaContainer = document.querySelector('#optionAula')
    centroid = event.target.value;
    console.log(centroid)

    if (!aulaContainer) {
        console.error("Error: No se encontró #optionClass en el DOM");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/aula/get", {
            method: "GET",
            headers: {
                "centroid": centroid,
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay aulas disponibles");
            return;
        }

        aulaContainer.innerHTML = ""; 

        let label = document.createElement("label");
        label.className = "form-label";
        label.textContent = 'Aula';

        let select = document.createElement("select");
        select.className = "form-select";
        select.id = "optionAula";

        let defaultOption = document.createElement("option");
        defaultOption.textContent = "Seleccione una Aula";
        defaultOption.value = "";
        select.appendChild(defaultOption);
    

        jsonResponse.data.forEach(aula => {
            let option = document.createElement("option");
            option.value = aula.aula_id;
            option.textContent = `${aula.aula}`;
            select.appendChild(option);
        });

        aulaContainer.appendChild(label);
        aulaContainer.appendChild(select);

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}

document.addEventListener("DOMContentLoaded", function(){
    const btnCreate = document.querySelector('#create');
    const selectCentro = document.querySelector('#optionClass')

    if(btnCreate|| selectCentro){

        btnCreate.addEventListener("click", crearSeccion())
        selectCentro.addEventListener("change", aulas)
    }
})


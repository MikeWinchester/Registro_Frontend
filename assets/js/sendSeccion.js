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

    seccion = {"DocenteID" : docente, "Aula" : aula, "Horario" : `${horaInicio}-${horaFin}`, "CupoMaximo" : cupos, "ClaseID" : clase, "Dias" : dias, "PeriodoAcademico" : '2025-II'};

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

document.addEventListener("DOMContentLoaded", function(){
    const btnCreate = document.querySelector('#create');

    if(btnCreate){

        btnCreate.addEventListener("click", crearSeccion())
    }
})


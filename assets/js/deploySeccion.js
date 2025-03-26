jefeID = localStorage.getItem('jefeID');

async function deploySeccion() {
    
    const clasesContainer = document.querySelector('#optionClass');
    const docentesContainer = document.querySelector('#optionDoc');
    const centroContainer = document.querySelector('#optionCentro');
    const carreraid = await getCarreraID();

    clases(clasesContainer, carreraid);
    docentes(docentesContainer, carreraid);
    centroRegional(centroContainer);
}

async function clases(clasesContainer, carreraid){
    if (!clasesContainer) {
        console.error("Error: No se encontró #optionClass en el DOM");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/clases", {
            method: "GET",
            headers: {
                "carreraid": carreraid,
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        clasesContainer.innerHTML = ""; 

        let label = document.createElement("label");
        label.className = "form-label";
        label.textContent = "Clase"

        let select = document.createElement("select");
        select.className = "form-select";
        select.id = "optionClass";

        let defaultOption = document.createElement("option");
        defaultOption.textContent = "Seleccione una clase";
        defaultOption.value = "";
        select.appendChild(defaultOption);

        jsonResponse.data.forEach(clase => {
            let option = document.createElement("option");
            option.value = clase.clase_id;
            option.textContent = `${clase.nombre} - Código: ${clase.codigo}`;
            select.appendChild(option);
        });

        clasesContainer.appendChild(label);
        clasesContainer.appendChild(select);

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}

async function docentes(docentesContainer, carreraid){
    if (!docentesContainer) {
        console.error("Error: No se encontró #optionClass en el DOM");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/docentes/dep", {
            method: "GET",
            headers: {
                "carreraid": carreraid,
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        docentesContainer.innerHTML = ""; 

        let label = document.createElement("label");
        label.className = "form-label";
        label.textContent = 'Docente';

        let select = document.createElement("select");
        select.className = "form-select";
        select.id = "optionClass";

        let defaultOption = document.createElement("option");
        defaultOption.textContent = "Seleccione un docente";
        defaultOption.value = "";
        select.appendChild(defaultOption);
    

        jsonResponse.data.forEach(docente => {
            let option = document.createElement("option");
            option.value = docente.docente_id;
            option.textContent = `${docente.nombre_completo}`;
            select.appendChild(option);
        });

        docentesContainer.appendChild(label);
        docentesContainer.appendChild(select);

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}

async function centroRegional(centroContainer){
    if (!centroContainer) {
        console.error("Error: No se encontró #optionClass en el DOM");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/centros", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay centros disponibles");
            return;
        }

        centroContainer.innerHTML = ""; 

        let label = document.createElement("label");
        label.className = "form-label";
        label.textContent = 'Centro Universitario';

        let select = document.createElement("select");
        select.className = "form-select";
        select.id = "optionClass";
        select.onchange = aulas;

        let defaultOption = document.createElement("option");
        defaultOption.textContent = "Seleccione un Centro Universitario";
        defaultOption.value = "";
        select.appendChild(defaultOption);
    

        jsonResponse.data.forEach(clase => {
            let option = document.createElement("option");
            option.value = clase.centro_regional_id;
            option.textContent = `${clase.nombre_centro}`;
            select.appendChild(option);
        });

        centroContainer.appendChild(label);
        centroContainer.appendChild(select);

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}


async function getCarreraID(){
    try {
        const response = await fetch("http://localhost:3806/jefe/getDep", {
            method: "GET",
            headers: {
                "jefeid": jefeID,
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay aulas disponibles");
            return;
        }

        carreraid = jsonResponse.data
        
        return carreraid[0].carreraid

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}
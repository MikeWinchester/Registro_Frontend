jefeID = localStorage.getItem('jefeID');

async function deploySeccion() {
    
    const clasesContainer = document.querySelector('#optionClass');
    const docentesContainer = document.querySelector('#optionDoc');
    const centroContainer = document.querySelector('#optionCentro');

    clases(clasesContainer);
    docentes(docentesContainer);
    centroRegional(centroContainer);

}

async function clases(clasesContainer){
    if (!clasesContainer) {
        console.error("Error: No se encontró #optionClass en el DOM");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/clases", {
            method: "GET",
            headers: {
                "departamentoid": jefeID,
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
            option.value = clase.ClaseID;
            option.textContent = `${clase.Nombre} - Código: ${clase.Codigo}`;
            select.appendChild(option);
        });

        clasesContainer.appendChild(label);
        clasesContainer.appendChild(select);

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}

async function docentes(docentesContainer){
    if (!docentesContainer) {
        console.error("Error: No se encontró #optionClass en el DOM");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/docentes/dep", {
            method: "GET",
            headers: {
                "departamentoid": jefeID,
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
    

        jsonResponse.data.forEach(clase => {
            let option = document.createElement("option");
            option.value = clase.DocenteID;
            option.textContent = `${clase.NombreCompleto}`;
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
                "departamentoid": jefeID,
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

        let defaultOption = document.createElement("option");
        defaultOption.textContent = "Seleccione un Centro Universitario";
        defaultOption.value = "";
        select.appendChild(defaultOption);
    

        jsonResponse.data.forEach(clase => {
            let option = document.createElement("option");
            option.value = clase.CentroRegionalID;
            option.textContent = `${clase.NombreCentro}`;
            select.appendChild(option);
        });

        centroContainer.appendChild(label);
        centroContainer.appendChild(select);

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}
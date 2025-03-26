document.addEventListener("DOMContentLoaded", async function () {
    await desployContent(); 
    
    const selectArea = document.querySelector('#area');
    const selectAsig = document.querySelector('#asignatura');

    selectArea.addEventListener('change', desployClases);
    selectAsig.addEventListener('change', desploySeccion);
});

async function desployContent() {
    const select = document.querySelector("#area");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/carreras", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay carreras disponibles");
            return;
        }

        // Limpiar select y añadir opción por defecto
        select.innerHTML = `<option disabled selected>Seleccione un área de estudio</option>`;

        jsonResponse.data.forEach(carrera => {
            let option = document.createElement("option");
            option.value = carrera.carrera_id;
            option.textContent = carrera.nombre_carrera;
            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
    }
}


async function desployClases() {
    
    carreraid = event.target.value
    const select = document.querySelector("#asignatura");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/clases", {
            method: "GET",
            headers: {
                "carreraid" : carreraid,
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        select.innerHTML = `<option disabled selected>Seleccione una asignatura</option>`;

        jsonResponse.data.forEach(clase => {
            let option = document.createElement("option");
            option.value = clase.clase_id;
            option.textContent = clase.nombre;
            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
    }
}

async function desploySeccion() {
    
    claseid = event.target.value
    const select = document.querySelector("#seccion");

    if (!select) {
        console.log("Contenedor de área desconocido");
        return;
    }

    try {
        const response = await fetch("http://localhost:3806/secciones/get/clase", {
            method: "GET",
            headers: {
                "claseid" : claseid,
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay clases disponibles");
            return;
        }

        select.innerHTML = `<option disabled selected>Seleccione una seccion</option>`;

        jsonResponse.data.forEach(seccion => {
            let option = document.createElement("option");
            option.value = seccion.seccion_id;
            option.textContent = `${seccion.nombre_completo} ${seccion.horario} ${seccion.cupo_maximo}`;
            select.appendChild(option);
        });

    } catch (error) {
        console.log(error);
    }
}

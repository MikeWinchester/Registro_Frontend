import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

const endpointhorario = `${env.API_URL}/secciones/horario`

async function fetchData(url, headers = {}) {

    try {
        const response = await fetch(url, { method: "GET", headers });
        if (!response.ok) throw new Error("Error en la API");
        const jsonResponse = await response.json();
        return jsonResponse.data || [];
    } catch (error) {
        console.error("Error en la solicitud:", error);
        return [];
    }
}


function createDropdown(container, labelText, selectId, optionsData, valueKey, textKey, defaultText) {
    if (!container) {
        console.error("Error: Contenedor no encontrado");
        return;
    }
    container.innerHTML = "";

    const label = document.createElement("label");
    label.className = "form-label";
    label.textContent = labelText;

    const select = document.createElement("select");
    select.className = "form-select";
    select.id = selectId;

    const loadingOption = document.createElement("option");
    loadingOption.textContent = "Cargando...";
    loadingOption.disabled = true;
    loadingOption.selected = true;
    select.appendChild(loadingOption);

    container.appendChild(label);
    container.appendChild(select);

    
    setTimeout(() => {
        select.innerHTML = ""; 
        const defaultOption = document.createElement("option");
        defaultOption.textContent = defaultText;
        defaultOption.value = "";
        select.appendChild(defaultOption);

        optionsData.forEach(item => {
            const option = document.createElement("option");
            option.value = item[valueKey];
            option.textContent = typeof textKey === "function" ? textKey(item) : item[textKey];
            select.appendChild(option);
        });
    }, 200); 
}



async function clases(clasesContainer, carreraid) {
    const data = await fetchData(`${env.API_URL}/clases`, { "areaid": carreraid, "Content-Type": "application/json" });
    createDropdown(clasesContainer, "Clase", "optionClass", data, "clase_id", item => `${item.nombre} - Código: ${item.codigo}`, "Seleccione una clase");
}

async function docentes(docentesContainer, carreraid) {
    const data = await fetchData(`${env.API_URL}/docentes/dep`, { "areaid": carreraid, "Content-Type": "application/json" });
    createDropdown(docentesContainer, "Docente", "optionDocente", data, "docente_id", "nombre_completo", "Seleccione un docente");
    const docentesSelect = document.querySelector('#optionDocente')
    docentesSelect.addEventListener('change', () => {
        activarHora();
    });
}

async function centroRegional(centroContainer) {
    const data = await fetchData(`${env.API_URL}/centros`, { "Content-Type": "application/json" });
    createDropdown(centroContainer, "Centro Universitario", "selectCentro", data, "centro_regional_id", "nombre_centro", "Seleccione un Centro Universitario");
}

async function aulas(centroid, facId) {
    
    const aulaContainer = document.querySelector('#optionAula');
    if (!aulaContainer) return;
    const data = await fetchData(`${env.API_URL}/aula/get`, { "centroid": centroid, "facultadid" : facId, "Content-Type": "application/json" });
    createDropdown(aulaContainer, "Aula", "optionAula", data, "aula_id", "aula", "Seleccione un aula");
}

async function getCarreraID(jefeID) {
    const data = await fetchData(`${env.API_URL}/jefe/getDep`, { "jefeid": jefeID, "Content-Type": "application/json" });
    
    return data.length > 0 ? data[0].departamentoid : null;
}

async function getFacId(jefeID){
    const data = await fetchData(`${env.API_URL}/jefe/getFac`, { "jefeid": jefeID, "Content-Type": "application/json" });
    
    return data.length > 0 ? data[0].facultadid : null;
}

async function getHorario(selectDias) {
    const docenteid = document.querySelector("#optionDoc select").value;
    console.log(selectDias);
    const data = await fetchData(endpointhorario, {
        'dias': selectDias,
        'docenteid': docenteid,
        'Content-Type': 'application/json'
    });

    const select_inicio = document.querySelector('#hora_ini');
    const select_final = document.querySelector('#hora_fin');

    select_inicio.innerHTML = `<option value="" disabled selected>Hora Inicio</option>`;
    select_final.innerHTML = `<option value="" disabled selected>Hora Final</option>`;

    console.log(data);

    if (data.hora_inicio && Array.isArray(data.hora_inicio)) {
        data.hora_inicio.forEach(hora => {
            const option = document.createElement('option');
            option.value = hora;
            option.textContent = hora;
            select_inicio.appendChild(option);
        });
    }

    if (data.hora_final && Array.isArray(data.hora_final)) {
        data.hora_final.forEach(hora => {
            const option = document.createElement('option');
            option.value = hora;
            option.textContent = hora;
            select_final.appendChild(option);
        });
    }
}

function activarHora(){
    const select_inicio = document.querySelector('#hora_ini');
    const select_final = document.querySelector('#hora_fin');

    select_inicio.disabled = false;
    select_final.disabled = false;
}

export { clases, docentes, centroRegional, getCarreraID, aulas, getFacId, getHorario};
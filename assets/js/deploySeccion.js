import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

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

    container.appendChild(label);
    container.appendChild(select);
}


async function clases(clasesContainer, carreraid) {
    const data = await fetchData(`${env.API_URL}/clases`, { "carreraid": carreraid, "Content-Type": "application/json" });
    createDropdown(clasesContainer, "Clase", "optionClass", data, "clase_id", item => `${item.nombre} - Código: ${item.codigo}`, "Seleccione una clase");
}

async function docentes(docentesContainer, carreraid) {
    const data = await fetchData(`${env.API_URL}/docentes/dep`, { "carreraid": carreraid, "Content-Type": "application/json" });
    createDropdown(docentesContainer, "Docente", "optionDocente", data, "docente_id", "nombre_completo", "Seleccione un docente");
}

async function centroRegional(centroContainer) {
    const data = await fetchData(`${env.API_URL}/centros`, { "Content-Type": "application/json" });
    createDropdown(centroContainer, "Centro Universitario", "selectCentro", data, "centro_regional_id", "nombre_centro", "Seleccione un Centro Universitario");
}

async function aulas(centroid) {
    const aulaContainer = document.querySelector('#optionAula');
    if (!aulaContainer) return;
    const data = await fetchData(`${env.API_URL}/aula/get`, { "centroid": centroid, "Content-Type": "application/json" });
    createDropdown(aulaContainer, "Aula", "optionAula", data, "aula_id", "aula", "Seleccione un aula");
}

async function getCarreraID() {
    const jefeID = localStorage.getItem('jefeID');
    const data = await fetchData(`${env.API_URL}/jefe/getDep`, { "jefeid": jefeID, "Content-Type": "application/json" });
    return data.length > 0 ? data[0].carreraid : null;
}

export { clases, docentes, centroRegional, getCarreraID, aulas };
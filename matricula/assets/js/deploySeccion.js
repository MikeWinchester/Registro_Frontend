import loadEnv from "../../../assets/js/getEnv.mjs";
const env = await loadEnv();

const endpointhorario = `${env.API_URL}/secciones/horario`
const endpointgetval = `${env.API_URL}/jefe/get/id`;

const htmlElement = document.documentElement;
const userId = htmlElement.getAttribute('user-id');


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
    select.disabled = true;

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
    console.log('param' + [carreraid])
    const data = await fetchData(`${env.API_URL}/clases/${carreraid}`, {"Content-Type": "application/json" , 'Authorization': `Bearer ${localStorage.getItem('authToken')}`});
    createDropdown(clasesContainer, "Clase", "optionClass", data, "clase_id", item => `${item.nombre} - Código: ${item.codigo}`, "Seleccione una clase");
}

async function docentes(docentesContainer, carreraid, jefeID) {
    console.log('param' + [carreraid, jefeID] );
    const data = await fetchData(`${env.API_URL}/docentes/dep/${carreraid}/jefe/${jefeID}`, {"Content-Type": "application/json", 'Authorization': `Bearer ${localStorage.getItem('authToken')}` });
    createDropdown(docentesContainer, "Docente", "optionDocente", data, "docente_id", "nombre_completo", "Seleccione un docente");
}

async function edificios(centroContainer, jefeID) {
    const data = await fetchData(`${env.API_URL}/edificio/jefe/${jefeID}`, { "jefeid" : jefeID, "Content-Type": "application/json", 'Authorization': `Bearer ${localStorage.getItem('authToken')}` });
    console.log("edi" + data);
    createDropdown(centroContainer, "Edificio", "selectEdi", data, "edificio_id", "edificio", "Seleccione un edificio");
}

async function aulas(edificioid) {
    
    const aulaContainer = document.querySelector('#optionAula');
    if (!aulaContainer) return;
    const data = await fetchData(`${env.API_URL}/aula/get/${edificioid}`, { "Content-Type": "application/json", 'Authorization': `Bearer ${localStorage.getItem('authToken')}`});
    createDropdown(aulaContainer, "Aula", "optionAula", data, "aula_id", "aula", "Seleccione un aula");

    asignarAula();
}

async function getCarreraID(jefeID) {
    const data = await fetchData(`${env.API_URL}/jefe/getDep/${jefeID}`, { "Content-Type": "application/json", 'Authorization': `Bearer ${localStorage.getItem('authToken')}`});
    return data.departamentoid;
}

async function getFacId(jefeID){
    const data = await fetchData(`${env.API_URL}/jefe/getFac/${jefeID}`, { "Content-Type": "application/json", 'Authorization': `Bearer ${localStorage.getItem('authToken')}`});
    
    return data.length > 0 ? data[0].facultadid : null;
}

async function getHorario(selectDias) {
    const docenteid = document.querySelector("#optionDoc select").value;
    const aulaid = document.querySelector('#optionAula select').value;

    const data = await fetchData(`${endpointhorario}/dia/${selectDias}/aula/${aulaid}/doc/${docenteid}`, {
        
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('authToken')}`
    });

    const select_inicio = document.querySelector('#hora_ini');
    const select_final = document.querySelector('#hora_fin');

    select_inicio.innerHTML = `<option value="" disabled selected>Hora Inicio</option>`;
    select_final.innerHTML = `<option value="" disabled selected>Hora Final</option>`;

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

function crearSeccionDOM(){
    const docentesSelect = document.querySelector('#optionDoc select')
    const claseSelect = document.querySelector('#optionClass select');
    const selectEdi = document.querySelector('#selectEdi');
    const btnCrear = document.querySelector('#btnCrear');
    const inputCupo = document.querySelector('#cupos');
    
    claseSelect.disabled = false;

    claseSelect.addEventListener('change', () => {
        docentesSelect.disabled = false;
    })
    docentesSelect.addEventListener('change', () => {
        selectEdi.disabled = false;
    });
    inputCupo.addEventListener('change', () => {
        btnCrear.disabled=false;
    })
}

function asignarAula(){
    const selectAula = document.querySelector('#optionAula select');
    const select_inicio = document.querySelector('#hora_ini');

    selectAula.addEventListener('change', () => {
        select_inicio.disabled = false;
    })
    select_inicio.addEventListener('change', ()=> {
        activarHora(select_inicio.value);
    })
}

function activarHora(hora_inicio) {
    const select_final = document.querySelector('#hora_fin');
    const options = select_final.querySelectorAll('option');
    const input = document.querySelector('#cupos');

    select_final.disabled = false;

    options.forEach(option => {
        
        option.hidden = false;

        if (option.value === hora_inicio) {
            option.hidden = true;
        }
    });

    select_final.addEventListener('change', () =>{
        input.disabled = false;
    })
}

async function getVal(){
    
    const est = userId;
    
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

export { clases, docentes, edificios, getCarreraID, aulas, getFacId, getHorario, crearSeccionDOM, getVal};
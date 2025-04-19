import loadEnv from "../../../../assets/js/getEnv.mjs";
const env = await loadEnv(); 

const endpointdocente = `${env.API_URL}/docentes/dep`;
const endpointclase = `${env.API_URL}/clases`;
const endpointdep = `${env.API_URL}/jefe/getDep`;
const endpointperiodo = `${env.API_URL}/secciones/periodo`;
const endpointsearch = `${env.API_URL}/evaluaciones`;
const endpointgetval = `${env.API_URL}/jefe/get/id`;

async function desploySelectEva(){
    
    const val = await getVal();
    const selectDoc = document.querySelector('#docente');
    const selectAsig = document.querySelector('#asignatura');
    const selectPeriodo = document.querySelector('#periodo');
    const loader = document.querySelector('#loader-eva');
    const depid = await getDepID(val);

    try {
        
        if(!selectAsig || !selectDoc || !selectPeriodo){
            return;
        }

        loader.style.display = 'Block';
        selectAsig.disabled = true;
        selectDoc.disabled = true;
        selectPeriodo.disabled = true;

        await fetch(`${endpointdocente}/${depid}/jefe/${val}`, {
            method: "GET",
            headers : {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        }).then(response => response.json())
        .then(result => {
            console.log(result)
            result['data'].forEach(docente => {
                const option = document.createElement('option');
                option.value = docente.docente_id
                option.innerHTML = docente.nombre_completo
                selectDoc.appendChild(option);
            });

        });

        await fetch(`${endpointclase}/${depid}`, {
            method: "GET",
            headers : {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        }).then(response => response.json())
        .then(result => {
            
            result['data'].forEach(clase => {
                const option = document.createElement('option');
                option.value = clase.clase_id
                option.innerHTML = clase.nombre
                selectAsig.appendChild(option);
            });
        });

        await fetch(endpointperiodo, {
            method: "GET",
            headers : {
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        }).then(response => response.json())
        .then(result => {

            result['data'].forEach(periodo => {
                const option = document.createElement('option');
                option.value = periodo.periodo_academico
                option.innerHTML = periodo.periodo_academico
                selectPeriodo.appendChild(option);
            });
        })

    } catch (error) {
        console.log(error);
    } finally{
        loader.style.display = 'none';
        selectAsig.disabled = false;
        selectDoc.disabled = false;
        selectPeriodo.disabled = false;
    }
}

async function searchValuesEva(){
    const selectDoc = document.querySelector('#docente');
    const selectAsig = document.querySelector('#asignatura');
    const selectPeriodo = document.querySelector('#periodo');
    const body = document.querySelector('#body-table');
    const loader = document.querySelector('#loader-table');
    let endpointcreado = `${endpointsearch}`;

    
    loader.style.display = 'block';
    selectAsig.disabled = true;
    selectDoc.disabled = true;
    selectPeriodo.disabled = true;

    if(selectDoc.value !== ""){
        endpointcreado += `/doc/${selectDoc.value}`;
    }

    if(selectAsig.value !== ""){
        endpointcreado += `/clase/${selectAsig.value}`;
    }

    if(selectPeriodo.value !== ""){
        endpointcreado += `/periodo/${selectPeriodo.value}`;
    }

    console.log
    await fetch(endpointcreado, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        },
    })
    .then(response => response.json())
    .then(result => {
        
        body.innerHTML = '';
        let data = '';
        if(result.message){
            result['data'].forEach(datos => {
                data += `<tr>
                            <td>${datos.clase}</td>
                            <td>${datos.docente}</td>
                            <td>${datos.estudiante}</td>
                            <td>${datos.numero_cuenta}</td>
                            <td>${datos.calificacion}</td>
                            <td>${datos.comentario}</td>
                            <td>${datos.periodo_academico}</td>
                        </tr>`;
            });
            body.innerHTML = data;
        }
    })
    .catch(error => {
        console.error("Error al buscar datos:", error);
        body.innerHTML = '<tr><td colspan="6">Evaluaciones no disponibles.</td></tr>';
    })
    .finally(() => {
        loader.style.display = 'none';
        selectAsig.disabled = false;
        selectDoc.disabled = false;
        selectPeriodo.disabled = false;
        vaciarSelect();
    });
}


async function evaDOM(){
    const btn = document.querySelector('#search');

    btn.addEventListener('click', async () => {
        searchValuesEva()
    });
}

async function getDepID(val){
    
    try {
        const response = await fetch(`${endpointdep}/${val}`, {
            method: "GET",
            headers: {
                
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        });

        const jsonResponse = await response.json();

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            console.log("No hay aulas disponibles");
            return;
        }

        const departamentoid = jsonResponse.data

        
        return departamentoid.departamentoid

    } catch (error) {
        console.error("Error al obtener las clases:", error);
    }
}

async function vaciarSelect() {
    const selects = document.querySelectorAll('select');

    selects.forEach(select => {
        
        while (select.options.length > 1) {
            select.remove(1);
        }

        select.selectedIndex = 0;
    });
    await desploySelectEva()
}

async function getVal(){
    
    const est = localStorage.getItem('jefe');
    
    
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


export {desploySelectEva, evaDOM};
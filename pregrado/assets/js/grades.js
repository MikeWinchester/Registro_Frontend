import loadEnv from "../../../../assets/js/getEnv.mjs";
import { showToast } from "../../../assets/js/toastMessage.mjs";
import { abrirModalEva } from "./modal.mjs";
const env = await loadEnv();

const endpointgetval = `${env.API_URL}/estudiante/get/id`;
const endpointnotas = `${env.API_URL}/notas/get`;
const endpointeva = `${env.API_URL}/notas/eva`;
const endpointhist = `${env.API_URL}/estudiante/get/hist/id`;

const est = await getVal();

const loader_notas = document.querySelector('#loader-area-nota');
const loader_histo = document.querySelector('#loader-area-historial');
loader_notas.style.display = 'Block';

async function notas() {
    const div = document.querySelector('#table-notas');

   try {
    await fetch(`${endpointnotas}/${est}`, {
        method: "GET",
        headers : {
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {
        div.innerHTML = '';
        
        if(result.message){
            result.data.forEach(seccion => {
                const estado = seccion.calificacion === null
                    ? `<span class="badge bg-warning">En curso</span>`
                    : `<span class="badge bg-success">Acabado</span>`;
    
                const nota = `<tr>
                                <td>${seccion.clase}</td>
                                <td>${seccion.docente}</td>
                                <td>${seccion.calificacion !== null ? seccion.calificacion : '-'}</td>
                                <td>${estado}</td>
                                <td>
                                    <button data-docente="${seccion.docente_id}" data-seccion="${seccion.seccion_id}" class="btn btn-sm btn-outline-primary evaluate-btn">
                                        Evaluar
                                    </button>
                                </td>
                            </tr>`;
                div.innerHTML += nota;
            });
        }
        

        const btns = document.querySelectorAll('.evaluate-btn');
        const btnactu = document.querySelector('#current-tab');
        const btnhist = document.querySelector('#history-tab');

        btns.forEach(btn => {
            btn.addEventListener('click', async() => {
                await modalDOm(btn.dataset.seccion);
            })
        });

        btnactu.addEventListener('click', async()=>{
            await notas();
        })

        btnhist.addEventListener('click', async()=>{
            await getHist();
        })
    });
   } catch (error) {
     console.log(error)
   } finally{
    loader_notas.style.display = 'none';
   }
}

async function modalDOm(sec){
    document.querySelector('#submitEvaluation').addEventListener('click', async() => {
        const clarity = parseInt(document.querySelector('input[name="clarity"]:checked')?.value || 0);
        const availability = parseInt(document.querySelector('input[name="availability"]:checked')?.value || 0);
        const fairness = parseInt(document.querySelector('input[name="fairness"]:checked')?.value || 0);
        const comentario = document.querySelector('#comments').value;
    
        if (!clarity || !availability || !fairness) {
            console.warn("Debes calificar todos los aspectos.");
            return;
        }
    
        const promedioBase10 = ((clarity + availability + fairness) / 15) * 10;

        const data = {'estudianteid' : est, 'seccionid': sec, 'calificacion' : promedioBase10.toFixed(2), 'comentario' : comentario};
    
        await fetch(endpointeva, {
            method : "POST",
            headers : {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body : JSON.stringify(data)
        }).then(response => response.json())
        .then(result => {
            if(result.error){
                showToast(result.error, 'error', 3000);
            }else{
                showToast(result.message, 'success', 3000);
            }
        })
    });

    abrirModalEva();
}

async function getHist() {
    const divhist = document.querySelector('#table-hist');
    loader_histo.style.display = 'Block';
    
    try {
        await fetch(`${endpointhist}/${est}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        })
        .then(response => response.json())
        .then(result => {
            divhist.innerHTML = '';
            
            if(result.message){
                result.data.forEach(clase => {
                    let badgeClass = '';
                    let badgeText = '';
        
                    switch (clase.observacion) {
                        case 'APR':
                            badgeClass = 'bg-success';
                            badgeText = 'Aprobada';
                            break;
                        case 'RPB':
                            badgeClass = 'bg-danger';
                            badgeText = 'Reprobada';
                            break;
                        case 'NSP':
                            badgeClass = 'bg-secondary';
                            badgeText = 'No se presentó';
                            break;
                        default:
                            badgeClass = 'bg-light text-dark';
                            badgeText = 'Sin dato';
                    }
        
                    const divCla = `<tr>
                                        <td>${clase.periodo_academico}</td>
                                        <td>${clase.nombre}</td>
                                        <td>${clase.docente}</td>
                                        <td>${clase.calificacion}</td>
                                        <td><span class="badge ${badgeClass}">${badgeText}</span></td>
                                    </tr>`;
        
                    
                    divhist.innerHTML += divCla;
                });
            }
        });
    } catch (error) {
        console.log(error);
    } finally{
        loader_histo.style.display = 'none';
    }
}

async function getVal(){
    
    const est = localStorage.getItem('estudiante');
    
    const res = await fetch(`${endpointgetval}/${est}`, {
        method: "GET",
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });
    
    const result = await res.json();

    return result.data.id;

    
}

notas();
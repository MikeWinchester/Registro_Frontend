import loadEnv from "../../../assets/js/getEnv.mjs";
import { showToast } from "../../../assets/js/toastMessage.mjs";

const env = await loadEnv();
const endpointvalidatedate = `${env.API_URL}/matricula/validate/estu`

export async function validateMatricula() {
    const estid = localStorage.getItem('estudiante');
    const res = await fetch(endpointvalidatedate, {
        method : "GET",
        headers : {
            "estudianteid" : estid,
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });

    if (!res.ok) {
        throw new Error("Fuera del horario de matrícula");
    }

    const result = await res.json();
    console.log(result);
    return result;
}





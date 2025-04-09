import loadEnv from "./getEnv.mjs";
import { showToast } from "./toastMessage.mjs";

const env = await loadEnv();
const endpointvalidatedate = `${env.API_URL}/matricula/validate/estu`

export async function validateMatricula() {
    const estid = localStorage.getItem('estudiante')
    const res = await fetch(endpointvalidatedate, {
        method : "GET",
        headers : {
            "estudianteid" : estid
        }
    });
    const result = await res.json();
    return result;
}




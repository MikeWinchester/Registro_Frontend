import loadEnv from "./getEnv.mjs";
import { showToast } from "./toastMessage.mjs";

const env = await loadEnv();
const endpointvalidatedate = `${env.API_URL}/matricula/validate/estu`

export async function validateMatricula() {
    const res = await fetch(endpointvalidatedate);
    const result = await res.json();
    return result;
}




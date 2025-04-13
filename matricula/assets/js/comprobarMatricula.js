import loadEnv from "../../../assets/js/getEnv.mjs";

const env = await loadEnv();
const endpointvalidatedate = `${env.API_URL}/matricula/validate/estu`


export async function validateMatricula(id) {
    const estid = id;
    const res = await fetch(endpointvalidatedate, {
        method : "GET",
        headers : {
            "id" : estid,
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });
    
    const result = await res.json();

    return result;
}







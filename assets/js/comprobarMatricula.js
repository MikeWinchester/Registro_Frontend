import loadEnv from "./getEnv.mjs";

const env = await loadEnv();
const endpointvalidatedate = `${env.API_URL}/matricula/validate/estu`

export async function validateMatricula() {
    const res = await fetch(endpointvalidatedate);
    const result = await res.json();

    console.log(result.message);

    if (result.error) throw new Error(result.error);
    return result;
}




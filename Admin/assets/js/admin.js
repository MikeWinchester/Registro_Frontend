import loadEnv from "../../../assets/js/getEnv.mjs";


const env = await loadEnv();
const endpoinfechamat = `${env.API_URL}/info_matricula/set`;
const endpoinfechanot = `${env.API_URL}/info_notas/set`;
const endpoinfechaadd = `${env.API_URL}/info_add_can/set`;

async function guardarFechasMat(fechaInicio, fechaFin) {
    try {
        const response = await fetch(endpoinfechamat, {
            method: 'POST',
            credentials: 'include', // Solo si usas cookies
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify({
                inicio: fechaInicio,
                final: fechaFin
            })
        });

        return await response.json();
        
    } catch (error) {
        console.error('Error:', error);
        throw error; // Propaga el error para manejarlo en el UI
    }
}

async function guardarFechasNotas(fechaInicio, fechaFin) {
    try {
        const response = await fetch(endpoinfechanot, {
            method: 'POST',
            credentials: 'include', // Solo si usas cookies
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify({
                inicio: fechaInicio,
                final: fechaFin
            })
        });


        console.log(await response);

        return await response.json();
        
    } catch (error) {
        console.error('Error:', error);
        throw error; // Propaga el error para manejarlo en el UI
    }
}

async function guardarFechasAddCan(fechaInicio, fechaFin) {
    try {
        const response = await fetch(endpoinfechaadd, {
            method: 'POST',
            credentials: 'include', // Solo si usas cookies
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify({
                inicio: fechaInicio,
                final: fechaFin
            })
        });

        console.log(response);

        return await response.json();
        
    } catch (error) {
        console.error('Error:', error);
        throw error; // Propaga el error para manejarlo en el UI
    }
}

export { guardarFechasMat, guardarFechasAddCan, guardarFechasNotas };
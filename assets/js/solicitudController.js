import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

document.getElementById('submit-btn').addEventListener('click', function() {

const numeroSolicitud = document.getElementById('numeroSolicitud').value.trim();

const obtenerEstadoSolicitud = async (id) => {
    try {

        const resultadoDiv = document.getElementById('resultado');

        const response = await fetch(`${env.API_URL}/solicitud/${id}/estado`);
        const data = await response.json();

        resultadoDiv.textContent = data.message;

        if (!response.ok) {
            resultadoDiv.textContent = data.error;
            throw new Error(data.error || "Error desconocido");
        }

    } catch (error) {
        console.error("Error al obtener el estado de la solicitud:", error);
    }
};




obtenerEstadoSolicitud(numeroSolicitud);

});
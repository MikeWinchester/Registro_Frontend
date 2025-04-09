import loadEnv from "./getEnv.mjs";

const env = await loadEnv();


async function fetchData(url, headers = {}) {
    try {
        const response = await fetch(url, { method: "GET", headers });
        if (!response.ok) throw new Error(`Error ${response.status}: ${response.statusText}`);
        return await response.json();
    } catch (error) {
        console.error("Fetch error:", error);
        return null; 
    }
}


async function forma03() {
    const est = localStorage.getItem("estudiante");
    const divPerMain = document.querySelector("#divPersonal");

    const jsonResponse = await fetchData(`${env.API_URL}/estudiante/get`, { "estudianteid": est , 'Authorization': `Bearer ${localStorage.getItem('authToken')}`});

    if (jsonResponse) {
        const { nombre_completo, nombre_carrera, nombre_centro } = jsonResponse.data;

        divPerMain.innerHTML = `
            <div class="col-md-6">
                <p><strong>Nombre:</strong> ${nombre_completo}</p>
                <p><strong>Carrera:</strong> ${nombre_carrera}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Centro Universitario:</strong> ${nombre_centro}</p>
            </div>
        `;
    }

    clasesMat(est);
}


async function clasesMat(est) {
    const tableMat = document.querySelector("#tableMain");

    const jsonResponse = await fetchData(`${env.API_URL}/matricula/get`, { "estudianteid": est , 'Authorization': `Bearer ${localStorage.getItem('authToken')}`});

    if (jsonResponse && jsonResponse.data.length > 0) {
        tableMat.innerHTML = jsonResponse.data.map(({ codigo, nombre, horario, dias, edificio, aula, UV, periodo_academico }) => {
            const [horaInicio, horaFin] = horario.split("-").map(h => h.trim());
            return `
                <tr>
                    <td>${codigo}</td>
                    <td>${nombre}</td>
                    <td>${horaInicio.replace(":", "")}</td>
                    <td>${horaInicio}</td>
                    <td>${horaFin}</td>
                    <td>${dias}</td>
                    <td>${edificio}</td>
                    <td>${aula}</td>
                    <td>${UV}</td>
                    <td>${periodo_academico.split("-")[1]}</td>
                </tr>
            `;
        }).join(""); 
    }
}

export { forma03 };

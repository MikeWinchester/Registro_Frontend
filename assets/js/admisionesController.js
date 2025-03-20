import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

async function fillSelects() {
    const careerSelect = document.getElementById("career-select");
    const careerSelectSecondary = document.getElementById("career-select-secondary");
    const centerSelect = document.getElementById("center-select");

    const endpointCareers = `${env.API_URL}/carreras`;
    const endpointCenters = `${env.API_URL}/centros`;

    try {

        const responseCareers = await fetch(endpointCareers);
        const responseCenters = await fetch(endpointCenters);
        
        if (!responseCareers.ok) {
            throw new Error(`Error en la solicitud: ${responseCareers.status}`);
        }

        if (!responseCenters.ok) {
            throw new Error(`Error en la solicitud: ${responseCenters.status}`);
        }

        const dataCareers = await responseCareers.json();
        const careers = dataCareers.data;

        const dataCenters = await responseCenters.json();
        const centers = dataCenters.data;

        careers.forEach(career => {
            careerSelect.innerHTML+=`
                <option value=${career.CarreraID} name=${career.NombreCarrera}>${career.NombreCarrera}</option>
            `;

            careerSelectSecondary.innerHTML+=`
                <option value=${career.CarreraID} name=${career.NombreCarrera}>${career.NombreCarrera}</option>
            `;
        });

        centers.forEach(center => {
            centerSelect.innerHTML+=`
                <option value=${center.CentroRegionalID} name=${center.NombreCentro}>${center.NombreCentro}</option>

            `;
        });

    } catch (error) {
        console.error("Error al poblar el select:", error);
        careerSelect.innerHTML = '<option value="">Error al cargar opciones</option>';
        careerSelectSecondary.innerHTML = '<option value="">Error al cargar opciones</option>';
    }
};

document.querySelector(".submit-btn").addEventListener("click", async () => {

    const endpointSubmitForm = `${env.API_URL}/admisiones`;

    const primerNombre = document.querySelector('input[placeholder="Primer Nombre"]').value;
    const segundoNombre = document.querySelector('input[placeholder="Segundo Nombre"]').value;
    const primerApellido = document.querySelector('input[placeholder="Primer Apellido"]').value;
    const segundoApellido = document.querySelector('input[placeholder="Segundo Apellido"]').value;
    const correo = document.querySelector('input[type="email"]').value;
    const identidad = document.querySelector('input[placeholder="Número de identidad"]').value;
    const telefono = document.querySelector('input[placeholder="Número de telefono"]').value;
    const carreraPrincipal = document.getElementById('career-select').value;
    const carreraSecundaria = document.getElementById('career-select-secondary').value;
    const centroRegional = document.getElementById('center-select').value;
    const certificado = document.getElementById('certificado').files[0];

    if (!primerNombre || !segundoNombre || !primerApellido || !segundoApellido || !correo || !identidad || !telefono || !carreraPrincipal || !carreraSecundaria || !centroRegional || !certificado) {
        alert("Por favor, ingrese todos los campos.");
        return;
    }

    const formData = new FormData();
    formData.append("primerNombre", primerNombre);
    formData.append("segundoNombre", segundoNombre);
    formData.append("primerApellido", primerApellido);
    formData.append("segundoApellido", segundoApellido);
    formData.append("correo", correo);
    formData.append("identidad", identidad);
    formData.append("telefono", telefono);
    formData.append("carreraPrincipal", carreraPrincipal);
    formData.append("carreraSecundaria", carreraSecundaria);
    formData.append("centroRegional", centroRegional);
    formData.append("certificado", certificado);

    try {
        const response = await fetch(endpointSubmitForm, {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (response.ok) {
            alert(data.success);
            localStorage.setItem("idSolicitud", JSON.stringify(data.admision.ID));
            window.location.href = "?page=success_formulario";
        } else {
            alert(data.error);
        }
    } catch (error) {
        console.error("Error en la petición:", error);
        alert("Hubo un error al realizar la solicitud");
    }
});

fillSelects();
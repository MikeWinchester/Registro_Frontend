import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

const allowedRoles = ["Estudiante"];

document.querySelector(".btn-login").addEventListener("click", async () => {

    const numeroCuenta = document.querySelector('input[placeholder="Número de Cuenta"]').value;
    const password = document.querySelector('input[placeholder="Contraseña"]').value;
    const endpoint = `${env.API_URL}/login`;

    if (!numeroCuenta || !password) {
        alert("Por favor ingresa ambos campos.");
        return;
    }

    const loginData = {
        NumeroCuenta: numeroCuenta,
        Pass: password
    };

    try {
        const response = await fetch(endpoint, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(loginData)
        });

        const data = await response.json();

        if (response.ok) {
            localStorage.setItem("token", data.token);
            checkAccess("/students/login", "/students/home");
        } else {
            alert(data.error || "Error desconocido.");
        }
    } catch (error) {
        console.error("Error al realizar la solicitud:", error);
        alert("Hubo un error al intentar iniciar sesión. Intenta nuevamente.");
    }
});

function getUserRoles() {
    const token = localStorage.getItem("token");
    if (!token) return null;

    const payload = token.split(".")[1]; // Extrae la parte del payload
    const decoded = JSON.parse(atob(payload)); // Decodifica Base64

    console.log(decoded);

    return decoded.roles || []; // Retorna el array de roles
}


function checkAccess(deniedURL, destinyURL) {
    const userRoles = getUserRoles();
    if (!userRoles || !userRoles.some(role => allowedRoles.includes(role))) {
        alert("Acceso denegado");
        window.location.href = `${deniedURL}`; // Redirigir si no tiene acceso
    }else{
        window.location.href = `${destinyURL}`;
    }
}



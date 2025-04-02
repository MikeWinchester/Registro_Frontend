import { showModalSuccess, showModalFailure } from "../js/utilities.mjs";

import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

const allowedRoles = ["Estudiante", "Docente"];

if(checkAccess()){
    window.location.href = "/matricula_estudiante/home";
}

document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const numeroCuenta = document.getElementById("numeroCuenta").value;
    const contrasenia = document.getElementById("contrasenia").value;

    if (!numeroCuenta || !contrasenia) {
        alert("Por favor ingresa ambos campos.");
        return;
    }

    const loginData = {
        numeroCuenta: numeroCuenta,
        contrasenia: contrasenia
    };

    const loadingElement = document.getElementById("loading");
    const timeoutMessage = document.querySelector(".timeout-message");
    // Mostrar loading
    loadingElement.style.display = "flex";
    timeoutMessage.style.display = "none";
    
    // Timeout para peticiones lentas (5 segundos)
    const timeout = setTimeout(() => {
        timeoutMessage.style.display = "block";
    }, 5000);

    fetch(`${env.API_URL}/login`,{
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(loginData)
    })
    .then(response=>{
        if(!response.ok){
            throw new Error(response.status);
        }
        return response.json();
    })
    .then(data=>{
        localStorage.setItem("token", data.token);
        if(checkAccess()){
            window.location.href = "/students/home";
        }else{
            showModalFailure("Acceso denegado");
        }
    })
    .catch(error=>{
        showModalFailure(error);
    })
    .finally(()=>{
        loadingElement.style.display = "none";
        clearTimeout(timeout);
    });
});

function getUserRoles() {
    const token = localStorage.getItem("token");
    if (!token) return null;

    const payload = token.split(".")[1]; // Extrae la parte del payload
    const decoded = JSON.parse(atob(payload)); // Decodifica Base64

    return decoded.roles || []; // Retorna el array de roles
}


function checkAccess() {
    const userRoles = getUserRoles();
    if (!userRoles || !userRoles.some(role => allowedRoles.includes(role))) {
        return false;
    }else{
        return true;
    }
}



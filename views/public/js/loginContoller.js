import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

document.querySelector(".btn-login").addEventListener("click", async () => {
    const numeroCuenta = document.querySelector('input[placeholder="Número de Cuenta"]').value;
    const password = document.querySelector('input[placeholder="Contraseña"]').value;

    if (!numeroCuenta || !password) {
        alert("Por favor ingresa ambos campos.");
        return;
    }

    const loginData = {
        NumeroCuenta: numeroCuenta,
        Pass: password
    };

    try {
        const response = await fetch(`${env.API_URL}/login`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(loginData)
        });

        const data = await response.json();

        if (response.ok) {
            localStorage.setItem("jwt", data.token);
            window.location.href = "?page=estudiantes";
        } else {
            alert(data.error || "Error desconocido.");
        }
    } catch (error) {
        console.error("Error al realizar la solicitud:", error);
        alert("Hubo un error al intentar iniciar sesión. Intenta nuevamente.");
    }
});



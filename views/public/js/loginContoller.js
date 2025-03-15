import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

document.querySelector(".btn-login").addEventListener("click", async () => {
    // Obtener los valores de los campos de entrada
    const numeroCuenta = document.querySelector('input[placeholder="Número de Cuenta"]').value;
    const password = document.querySelector('input[placeholder="Contraseña"]').value;

    // Validación simple
    if (!numeroCuenta || !password) {
        alert("Por favor ingresa ambos campos.");
        return;
    }

    // Crear el cuerpo de la solicitud
    const loginData = {
        NumeroCuenta: numeroCuenta,
        Pass: password
    };

    try {
        // Enviar la solicitud al endpoint de login
        const response = await fetch(`${env.API_URL}/login`, {  // Cambia esta URL por la correcta
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(loginData)
        });

        const data = await response.json();

        // Verificar la respuesta del servidor
        if (response.ok) {
            // Guardar el JWT en el localStorage o manejar el token de acuerdo con tus necesidades
            localStorage.setItem("jwt", data.token);
            window.location.href = "?page=estudiantes"; // Redirige a la página de inicio
        } else {
            // Mostrar mensaje de error
            alert(data.error || "Error desconocido.");
        }
    } catch (error) {
        console.error("Error al realizar la solicitud:", error);
        alert("Hubo un error al intentar iniciar sesión. Intenta nuevamente.");
    }
});



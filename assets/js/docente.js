document.addEventListener("DOMContentLoaded", async function () {
    try {
        //Cambiar la url para conectar con el backend (.ENV.APIURL {$idDocente})
        const response = await fetch(`http://localhost:3806/secciones/count/1`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) {
            throw new Error("Error en la respuesta de la API");
        }

        const jsonResponse = await response.json();

        if (jsonResponse.data && jsonResponse.data.length > 0) {
            const seccionesAsignadas = jsonResponse.data[0].cantidad;
            document.getElementById("seccionesCount").textContent = `Secciones asignadas: ${seccionesAsignadas}`;
        } else {
            document.getElementById("seccionesCount").textContent = "No se encontraron secciones.";
        }

    } catch (error) {
        console.error("Error al realizar la solicitud:", error);
        document.getElementById("seccionesCount").textContent = "Error al obtener las secciones.";
    }
});

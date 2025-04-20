async function loadEnv() {
    try {
        const response = await fetch("/config.php");
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error("Error cargando las variables de entorno:", error);
        return {};
    }
}

export default loadEnv;

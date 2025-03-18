document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        const perfilCard = document.querySelector(".perfil");

        if (perfilCard) {
            perfilCard.addEventListener("click", function (event) {
                event.preventDefault();
                cargarPerfil();
            });
        } else {
            console.log("No se encontró el elemento .perfil");
        }
    }, 500);
});

async function cargarPerfil() {
    try {
        // Cambiar la URL para conectar con el backend (.ENV.APIURL {$idDocente})
        const response = await fetch("http://localhost:3806/docentes/1");

        if (!response.ok) throw new Error("Error en la API");

        const jsonResponse = await response.json();

        const mainContent = document.querySelector("#main-content");
        if (!mainContent) {
            return;
        }

        if (!jsonResponse.data || jsonResponse.data.length === 0) {
            mainContent.innerHTML = `<div class="alert alert-warning text-center">No se encontró información del perfil.</div>`;
            return;
        }

        // Obtener los datos del primer perfil
        const perfil = jsonResponse.data[0];

        // Generar la tarjeta de perfil dinámicamente
        let perfilHTML = `
            <div class="card">
                <div class="card-body text-center">
                    <img src="/Registro_Frontend/assets/images/perfil.jpg" alt="Foto de perfil" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    <h4 class="card-title">${perfil.NombreCompleto}</h4>
                    <p class="card-text">📧 Correo: ${perfil.Correo}</p>
                    <p class="card-text">🔢 Número de Cuenta: ${perfil.NumeroCuenta}</p>
                    <p class="card-text">🔢 Centro: ${perfil.NombreCentro}</p>
                    <p class="card-text">🏫 Departamento: Matemáticas</p>
                    <p class="card-text">📅 Fecha de ingreso: 10/08/2015</p>
                    <button class="btn btn-primary mt-2">Editar Perfil</button>
                </div>
                <div class="card-footer">
                    <a href="#" class="text-muted">Ver más detalles</a>
                </div>
            </div>
        `;

        // Reemplazar el contenido del `#main-content`

        mainContent.innerHTML = perfilHTML;
    } catch (error) {
        console.error("Error al obtener el perfil:", error);
    }
}

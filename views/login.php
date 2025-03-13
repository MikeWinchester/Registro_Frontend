<?php
$config = include __DIR__ . "/../config.php";
$api_url = $config["API_URL"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", async function () {
            const token = localStorage.getItem("jwtToken");
            if (!token) return; // Si no hay token, el usuario no está autenticado.

            // Verificar con el backend si el token es válido
            const response = await fetch("http://localhost:8000/profile", {
                method: "GET",
                headers: { "Authorization": `Bearer ${token}` }
            });

            if (response.status === 401) { // Token inválido o expirado
                localStorage.removeItem("jwtToken"); // Eliminar el token inválido
                return;
            }

            // Si el token es válido, redirigir al usuario al dashboard
            window.location.href = "?page=prueba";
        });


        async function login(event) {
            event.preventDefault();

            const numeroCuenta = document.getElementById("numeroCuenta").value;
            const pass = document.getElementById("pass").value;

            const response = await fetch("<?php echo $api_url; ?>/login", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ NumeroCuenta: numeroCuenta, Pass: pass })
            });

            const data = await response.json();

            if (data.token) {
                localStorage.setItem("jwtToken", data.token);
                window.location.href = "?page=prueba"; // Redirigir al dashboard
            } else {
                document.getElementById("error-message").textContent = data.error;
                document.getElementById("error-message").classList.remove("d-none");
            }
        }
    </script>

    <div class="container-form" id="Cuerpo_login">
        <div class="informacion">
            <div class="info-childs">
                <h2>Se Parte de la UNAH</h2>
                <p>Recuerda que antes debe de completar el proceso de admisión.</p>
                <a href="?page=landing">
                    <input type="button" value="Regresar">
                </a>
                <p>Para iniciar su proceso de admisión, por favor seleccione este botón.</p>
                <a href="?page=formulario_admisiones">
                    <input type="button" value="Formulario de Admisiones">
                </a>
            </div>
        </div>
        <div class="form-informacion">
            <div class="form-informacion-child">
                <h2>Inicia Sesión</h2>
                <p>Inicia sesión con tu número de cuenta y contraseña</p>
                <form class="form" onsubmit="login(event)">
                    <label>
                        <i class="bi bi-person"></i>
                        <input type="text" id="numeroCuenta" placeholder="Número de Cuenta" required>
                    </label>
                    <label>
                        <i class="bi bi-lock"></i>
                        <input type="password" id="pass" placeholder="Contraseña" required>
                    </label>
                    <input type="submit" value="Acceder">
                </form>
                <div id="error-message" class="alert alert-danger d-none mt-2"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro UNAH</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/style_formulario_admisiones.css">
</head>
<body>
    <?php require __DIR__ . "/components/navbar.php"; ?>

    <section class="cuerpo_admisiones">
        <div class="container-form" id="Cuerpo_login">
            <div class="informacion">
                <div class="info-childs">
                    <h2>Se Parte de la UNAH</h2>
                    <p>Regístrate y comienza tu futuro académico</p>
                    <a href="?page=landing" class="btn btn-warning">Regresar</a>
                </div>
            </div>
            <div class="form-informacion">
                <div class="form-informacion-child">
                    <h2>Proceso de Admisión</h2>
                    <p>Ingrese datos correctos y verificables</p>
                    <form id="form-admision" class="form">
                        <div class="row">
                        <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Primer Nombre" aria-label="First name" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Segundo Nombre" aria-label="Last name" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Primer Apellido" aria-label="First name" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Segundo Apellido" aria-label="Last name" required>
                                </label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <label>
                                    <i class="bi bi-envelope-at"></i>
                                    <input type="email"class="form-control" aria-label="Correo electrónico" placeholder="Ingresar su correo" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-flag"></i>
                                    <input type="text"class="form-control" aria-label="" placeholder="Número de identidad" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-telephone"></i>
                                    <input type="text"class="form-control" aria-label="" placeholder="Número de telefono" required>
                                </label>
                            </div>
                        </div>
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="" id="center-select" required>
                                <option value="" id="select_carrera" disabled selected>Seleccione una Centro Regional</option>
                            </select>
                        </label>
                
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="" id="career-select" required>
                                <option value="" id="" disabled selected>Seleccione una Carrera Principal</option>
                            </select>
                        </label>
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="" id="career-select-secondary" required>
                                <option value="" id="" disabled selected>Seleccione una Carrera Secundaria</option>
                            </select>
                        </label>

                        <label>
                            <input type="file" name="CertificadoSecundaria" id="certificado" accept="image/*" required>
                            <small id="certificadoError" style="color: red; display: none;"></small>
                        </label>
                        <button type="button" class="submit-btn btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const emailField = document.querySelector('input[type="email"]');
        const identidadField = document.querySelector('input[placeholder="Número de identidad"]');
        const telefonoField = document.querySelector('input[placeholder="Número de telefono"]');

        const emailError = createErrorMessage(emailField);
        const identidadError = createErrorMessage(identidadField);
        const telefonoError = createErrorMessage(telefonoField);

        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const identidadRegex = /^\d{13}$/;
        const telefonoRegex = /^(2|3|8|9)\d{7}$/;

        emailField.onchange = () => validateField(emailField, emailRegex, emailError, "Correo no válido");
        identidadField.onchange = () => validateField(identidadField, identidadRegex, identidadError, "Identidad no válida");
        telefonoField.onchange = () => validateField(telefonoField, telefonoRegex, telefonoError, "Teléfono no válido");

        function validateField(field, regex, errorElement, message) {
            if (!regex.test(field.value.trim())) {
                errorElement.textContent = message;
                field.classList.add("is-invalid");
            } else {
                errorElement.textContent = "";
                field.classList.remove("is-invalid");
            }
        }

        function createErrorMessage(field) {
            const error = document.createElement("small");
            error.style.color = "red";
            error.style.fontSize = "12px";
            error.style.display = "block";
            error.style.marginTop = "5px";
            field.parentNode.appendChild(error);
            return error;
        }

        document.getElementById("certificado").onchange = function(event) {
            const file = event.target.files[0];
            const errorLabel = document.getElementById("certificadoError");
            
            if (!file) {
                errorLabel.style.display = "none";
                return;
            }

            const validTypes = ["image/jpeg", "image/png"];
            if (!validTypes.includes(file.type)) {
                errorLabel.textContent = "Formato inválido. Solo se permiten archivos JPG y PNG.";
                errorLabel.style.display = "block";
                event.target.value = "";
                return;
            }

            const maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                errorLabel.textContent = "El archivo supera el límite de 2MB.";
                errorLabel.style.display = "block";
                event.target.value = "";
                return;
            }

            const img = new Image();
            img.src = URL.createObjectURL(file);
            img.onload = function () {
                const minWidth = 800, minHeight = 600;
                if (img.width < minWidth || img.height < minHeight) {
                    errorLabel.textContent = `La imagen debe ser al menos ${minWidth}x${minHeight} píxeles.`;
                    errorLabel.style.display = "block";
                    event.target.value = "";
                } else {
                    errorLabel.style.display = "none";
                }
            };
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="/assets/js/admisionesController.js"></script>
</body>
</html>

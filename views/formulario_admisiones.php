<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro UNAH - Proceso de Admisión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style_formulario_admisiones.css">
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/loading.css">
    <link rel="stylesheet" href="/assets/css/successModal.css">
    <link rel="stylesheet" href="/assets/css/failureModal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php require __DIR__ . "/components/navbar.php"?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-1">Proceso de Admisión UNAH</h3>
                        <p class="mb-0">Ingrese sus datos personales completos</p>
                    </div>
                    <div class="card-body">
                        <form id="registroForm" novalidate>
                            <!-- Sección de Información Personal -->
                            <div class="mb-4">
                                <h5 class="section-title">Información Personal</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="primerNombre" class="form-label">Primer Nombre</label>
                                        <input type="text" class="form-control" id="primerNombre" name="primerNombre" required>
                                        <div class="invalid-feedback">
                                            Por favor ingrese su primer nombre
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                                        <input type="text" class="form-control" id="segundoNombre" name="segundoNombre">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="primerApellido" class="form-label">Primer Apellido</label>
                                        <input type="text" class="form-control" id="primerApellido" name="primerApellido" required>
                                        <div class="invalid-feedback">
                                            Por favor ingrese su primer apellido
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="segundoApellido" class="form-label">Segundo Apellido</label>
                                        <input type="text" class="form-control" id="segundoApellido" name="segundoApellido">
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Documento de Identidad -->
                            <div class="mb-4">
                                <h5 class="section-title">Documento de Identidad</h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="tipoDocumento" class="form-label">Tipo de Documento</label>
                                        <select class="form-select" id="tipoDocumento" name="tipoDocumento" required>
                                            <option value="" selected disabled>Seleccione...</option>
                                            <option value="identidad">Identidad</option>
                                            <option value="pasaporte">Pasaporte</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor seleccione un tipo de documento
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="numeroDocumento" class="form-label">Número de Documento</label>
                                        <input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" disabled required>
                                        <div class="invalid-feedback" id="documentoError">
                                            <span id="identidadError">Formato incorrecto. Ej: 0801-2000-12345</span>
                                            <span id="pasaporteError" style="display:none">Formato incorrecto. Ej: AB123456</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Contacto -->
                            <div class="mb-4">
                                <h5 class="section-title">Información de Contacto</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                        <div class="invalid-feedback">
                                            Ingrese un correo electrónico válido
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <div class="input-group">
                                            <select class="form-select" id="codigoPais" name="codigoPais" style="max-width: 120px;">
                                                <option value="+504">+504</option>
                                                <option value="+1">+1</option>
                                                <option value="+52">+52</option>
                                            </select>
                                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                                            <div class="invalid-feedback">
                                                Ingrese un número de teléfono válido
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Información Académica -->
                            <div class="mb-4">
                                <h5 class="section-title">Información Académica</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="centroRegional" class="form-label">Centro Regional</label>
                                        <select class="form-select" id="centroRegional" name="centroRegional" required>
                                            <option value="" selected disabled>Seleccione un centro regional</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor seleccione un centro regional
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="carreraPrincipal" class="form-label">Carrera Principal</label>
                                        <select class="form-select" id="carreraPrincipal" name="carreraPrincipal" required disabled>
                                            <option value="" selected disabled>Seleccione una carrera</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor seleccione una carrera principal
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="carreraSecundaria" class="form-label">Carrera Secundaria</label>
                                        <select class="form-select" id="carreraSecundaria" name="carreraSecundaria" disabled>
                                            <option value="" selected disabled>Seleccione una carrera</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Documentos -->
                            <div class="mb-4">
                                <h5 class="section-title">Documentos Requeridos</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="certificadoSecundaria" class="form-label">Certificado de Secundaria</label>
                                        <input type="file" class="form-control" id="certificadoSecundaria" name="certificadoSecundaria"
                                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.bmp,.tiff,.odt" required>
                                        <div class="invalid-feedback" id="certificadoError">
                                            Por favor suba un archivo válido (mínimo 800x600px para imágenes)
                                        </div>
                                        <small class="text-muted">
                                            Formatos aceptados: PDF, DOC, DOCX, JPG, JPEG, PNG, BMP, TIFF, ODT (Máx. 5MB)
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón de envío -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg py-3" id="submitBtn">
                                    Enviar Solicitud de Admisión
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require __DIR__ . "/components/failureModal.php"?>
    <?php require __DIR__ . "/components/successModal.php"?>
    <?php require __DIR__ . "/components/loading.php"?>
    <?php require __DIR__ . "/components/footer.php"?>

    <script type="module" src="/assets/js/admisionesController.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
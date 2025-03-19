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
                    <a href="inicio.html" class="btn btn-warning">Regresar</a>
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
                                    <input type="text" class="form-control" placeholder="Primer Nombre" name="Primer_nombre" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Segundo Nombre" name="Segundo_nombre">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Primer Apellido" name="Primer_apellido" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Segundo Apellido" name="Segundo_apellido">
                                </label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <label>
                                    <i class="bi bi-envelope-at"></i>
                                    <input type="email" class="form-control" placeholder="Correo Electrónico" name="Correo" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-flag"></i>
                                    <input type="text" class="form-control" placeholder="Número de Identidad" name="Numero_identidad" required>
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-telephone"></i>
                                    <input type="tel" class="form-control" placeholder="Número de Teléfono" name="Numero_telefono" required>
                                </label>
                            </div>
                        </div>
                
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="CarreraID" required>
                                <option value="" disabled selected>Seleccione una Carrera</option>
                                <option value="Ingenieria en Sistemas">Ingeniería en Sistemas</option>
                                <option value="Ingenieria Civil">Ingeniería Civil</option>
                                <option value="Derecho">Derecho</option>
                                <option value="Lenguas Extranjeras">Lenguas Extranjeras</option>
                                <option value="Mercadotecnia">Mercadotecnia</option>
                                <option value="Arquitectura">Arquitectura</option>
                            </select>
                        </label>

                        <label>
                            <i class="bi bi-building"></i>
                            <select name="CentroRegionalID" required>
                                <option value="" disabled selected>Seleccione un Centro Regional</option>
                                <option value="CU Tegucigalpa">CU Tegucigalpa</option>
                                <option value="UNAH-VS">UNAH-VS</option>
                                <option value="CUROC">CUROC</option>
                                <option value="CURNO">CURNO</option>
                                <option value="CURLP">CURLP</option>
                                <option value="CURLA">CURLA</option>
                            </select>
                        </label>

                        <label>
                            <input type="file" name="CertificadoSecundaria" accept="image/*" required>
                        </label>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php require __DIR__ . "/components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

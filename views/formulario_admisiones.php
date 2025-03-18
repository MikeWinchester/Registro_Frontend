<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro UNAH</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/style_formulario_admisiones.css";>

</head>
<body>
<?php require __DIR__ . "/components/navbar.php"?>
    <section class="cuerpo_admisiones">
        <div class="container-form" id="Cuerpo_login">
            <div class="informacion">
                <div class="info-childs">
                    <h2>Se Parte de la UNAH</h2>
                    <p> 
                    </p>
                    <a href="incio.html">
                        <input type="button" value="Regresar">
                    </a>
                </div>
            </div>
            <div class="form-informacion">
                <div class="form-informacion-child">
                    <h2>Proceso de Admision</h2>
                    <p>Le solicitamos ingresar datos correctos y verificables</p>
                    <form id="form-admision" class="form">
                        <div class="row">
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Primer Nombre" aria-label="First name" name="Primer_nombre">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Segundo Nombre" aria-label="Last name" name="Segundo_nombre">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Primer Apellid" aria-label="First name" name="Primer_apellido">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Segundo Apellido" aria-label="Last name" name="Segundo_apellido">
                                </label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <label>
                                    <i class="bi bi-envelope-at"></i>
                                    <input type="email" class="form-control" aria-label="Ingresar su correo" placeholder="Ingresar su correo" name="Correo">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-flag"></i>
                                    <input type="text" class="form-control" aria-label="" placeholder="Ingrese su numero de identidad" name="Numero_identidad">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-flag"></i>
                                    <input type="text" class="form-control" aria-label="" placeholder="Ingrese su numero de telefono" name="Numero_telefono">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person-badge"></i>
                                    <input type="text" class="form-control" aria-label="" placeholder="Ingrese su numero de identidad" name="Numero_identidad">
                                </label>
                            </div>
                        </div>
                
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="CarreraID" id="">
                                <option value="" id="select_carrera" disabled selected>Seleccione una Carrera Principal</option>
                                <option value="Ingenieria en Sistemas">Ingenieria en Sistemas</option>
                                <option value="Ingenieria Civil">Ingenieria Civil</option>
                                <option value="Derecho">Derecho</option>
                                <option value="Lenguas Extranjeras">Lenguas Extranjeras</option>
                                <option value="Mercadotecnia">Mercadotecnia</option>
                                <option value="Arquitectura">Arquitectura</option>
                            </select>
                        </label>
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="CarreraAlternativaID" id="">
                                <option value="" id="select_carrera" disabled selected>Seleccione una Carrera Secundaria</option>
                                <option value="Ingenieria en Sistemas">Ingenieria en Sistemas</option>
                                <option value="Ingenieria Civil">Ingenieria Civil</option>
                                <option value="Derecho">Derecho</option>
                                <option value="Lenguas Extranjeras">Lenguas Extranjeras</option>
                                <option value="Mercadotecnia">Mercadotecnia</option>
                                <option value="Arquitectura">Arquitectura</option>
                            </select>
                        </label>
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="CentroRegionalID" id="">
                                <option value="" id="select_carrera" disabled selected>Seleccione una Centro Regional</option>
                                <option value="Ingenieria en Sistemas">Ingenieria en Sistemas</option>
                                <option value="Ingenieria Civil">Ingenieria Civil</option>
                                <option value="Derecho">Derecho</option>
                                <option value="Lenguas Extranjeras">Lenguas Extranjeras</option>
                                <option value="Mercadotecnia">Mercadotecnia</option>
                                <option value="Arquitectura">Arquitectura</option>
                            </select>
                        </label>
                        <label>
                            <input type="file" name="CertificadoSecundaria" id="imagen" accept="image/*">
                        </label>
                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
        
    </section>
    
    <?php require __DIR__ . "/components/footer.php"?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

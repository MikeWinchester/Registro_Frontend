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
                                    <input type="text" class="form-control" placeholder="Primer Nombre" aria-label="First name">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Segundo Nombre" aria-label="Last name">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Primer Apellid" aria-label="First name">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person"></i>
                                    <input type="text" class="form-control" placeholder="Segundo Apellido" aria-label="Last name">
                                </label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <label>
                                    <i class="bi bi-envelope-at"></i>
                                    <input type="email"class="form-control" aria-label="Ingresar su correo" placeholder="Ingresar su correo">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-flag"></i>
                                    <input type="text"class="form-control" aria-label="" placeholder="Ingrese su numero de identidad">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-telephone"></i>
                                    <input type="text"class="form-control" aria-label="" placeholder="Ingrese su numero de telefono">
                                </label>
                            </div>
                        </div>
                
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="" id="">
                                <option value="" id="select_carrera" disabled selected>Seleccione una Carrera Principal</option>
                                <option value="21">Ingenieria en Sistemas</option>
                                <option value="22">Ingenieria Civil</option>
                                <option value="23">Ingenieria Industrial</option>
                                <option value="24">Ingenieria Mecanica</option>
                                <option value="25">Ingenieria Electrica</option>
                                <option value="26">Ingenieria Electronica</option>
                                <option value="27">Administracion de Empresas</option>
                                <option value="28">Contaduria Publica</option>
                                <option value="29">Economia</option>
                                <option value="30">Medicina</option>
                                <option value="31">Odontologia</option>
                                <option value="32">Enfermeria</option>
                                <option value="33">Psicologia</option>
                                <option value="34">Trabajo Social</option>
                                <option value="35">Ciencias de la Educacion</option>
                                <option value="36">Artes Plasticas</option>
                                <option value="37">Derecho</option>
                                <option value="38">Matematicas</option>
                                <option value="39">Biologia</option>
                                <option value="40">Fisica</option>
                            </select>
                        </label>
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="" id="">
                                <option value="" id="select_carrera" disabled selected>Seleccione una Carrera Secundaria</option>
                                <option value="21">Ingenieria en Sistemas</option>
                                <option value="22">Ingenieria Civil</option>
                                <option value="23">Ingenieria Industrial</option>
                                <option value="24">Ingenieria Mecanica</option>
                                <option value="25">Ingenieria Electrica</option>
                                <option value="26">Ingenieria Electronica</option>
                                <option value="27">Administracion de Empresas</option>
                                <option value="28">Contaduria Publica</option>
                                <option value="29">Economia</option>
                                <option value="30">Medicina</option>
                                <option value="31">Odontologia</option>
                                <option value="32">Enfermeria</option>
                                <option value="33">Psicologia</option>
                                <option value="34">Trabajo Social</option>
                                <option value="35">Ciencias de la Educacion</option>
                                <option value="36">Artes Plasticas</option>
                                <option value="37">Derecho</option>
                                <option value="38">Matematicas</option>
                                <option value="39">Biologia</option>
                                <option value="40">Fisica</option>
                            </select>
                        </label>
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="" id="">
                                <option value="" id="select_carrera" disabled selected>Seleccione una Centro Regional</option>
                                <option value="Ingenieria en Sistemas">UNAH CIUDAD UNIVERSITARIA</option>
                                <option value="Ingenieria Civil">UNAH CORTES</option>
                                <option value="Derecho">UNAH COMAYAGUA</option>
                                <option value="Lenguas Extranjeras">UNAH ATLTANTIDA</option>
                                <option value="Mercadotecnia">UNAH CHOLUTECA</option>
                                <option value="Arquitectura">UNAH COPAN</option>
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

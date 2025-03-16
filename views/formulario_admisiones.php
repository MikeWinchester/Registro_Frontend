<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admisiones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style_formulario_admisiones.css">
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="nav_bar">
        <div class="container">
            <img src="../assets/images/puma.png" alt="Logo UNAH" style="height: 40px; margin-right: 10px;">
            <a class="navbar-brand" href="#">UNAH Admision</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=landing">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=solicitud_admisiones">Solicitud</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=login">Revisiones</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
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
            <dive class="form-informacion">
                <div class="form-informacion-child">
                    <h2>Proceso de Admision</h2>
                    <p>Le solicitamos ingresar datos correctos y verificables</p>
                    <form class="form">
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
                                    <i class="bi bi-flag"></i>
                                    <input type="text"class="form-control" aria-label="" placeholder="Ingrese su numero de telefono">
                                </label>
                            </div>
                            <div class="col">
                                <label>
                                    <i class="bi bi-person-badge"></i>
                                    <input type="text"class="form-control" aria-label="" placeholder="Ingrese su numero de identidad">
                                </label>
                            </div>
                        </div>
                
                        <label>
                            <i class="bi bi-clipboard-check"></i>
                            <select name="" id="">
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
                            <select name="" id="">
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
                            <select name="" id="">
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
                            <input type="file" name="imagen" id="imagen" accept="image/*">
                        </label>
                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </dive>
        </div>
        
    </section>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>

<?php
    include('components/footer.php');  // Incluir el archivo del navbar
?>
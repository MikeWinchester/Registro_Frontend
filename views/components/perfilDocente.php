


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Fondo gris claro */
        }

        .card {
            max-width: 500px;
            margin: 50px auto;
            border-radius: 15px; /* Bordes redondeados para la tarjeta */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
            background-color: #ffffff;
        }

        .card-body {
            padding: 2rem; /* Más espacio en el contenido */
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: bold;
            color: #343a40; /* Color oscuro para el título */
        }

        .card-text {
            font-size: 1rem;
            color: #495057; /* Color gris suave para el texto */
        }

        .btn-primary {
            background-color: #007bff; /* Azul más atractivo */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Efecto hover más oscuro */
            border-color: #0056b3;
        }

        .rounded-circle {
            border: 3px solid #007bff; /* Bordes azules alrededor de la imagen */
        }

        .card-footer {
            background-color: #f1f3f5;
            padding: 1rem;
            text-align: center;
            border-radius: 0 0 15px 15px;
        }

        .card-footer a {
            text-decoration: none;
            color: #007bff;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>


<a href="docentes.php" class="back-link">◄ Volver</a>


<div class="card">
    <div class="card-body text-center">
    <img src="/Registro_Frontend/assets/images/perfil.jpg" alt="Foto de perfil" class="rounded-circle mb-3" style="width: 150px; height: 150px;">

        <h4 class="card-title">Juan Pérez</h4>
        <p class="card-text">📧 Correo: juan.perez@example.com</p>
        <p class="card-text">🏫 Departamento: Matemáticas</p>
        <p class="card-text">📅 Fecha de ingreso: 10/08/2015</p>
        <button class="btn btn-primary mt-2">Editar Perfil</button>
    </div>
    <div class="card-footer">
        <a href="#" class="text-muted">Ver más detalles</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

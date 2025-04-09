<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c5282;
            --secondary-color: #4299e1;
            --light-color: #ebf8ff;
            --background-color: #f8fafc;
            --border-color: #e2e8f0;
            --text-dark: #1a202c;
            --text-medium: #4a5568;
        }
        
        body {
            background-color: var(--background-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .back-link:hover {
            color: var(--secondary-color);
        }
        
        .back-link i {
            margin-right: 8px;
        }
        
        .profile-card {
            max-width: 500px;
            margin: 0 auto;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            background-color: white;
        }
        
        .profile-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .profile-img-container {
            margin-top: -70px;
            text-align: center;
        }
        
        .profile-img {
            width: 120px;
            height: 120px;
            border: 4px solid white;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .profile-body {
            padding: 1.5rem;
        }
        
        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .profile-detail {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: var(--text-medium);
        }
        
        .profile-detail i {
            color: var(--secondary-color);
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        
        .profile-footer {
            background-color: var(--background-color);
            padding: 1rem;
            text-align: center;
            border-top: 1px solid var(--border-color);
        }
        
        .btn-edit {
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            margin-top: 1.5rem;
            width: 100%;
            transition: background-color 0.2s;
        }
        
        .btn-edit:hover {
            background-color: var(--secondary-color);
        }
        
        .btn-edit i {
            margin-right: 8px;
        }
        
        .more-link {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .more-link:hover {
            text-decoration: underline;
        }
        
        #loader-perfil {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
        
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
</head>
<body>

<a href="docentes.php" class="back-link">
    <i class="bi bi-arrow-left"></i> Volver
</a>

<div id="main-content">
    <!-- El contenido se cargará dinámicamente aquí -->
</div>

<div id="loader-perfil" class="text-center">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/Docente.js"></script>

</body>
</html>
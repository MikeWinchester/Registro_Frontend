<?php include('../components/navbar.php');?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Selección de Perfil</title>
    <style>
        .perfiles-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        
        .titulo {
            color: #444;
            margin-bottom: 30px;
        }
        
        .perfil-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .perfil-item:hover {
            background-color: #f8f9fa;
            border-color: #007bff;
            transform: translateX(10px);
        }
        
        .emoji {
            font-size: 24px;
            margin-right: 15px;
        }
        
        .rol {
            font-weight: bold;
            color: #2c3e50;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css">
</head>
<body>
    <div class="perfiles-container">
        <h2 class="titulo">Selecciona tu perfil:</h2>
        
        <div class="perfil-item">
            
            <span class="rol">Jefe</span>
        </div>
        
        <div class="perfil-item">
            
            <span class="rol">Coordinador</span>
        </div>
        
        <div class="perfil-item">
            
            <span class="rol">Docente</span>
        </div>
        
        <div class="perfil-item">
            
            <span class="rol">Estudiante</span>
        </div>
        
        <div class="perfil-item">
            
            <span class="rol">Revisor</span>
        </div>
    </div>
</body>
</html>
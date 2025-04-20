<?php
session_start();
// Definir roles globales permitidos
$globalRoles = ['Estudiante', 'Docente', 'Jefe', 'Coordinador'];
$userRoles = $_SESSION['user_roles'] ?? [];

// Verificar si el usuario tiene menos de 2 roles permitidos
$coincidencias = array_intersect($userRoles, $globalRoles);
$cantidadRoles = count($coincidencias);


// Redirigir si tiene menos de 2 roles
if ($cantidadRoles < 2) {
    $rolUnico = $cantidadRoles === 1 ? reset($coincidencias) : 'Estudiante';
    redirigirSegunRol($rolUnico);
}

// Si se envía el formulario con el rol seleccionado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rol_seleccionado'])) {
    redirigirSegunRol($_POST['rol_seleccionado']);
}

// Función para redirigir según el rol
function redirigirSegunRol($rol) {
    $rutas = [
        'Estudiante' => '../estudiante/views/dashboard.php',
        'Docente' => '../docente/views/pregrado_docente.php',
        'Jefe' => '../jefe/views/pregrado_jefe_departamento.php',
        'Coordinador' => '../coordinador/views/coordinador.php',
    ];
    
    $ruta = $rutas[$rol] ?? '../estudiante/views/dashboard.php';
    header("Location: $ruta");
    exit;
}
?>

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
        }
        
        .emoji {
            font-size: 24px;
            margin-right: 15px;
        }
        
        .rol {
            font-weight: bold;
            color: #2c3e50;
        }
        
        .hidden-radio {
            display: none;
        }
        
        .selected {
            background-color: #e7f1ff;
            border-color: #007bff;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/navbar.css">
</head>
<body>
    <?php require __DIR__ . '/../../components/navbar.php' ?>

    <div class="perfiles-container">
        <h2 class="titulo">Selecciona tu perfil:</h2>

        
        <form method="POST" action="">
            <?php
            // Mapeo de roles a emojis
            $emojis = [
                'Jefe' => '👔',
                'Coordinador' => '📊',
                'Docente' => '📚',
                'Estudiante' => '🎓',
                'Revisor' => '🔍'
            ];
            
            // Generar dinámicamente los items de perfil
            foreach ($coincidencias as $rol) {
                echo '<label class="perfil-item">';
                echo '<input type="radio" name="rol_seleccionado" value="' . htmlspecialchars($rol) . '" class="hidden-radio" required>';
                echo '<span class="emoji">' . ($emojis[$rol] ?? '👤') . '</span>';
                echo '<span class="rol">' . htmlspecialchars($rol) . '</span>';
                echo '</label>';
            }
            ?>
            
            <button type="submit" class="btn btn-primary mt-3">Continuar</button>
        </form>
    </div>

    <script>
        // Mejora UX: Resaltar el elemento seleccionado
        document.querySelectorAll('.perfil-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.perfil-item').forEach(i => i.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });
    </script>
</body>
</html>
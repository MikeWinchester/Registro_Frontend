<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil de Docente</title>
    <style>
    
        body {
            background: linear-gradient(to right, #4A90E2, #F6E0A5); 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        
        .edit-profile-section {
            padding: 60px 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #555;
            margin: 80px auto;
            max-width: 800px;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #4A90E2; 
            font-weight: 600;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 1rem;
            color: #4A90E2;
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .form-group input[type="file"] {
            padding: 8px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #F6E0A5; 
            outline: none;
        }

        .btn-save {
            background-color: #4A90E2;
            color: #fff;
            padding: 12px 30px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .btn-save:hover {
            background-color: #F6E0A5;
            color: #4A90E2;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto;
            object-fit: cover;
        }

        
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <section class="edit-profile-section">
        <h2 class="section-title">Editar Perfil de Docente</h2>

        <div class="form-container">
            <form action="#" method="POST">
                <!-- Foto de perfil -->
                <div class="form-group">
                    <img src="https://via.placeholder.com/150" alt="Foto de Perfil" class="profile-image">
                    <input type="file" name="profile_image" id="profile_image" accept="image/*">
                </div>

                <!-- Nombre -->
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" value="Juan Pérez" required>
                </div>

                <!-- Correo -->
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="juan.perez@example.com" required>
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                    <label for="phone">Codigo de Empleado</label>
                    <input type="tel" id="codigo" name="codigo" value="1234" required>
                </div>

    
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select id="department" name="department" required>
                        <option value="matematicas" selected>Matemáticas</option>
                        <option value="fisica">Física</option>
                        <option value="quimica">Química</option>
                    </select>
                </div>

            
                <button type="submit" class="btn-save">Guardar Cambios</button>
            </form>
        </div>
    </section>

</body>
</html>

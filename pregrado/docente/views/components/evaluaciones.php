<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Calificaciones | Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel='stylesheet' href="/assets/css/toastMessage.css">
    <style>
        :root {
            --azul-oscuro: #2c5282;
            --azul-medio: #4299e1;
            --azul-claro: #ebf8ff;
            --gris-claro: #f8fafc;
            --gris-medio: #e2e8f0;
            --texto-oscuro: #1a202c;
            --texto-medio: #4a5568;
        }
        
        body {
            background-color: var(--gris-claro);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            background-color: white;
            border-top: 4px solid var(--azul-medio);
        }
        
        .card-header {
            background-color: white;
            color: var(--texto-oscuro);
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gris-medio);
        }
        
        .card-title {
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--texto-oscuro);
        }
        
        .form-select, .form-control {
            border-radius: 6px;
            border: 1px solid var(--gris-medio);
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .form-select:focus, .form-control:focus {
            border-color: var(--azul-medio);
            box-shadow: 0 0 0 0.2rem rgba(66, 153, 225, 0.15);
        }
        
        /* Estilo personalizado para el botón Guardar */
        #guardarNotas {
            background-color: #0069d9;
            border-color: #0062cc;
            padding: 0.6rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 6px;
            position: relative;
            overflow: hidden;
        }
        
        #guardarNotas:hover {
            background-color: #00478a;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        #guardarNotas:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        #guardarNotas i {
            transition: transform 0.3s ease;
        }
        
        #guardarNotas:hover i {
            transform: scale(1.1);
        }
        
        table {
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid var(--gris-medio);
        }
        
        thead {
            background-color: white;
            color: var(--texto-oscuro);
            border-bottom: 2px solid var(--gris-medio);
        }
        
        th {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--texto-medio);
            padding: 0.75rem 1rem;
        }
        
        td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }
        
        tbody tr {
            border-bottom: 1px solid var(--gris-medio);
        }
        
        tbody tr:last-child {
            border-bottom: none;
        }
        
        tbody tr:hover {
            background-color: var(--azul-claro);
        }
        
        .notas {
            max-width: 80px;
            text-align: center;
        }
        
        #observacion {
            min-width: 200px;
            background-color: white;
        }
        
        .spinner-border {
            width: 1.25rem;
            height: 1.25rem;
            border-width: 0.15em;
        }
        
        .title-icon {
            color: var(--azul-medio);
            font-size: 1.2rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--texto-medio);
        }
        
        .empty-state i {
            font-size: 2.5rem;
            color: var(--gris-medio);
            margin-bottom: 1rem;
            opacity: 0.7;
        }
        
        .empty-state h5 {
            font-weight: 500;
            color: var(--texto-oscuro);
        }
        
        .loader-text {
            font-size: 0.85rem;
            color: var(--texto-medio);
        }
    </style>
</head>
<body>
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="bi bi-journal-check title-icon"></i>
                    Gestión de Calificaciones
                </h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="claseSeleccionada" class="form-label mb-2" style="color: var(--texto-medio); font-size: 0.9rem;">
                            <i class="bi bi-book me-2"></i>Selecciona una clase
                        </label>
                        <select id="claseSeleccionada" class="form-select">
                            <option value="" selected disabled>Selecciona una clase</option>
                        </select>
                        <div id="loader-clases" class="text-center mt-3" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                            <p class="loader-text mt-2 mb-0">Cargando clases disponibles...</p>
                        </div>
                    </div>
                </div>
                
                <div id="estudiantesContainer" class="mt-4">
                    <div class="empty-state">
                        <i class="bi bi-people"></i>
                        <h5>No hay clase seleccionada</h5>
                        <p>Selecciona una clase del menú desplegable para ver la lista de estudiantes</p>
                    </div>
                    
                    <div id="loader-lista" class="text-center my-5" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="loader-text mt-2 mb-0">Cargando estudiantes...</p>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button id="guardarNotas" class="btn" disabled>
                        <i class="bi bi-save me-2"></i>Guardar Calificaciones
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="toast" class="toast">
        <!-- Toast original sin cambios -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/manejadorEstudiantes.js"></script>
    <script src="/assets/js/Docente.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración - Programaciones Académicas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;

      color: #fff;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 1100px;
      margin-top: 40px;
      margin-bottom: 40px;
    }
    .card {
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
    }
    .card-header {
      background: linear-gradient(135deg, #00478a, #00aaff);
      color: white;
      font-size: 1.5rem;
      padding: 20px;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    .card-body {
      padding: 30px;
      background-color: #f9f9f9;
      border-bottom-left-radius: 15px;
      border-bottom-right-radius: 15px;
    }
    .form-label {
      color: #333;
      font-size: 14px;
      font-weight: bold;
    }
    .form-control {
      border-radius: 10px;
      border: 1px solid #ddd;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }
    .form-control:focus {
      border-color: #00aaff;
      box-shadow: 0 0 5px rgba(0, 170, 255, 0.5);
    }
    .btn-save {
      background-color: white;
      color: #00478a;
      font-size: 14px;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 10px;
      border: 2px solid #00478a;
      transition: all 0.3s ease;
    }
    .btn-save:hover {
      background-color: #00478a;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .btn-cancel {
      background-color: white;
      color: #f1c40f;
      font-size: 14px;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 10px;
      border: 2px solid #f1c40f;
      transition: all 0.3s ease;
    }
    .btn-cancel:hover {
      background-color: #f1c40f;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .btn-edit {
      background-color: white;
      color: #27ae60;
      font-size: 14px;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 10px;
      border: 2px solid #27ae60;
      transition: all 0.3s ease;
    }
    .btn-edit:hover {
      background-color: #27ae60;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .btn-danger-custom {
      background-color: #e74c3c;
      color: white;
      font-size: 14px;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 10px;
      transition: all 0.3s ease;
    }
    .btn-danger-custom:hover {
      background-color: #c0392b;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .header-title {
      font-size: 2rem;
      font-weight: 600;
      color: #fff;
    }
    .section-subtitle {
      font-size: 1rem;
      color: #fff;
      margin-top: 10px;
    }
    .programacion-item {
      background-color: #fff;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .periodo-item {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
    }
    .periodo-title {
      color: #00478a;
      font-weight: bold;
      margin-bottom: 15px;
    }
    .fecha-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
      padding-bottom: 8px;
      border-bottom: 1px solid #eee;
    }
    .fecha-label {
      font-weight: bold;
      color: #555;
    }
    .fecha-valor {
      color: #333;
    }
    .acciones {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 15px;
    }
    .anio-title {
      color: #00478a;
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid #00478a;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Formulario para crear nueva programación -->
    <div class="card">
      <div class="card-header text-center">
        <div class="header-title">Nueva Programación Académica</div>
        <div class="section-subtitle">Configura un nuevo periodo académico y sus fechas clave</div>
      </div>
      <div class="card-body">
          <!-- Selección de año y periodo -->
          <div class="row mb-4">
            <div class="col-md-6">
              <label for="anioAcademico" class="form-label">Año Académico</label>
              <select id="anioAcademico" class="form-control" required>
                <option value="">Seleccione un año</option>
                <option>2023</option>
                <option>2024</option>
                <option>2025</option>
                <option>2026</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="periodoAcademico" class="form-label">Periodo Académico</label>
              <select id="periodoAcademico" class="form-control" required>
                <option value="">Seleccione un periodo</option>
                <option>Periodo I</option>
                <option>Periodo II</option>
                <option>Periodo III</option>
              </select>
            </div>
          </div>

          <!-- Fechas importantes -->
          <div class="row">
            <div class="col-md-6 mb-4">
              <label for="fechaMatriculaInicio" class="form-label">Fecha de Matrícula (Inicio)</label>
              <input type="date" id="fechaMatriculaInicio" class="form-control" required />
            </div>
            <div class="col-md-6 mb-4">
              <label for="fechaMatriculaFin" class="form-label">Fecha de Matrícula (Fin)</label>
              <input type="date" id="fechaMatriculaFin" class="form-control" required />
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-4">
              <label for="registroNotasInicio" class="form-label">Registro de Notas (Inicio)</label>
              <input type="date" id="registroNotasInicio" class="form-control" required />
            </div>
            <div class="col-md-6 mb-4">
              <label for="registroNotasFin" class="form-label">Registro de Notas (Fin)</label>
              <input type="date" id="registroNotasFin" class="form-control" required />
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-4">
              <label for="periodoAdicionInicio" class="form-label">Periodo de Adición y Cancelacion (Inicio)</label>
              <input type="date" id="periodoAdicionInicio" class="form-control" required />
            </div>
            <div class="col-md-6 mb-4">
              <label for="periodoAdicionFin" class="form-label">Periodo de Adición y Cancelacion (Fin)</label>
              <input type="date" id="periodoAdicionFin" class="form-control" required />
            </div>
          </div>

          <!-- Botones del formulario -->
          <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-cancel">Cancelar</button>
            <button class="btn btn-save" id='save'>Guardar Programación</button>
          </div>
      </div>
    </div>

    <!-- Listado de programaciones existentes -->
    <div class="card">
      <div class="card-header text-center">
        <div class="header-title">Programaciones Académicas Registradas</div>
        <div class="section-subtitle">Historial de periodos académicos configurados</div>
      </div>
      <div class="card-body">
        <!-- Programación 2025 -->
        <div class="programacion-item">
          <div class="anio-title">2025</div>
          
          <!-- Periodo I -->
          <div class="periodo-item">
            <div class="periodo-title">Periodo I</div>
            
            <div class="fecha-item">
              <span class="fecha-label">Matrícula:</span>
              <span class="fecha-valor">15/02/2025 - 28/02/2025</span>
            </div>
            
            <div class="fecha-item">
              <span class="fecha-label">Registro de Notas:</span>
              <span class="fecha-valor">10/06/2025 - 20/06/2025</span>
            </div>
            
            <div class="fecha-item">
              <span class="fecha-label">Adición de Cursos:</span>
              <span class="fecha-valor">01/03/2025 - 07/03/2025</span>
            </div>
            
            <div class="fecha-item">
              <span class="fecha-label">Cancelación de Cursos:</span>
              <span class="fecha-valor">08/03/2025 - 15/03/2025</span>
            </div>
            
            <div class="acciones">
              <button class="btn btn-edit">Editar</button>
              <button class="btn btn-danger-custom">Eliminar</button>
            </div>
          </div>
          
          <!-- Periodo II -->
          <div class="periodo-item">
            <div class="periodo-title">Periodo II</div>
            
            <div class="fecha-item">
              <span class="fecha-label">Matrícula:</span>
              <span class="fecha-valor">15/07/2025 - 30/07/2025</span>
            </div>
            
            <div class="fecha-item">
              <span class="fecha-label">Registro de Notas:</span>
              <span class="fecha-valor">10/11/2025 - 20/11/2025</span>
            </div>
            
            <div class="fecha-item">
              <span class="fecha-label">Adición de Cursos:</span>
              <span class="fecha-valor">01/08/2025 - 07/08/2025</span>
            </div>
            
            <div class="fecha-item">
              <span class="fecha-label">Cancelación de Cursos:</span>
              <span class="fecha-valor">08/08/2025 - 15/08/2025</span>
            </div>
            
            <div class="acciones">
              <button class="btn btn-edit">Editar</button>
              <button class="btn btn-danger-custom">Eliminar</button>
            </div>
          </div>
        </div>
        
     
          </div>
        </div>
      </div>
    </div>
  </div>




  <!-- Modal de Confirmación -->
  <div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmacionModalLabel">Confirmar Guardado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea guardar esta programación académica?</p>
          <div class="alert alert-info mt-3">
            <strong>Resumen:</strong>
            <div id="resumenProgramacion"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="confirmarGuardado">Sí, Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/Admin/assets/js/adminDOM.js"> </script>
    
</body>
</html>
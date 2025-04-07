<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secciones Programadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href="/assets/css/modal.css">
</head>
<body>
    


  <!-- Secciones Programadas-->

  <div class="container mt-4">
  <h2><i class="fas fa-chalkboard-teacher"></i>Secciones Programadas</h2><br>


<div id="clasesAccordion" class="accordion">
    
    <div class="accordion-item" id='class-container'>
        <p>Cargando...</p>
    </div>
    <div id="loader-secciones" class="text-center mt-2" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            
        </div>
    </div>
</div>


<div id="Modal" class="modal" tabindex="-1" style="background-color: rgba(0,0,0,0.4);">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow rounded-4 border-0" style="font-family: 'Segoe UI', sans-serif;">
      
      <div class="modal-header bg-info " style="color: white;">
        <h5 class="modal-title fw-semibold" style="font-size: 1.25rem;">Editar Sección</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      
      <div class="modal-body">
        
        <!-- DOCENTE -->
        <div class="mb-3">
          <label for="editarDocente" class="form-label fw-semibold">Docente</label>
          <select class="form-select" id="editarDocente">
            <option>Seleccione un docente</option>
            <!-- Opciones dinámicas -->
          </select>
        </div>

        <!-- CUPOS -->
        <div class="mb-3">
          <label for="editarCupos" class="form-label fw-semibold">Aumentar Cupos</label>
          <input type="number" class="form-control" id="editarCupos">
        </div>

      </div>
      
      <div class="modal-footer d-flex justify-content-between">
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        <div>
          <button  class="btn btn-outline-primary" id="btnEliminar">Eliminar</button>
          <button class="btn btn-warning" id="btn-1">Guardar Cambios</button>
        </div>
      </div>

    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
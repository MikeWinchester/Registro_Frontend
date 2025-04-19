<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secciones Programadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/toastMessage.css">
    <link rel='stylesheet' href="/assets/css/modal.css">
</head>
<body>

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
.card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    background-color: white;
    border-top: 4px solid var(--azul-medio);
}



.card-title {
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--texto-oscuro);
}



accordion-button {
    background-color: #f8f9fa; 
    color: #495057;
    font-weight: bold;
}
.accordion-button:not(.collapsed) {
    background-color:#84bffd;; 
    color: white;
}
.accordion-item {
    border: none;
    border-radius: 8px;
    margin-bottom: 15px;
}
.accordion-body {
    background-color: #f1f3f5; 
    padding: 20px;
}
.table {
    margin-top: 20px;
}
.table th {
    background-color:rgb(1, 54, 110); 
    color: white;
    text-align: center;
}
.table td {
    text-align: center;
}
.badge {
    font-size: 14px;
    padding: 6px 12px;
}
.badge.bg-success {
    background-color: #28a745; 
}
.badge.bg-danger {
    background-color: #dc3545; 
}

</style>
    


<div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="bi bi-calendar title-icon"></i>
                    Secciones Programadas
                </h4>
            </div>
            <div>
            <div id="clasesAccordion" class="accordion">
    
    <div class="accordion-item" id='class-container'>
        <p>Cargando...</p>
    </div>
    <div id="loader-secciones" class="text-center mt-2" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            
        </div>
    </div>
</div>



            </div>
    </div>
 </div>












<div id="Modal" class="modal" tabindex="-1" style="background-color: rgba(0,0,0,0.4);">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow rounded-4 border-0" style="font-family: 'Segoe UI', sans-serif;">
      
      <div class="modal-header bg-info " style="color: white;">
        <h5 class="modal-title fw-semibold" style="font-size: 1.25rem;">Editar Sección</h5>
        <button type="button" class="btn-close btn-close-white" aria-label="Cerrar"></button>
      </div>
      
      <div class="modal-body">
        
        
        <div class="mb-3">
          <label for="editarDocente" class="form-label fw-semibold">Docente</label>
          <select class="form-select" id="modal-docente">
            
            
          </select>
        </div>

        <!-- CUPOS -->
        <div class="mb-3">
          <label for="editarCupos" class="form-label fw-semibold">Aumentar Cupos</label>
          <input type="number" class="form-control" id="editarCupos">
        </div>

      </div>
      
      <div class="modal-footer d-flex justify-content-between">
      <button type="button" class="btn-close btn-close-white" aria-label="Cerrar"></button>
        <div>
          <button  class="btn btn-outline-primary" id="btnEliminar">Eliminar</button>
          <button class="btn btn-warning" id="btn-1">Guardar Cambios</button>
        </div>
      </div>

    </div>
  </div>
</div>
<div id="toast" class="toast">

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
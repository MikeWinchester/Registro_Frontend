<!-- Modal de Error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-danger">
      <!-- Cabecera roja con icono de error -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="errorModalLabel">
          <i class="fas fa-exclamation-circle me-2"></i>¡Error!
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Cuerpo del modal -->
      <div class="modal-body text-center py-4">
        <div class="mb-3">
          <i class="fas fa-times-circle text-danger fa-4x"></i> 
        </div>
        <h4 class="mb-3 text-danger" id="errorSubtitle">Algo ha salido mal</h4>
        <p class="mb-0 text-muted" id="errorMessage"></p>
      </div>
      
      <!-- Footer con botón de acción -->
      <div class="modal-footer justify-content-center border-top-0">
        <button type="button" id="retryButton" class="btn btn-danger px-4" data-bs-dismiss="modal">
          <i class="fas fa-redo me-2"></i>Reintentar
        </button>
      </div>
    </div>
  </div>
</div>
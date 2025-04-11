<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="bi bi-mortarboard-fill me-2"></i> Historial Académico</h1>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-search me-2"></i> Buscar Estudiante
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="inputBusqueda" placeholder="Número de cuenta, nombre o apellido">
                    <button class="btn btn-primary" type="button" id="btnBuscar">
                        <i class="bi bi-search me-2"></i> Buscar
                    </button>
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="selectCarrera">
                    <option selected>Todas las carreras</option>
                    <option>Ingeniería en Sistemas</option>
                    <option>Medicina</option>
                    <option>Derecho</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div id="divhis">
    <div class="text-center my-4" id="loadingMsg" style="display: none;">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Cargando historial...</p>
    </div>
</div>

<link rel="stylesheet" href="../../../../assets/css/toastMessage.css">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-calendar-times me-2"></i> Cancelaciones Excepcionales</h1>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-filter me-2"></i> Filtros
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Estado</label>
                <select class="form-select">
                    <option selected>Todas</option>
                    <option>Pendientes</option>
                    <option>Aprobadas</option>
                    <option>Rechazadas</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Período</label>
                <select class="form-select">
                    <option selected>2023-1</option>
                    <option>2022-2</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Motivo</label>
                <select class="form-select">
                    <option selected>Todos</option>
                    <option>Salud</option>
                    <option>Económicos</option>
                    <option>Personales</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-list me-2"></i> Solicitudes
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Estudiante</th>
                        <th>Cuenta</th>
                        <th>Motivo</th>
                        <th>Secciones</th>
                        <th>Documento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id = "tablacancel">
                   
                </tbody>
            </table>
        </div>
        <div id='toast' class='toast'></div>
    </div>
</div>
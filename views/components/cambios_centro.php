<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-building me-2"></i> Solicitudes de Cambio de Centro</h1>
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
                <label class="form-label">Centro Origen</label>
                <select class="form-select">
                    <option selected>Todos</option>
                    <option>CU</option>
                    <option>UNAH-VS</option>
                    <option>UNAH-TEC Danlí</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Centro Destino</label>
                <select class="form-select">
                    <option selected>Todos</option>
                    <option>CU</option>
                    <option>UNAH-VS</option>
                    <option>UNAH-TEC Danlí</option>
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
                        <th>Centro Origen</th>
                        <th>Centro Destino</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Luis Alberto Fernández</td>
                        <td>2023-03456</td>
                        <td>UNAH-VS</td>
                        <td>CU</td>
                        <td>Cambio de residencia</td>
                        <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                        <td>
                            <button class="btn btn-sm btn-success me-1" title="Aprobar">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-sm btn-danger me-1" title="Rechazar">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Karla Patricia Martínez</td>
                        <td>2022-06789</td>
                        <td>CU</td>
                        <td>UNAH-TEC Danlí</td>
                        <td>Trabajo</td>
                        <td><span class="badge bg-success">Aprobado</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
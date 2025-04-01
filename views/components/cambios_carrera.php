<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-exchange-alt me-2"></i> Solicitudes de Cambio de Carrera</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button class="btn btn-primary me-2">
            <i class="fas fa-file-export me-2"></i> Exportar
        </button>
    </div>
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
                <label class="form-label">Carrera Origen</label>
                <select class="form-select">
                    <option selected>Todas</option>
                    <option>Ingeniería Industrial</option>
                    <option>Administración</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Carrera Destino</label>
                <select class="form-select">
                    <option selected>Todas</option>
                    <option>Ingeniería en Sistemas</option>
                    <option>Medicina</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-list me-2"></i> Solicitudes Recientes
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Estudiante</th>
                        <th>Cuenta</th>
                        <th>Carrera Actual</th>
                        <th>Carrera Solicitada</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Carlos Martínez</td>
                        <td>2023-01234</td>
                        <td>Ing. Industrial</td>
                        <td>Ing. en Sistemas</td>
                        <td>15/03/2023</td>
                        <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                        <td>
                            <button class="btn btn-sm btn-success me-1" title="Aprobar">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-sm btn-danger me-1" title="Rechazar">
                                <i class="fas fa-times"></i>
                            </button>
                            <button class="btn btn-sm btn-primary" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Ana Lucía Rodríguez</td>
                        <td>2022-05678</td>
                        <td>Derecho</td>
                        <td>Psicología</td>
                        <td>10/03/2023</td>
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
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
                <tbody>
                    <tr>
                        <td>Juan Carlos López</td>
                        <td>2023-04567</td>
                        <td>Problemas de salud</td>
                        <td>MAT-101 (Sección 1001), FIS-101 (Sección 1002)</td>
                        <td>
                            <a href="#" class="text-primary">
                                <i class="fas fa-file-pdf me-2"></i> Certificado.pdf
                            </a>
                        </td>
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
                        <td>María Fernanda García</td>
                        <td>2022-07890</td>
                        <td>Problemas económicos</td>
                        <td>QUI-101 (Sección 1003)</td>
                        <td>
                            <a href="#" class="text-primary">
                                <i class="fas fa-file-pdf me-2"></i> Carta.pdf
                            </a>
                        </td>
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
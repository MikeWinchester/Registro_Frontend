<!-- Vista de Solicitudes -->
<div class="tab-pane fade" id="solicitudes">
                        <div class="unah-header">
                            <i class="bi bi-envelope fs-1"></i>
                            <h2>Solicitudes Académicas</h2>
                        </div>
                        <div class="card unah-card">
                            <div class="card-header">
                                Gestión de Solicitudes
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="solicitudesTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="nueva-tab" data-bs-toggle="tab" data-bs-target="#nueva" type="button">Nueva Solicitud</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="historial-tab" data-bs-toggle="tab" data-bs-target="#historial" type="button">Historial</button>
                                    </li>
                                </ul>
                                <div class="tab-content p-3 border border-top-0 rounded-bottom">
                                    <div class="tab-pane fade show active" id="nueva">
                                        <form>
                                            <div class="mb-3">
                                                <label class="form-label">Tipo de Solicitud *</label>
                                                <select class="form-select">
                                                    <option value="">Seleccione un tipo...</option>
                                                    <option>Cambio de Carrera</option>
                                                    <option>Cancelación de Asignatura</option>
                                                    <option>Cambio de Centro</option>
                                                    <option>Rectificación de Nota</option>
                                                    <option>Otro</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Descripción Detallada *</label>
                                                <textarea class="form-control" rows="5" placeholder="Describa su solicitud con detalle..." required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Adjuntar Documentos (Opcional)</label>
                                                <input type="file" class="form-control">
                                                <small class="text-muted">Formatos aceptados: PDF, JPG, PNG (Máx. 2MB)</small>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-unah">Enviar Solicitud</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="historial">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Tipo</th>
                                                        <th>Detalle</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>10/05/2023</td>
                                                        <td>Cambio de Carrera</td>
                                                        <td>Solicitud para cambiar a Ingeniería Industrial</td>
                                                        <td><span class="badge bg-warning">En revisión</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-unah-outline">Ver</button>
                                                            <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>15/03/2023</td>
                                                        <td>Cancelación</td>
                                                        <td>Cancelación de asignatura Física General</td>
                                                        <td><span class="badge bg-success">Aprobada</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-unah-outline">Ver</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>20/11/2022</td>
                                                        <td>Cambio de Centro</td>
                                                        <td>Traslado a UNAH-TEC Danlí</td>
                                                        <td><span class="badge bg-secondary">Rechazada</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-unah-outline">Ver</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
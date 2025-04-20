<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-chart-bar me-2"></i> Reportes</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button class="btn btn-primary me-2">
            <i class="fas fa-file-export me-2"></i> Exportar
        </button>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-filter me-2"></i> Generar Reporte
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de Reporte</label>
                    <select class="form-select" required>
                        <option value="">Seleccione...</option>
                        <option>Cambios de carrera</option>
                        <option>Cancelaciones</option>
                        <option>Cambios de centro</option>
                        <option>Matrículas por carrera</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search me-2"></i> Generar
            </button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-chart-pie me-2"></i> Estadísticas
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container" style="height: 300px;">
                    <canvas id="cambiosChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container" style="height: 300px;">
                    <canvas id="cancelacionesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-table me-2"></i> Datos del Reporte
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Carrera</th>
                        <th>Solicitudes</th>
                        <th>Aprobadas</th>
                        <th>Rechazadas</th>
                        <th>% Aprobación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ingeniería en Sistemas</td>
                        <td>45</td>
                        <td>32</td>
                        <td>13</td>
                        <td>71%</td>
                    </tr>
                    <tr>
                        <td>Medicina</td>
                        <td>28</td>
                        <td>15</td>
                        <td>13</td>
                        <td>54%</td>
                    </tr>
                    <tr>
                        <td>Derecho</td>
                        <td>36</td>
                        <td>22</td>
                        <td>14</td>
                        <td>61%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Este script se cargará automáticamente cuando la vista se active
document.addEventListener('view-loaded', function() {
    // Gráfico de cambios de carrera
    const cambiosCtx = document.getElementById('cambiosChart').getContext('2d');
    new Chart(cambiosCtx, {
        type: 'bar',
        data: {
            labels: ['Ing. Sistemas', 'Medicina', 'Derecho', 'Psicología'],
            datasets: [{
                label: 'Solicitudes',
                data: [45, 28, 36, 22],
                backgroundColor: '#002855'
            }]
        }
    });

    // Gráfico de cancelaciones
    const cancelacionesCtx = document.getElementById('cancelacionesChart').getContext('2d');
    new Chart(cancelacionesCtx, {
        type: 'pie',
        data: {
            labels: ['Salud', 'Económicos', 'Personales', 'Otros'],
            datasets: [{
                data: [120, 85, 45, 30],
                backgroundColor: [
                    '#002855',
                    '#ffcc00',
                    '#d22630',
                    '#28a745'
                ]
            }]
        }
    });
});
</script>
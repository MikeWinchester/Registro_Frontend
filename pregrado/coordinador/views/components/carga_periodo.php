<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-calendar-alt me-2"></i> Carga del Período Académico</h1>
</div>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-file-export me-2"></i> Exportar Datos
    </div>
    <div class="card-body">
        <button class="btn btn-primary me-2" id="btnExportarPDF">
            <i class="fas fa-file-pdf me-2"></i> Exportar a PDF
        </button>
        <button class="btn btn-success" id="btnExportarCSV">
            <i class="fas fa-file-excel me-2"></i> Exportar a Excel
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-table me-2"></i> Secciones Académicas
    </div>
    <div class="card-body" id = "tablaPDF">
        <div class="table-responsive">
            <table class="table table-hover" >
                <thead class="table-dark">
                    <tr>
                        <th>N° Sección</th>
                        <th>Código</th>
                        <th>Asignatura</th>
                        <th>Docente</th>
                        <th>Edificio</th>
                    </tr>
                </thead>
                <tbody id = "tablaSecciones">
                </tbody>
            </table>
        </div>
    </div>
</div>

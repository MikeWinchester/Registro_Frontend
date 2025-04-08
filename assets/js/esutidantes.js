document.addEventListener('DOMContentLoaded', function() {
    // Cargar vista inicial
    loadView('estudiante_perfil.php');
    
    // Configurar eventos del sidebar
    document.querySelectorAll('.sidebar-option').forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            const page = this.getAttribute('data-page');
            loadView(page);
            
            // Actualizar estado activo
            document.querySelectorAll('.sidebar-option').forEach(el => {
                el.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
    
    // Toggle sidebar en móviles
    const navbarToggler = document.querySelector('.navbar-toggler');
    if (navbarToggler) {
        navbarToggler.addEventListener('click', function() {
            document.querySelector('.sidebar-container').classList.toggle('show');
        });
    }
});

function loadView(page) {
    const mainContent = document.getElementById('main-content');
    
    // Mostrar spinner de carga
    mainContent.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    `;
    
    // Cargar la vista correspondiente
    fetch(`/views/components/${page}`)

        .then(response => {
            console.log(page);
            if (!response.ok) {
                throw new Error('Vista no encontrada');
            }
            return response.text();
        })
        .then(html => {
            mainContent.innerHTML = html;
        })
        .catch(error => {
            console.error('Error al cargar la vista:', error);
            mainContent.innerHTML = `
                <div class="alert alert-danger m-4">
                    <h4><i class="fas fa-exclamation-triangle me-2"></i> Error al cargar la vista</h4>
                    <p>No se pudo cargar el contenido solicitado.</p>
                    <button class="btn btn-primary mt-2" onclick="loadView('carga_periodo.php')">
                        <i class="fas fa-home me-1"></i> Volver al inicio
                    </button>
                </div>
            `;
        });
}

import { obtenerSecciones, obtenerSolicitudes, obtenerHistorial, obtenerSolicitudesCentro, obtenerSolicitudesCancel } from "./coodinadorcontroller.js";


    // Cargar vista inicial
    loadView('carga_periodo.php');
    
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


async function loadView(page) {
    const mainContent = document.getElementById('main-content');

    mainContent.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
    `;
    
    await fetch(`components/${page}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Vista no encontrada');
            }
            return response.text();
        })
        .then(html => {
            mainContent.innerHTML = html;

            // Ejecuta el controlador específico si es necesario
            if (page === 'carga_periodo.php') {
                obtenerSecciones();
            }
            if (page === 'cambios_carrera.php') {
                obtenerSolicitudes();
            }
            if (page === 'historial_estudiantes.php') {
                obtenerHistorial();
            }
            if (page === 'cambios_centro.php') {
                obtenerSolicitudesCentro();
            }
            if (page === 'cancelaciones.php') {
                obtenerSolicitudesCancel();
            }
        })
        .catch(error => {
            console.error('Error al cargar la vista:', error);
            mainContent.innerHTML = `
                <div class="alert alert-danger m-4">
                    <h4><i class="fas fa-exclamation-triangle me-2"></i> Error al cargar la vista</h4>
                    <p>No se pudo cargar el contenido solicitado.</p>
                    <button class="btn btn-primary mt-2" onclick="loadView('/views/components/carga_periodo.php')">
                        <i class="fas fa-home me-1"></i> Volver al inicio
                    </button>
                </div>
            `;
        });
}



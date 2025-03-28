import loadEnv from "./getEnv.mjs";
const env = await loadEnv();

    const submitBtn = document.getElementById('submit-btn');
    const numeroSolicitud = document.getElementById('numeroSolicitud');
    const resultadoDiv = document.getElementById('resultado');
    const btnText = document.getElementById('btn-text');
    
    submitBtn.addEventListener('click', function() {
        const solicitudId = numeroSolicitud.value.trim();
        
        if (!solicitudId) {
            showAlert('Por favor ingresa un número de solicitud válido', 'danger');
            return;
        }
        
        const loadingElement = document.getElementById("loading");
        const timeoutMessage = document.querySelector(".timeout-message");

        // Limpiar resultados anteriores
        resetSolicitudDetails();

        // Mostrar loading
        loadingElement.style.display = "flex";
        timeoutMessage.style.display = "none";
        
        // Timeout para peticiones lentas (5 segundos)
        const timeout = setTimeout(() => {
            timeoutMessage.style.display = "block";
        }, 5000);
        
        // Hacer la petición al endpoint
        fetch(`${env.API_URL}/solicitudes/${encodeURIComponent(solicitudId)}/estado`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.solicitud) {
                    updateSolicitudDetails(data.solicitud);
                    showAlert(`Solicitud #${solicitudId} encontrada`, 'success');
                } else {
                    showAlert(data.message || `No se encontró la solicitud #${solicitudId}`, 'warning');
                }
            })
            .catch(error => {
                showAlert(`Error al buscar la solicitud: ${error.message}`, 'danger');
                console.error('Error:', error);
            })
            .finally(() => {
                // Restaurar estado del botón
                loadingElement.style.display = "none";
                clearTimeout(timeout);
            });
    });
    
    function updateSolicitudDetails(solicitud) {
        // Actualizar información básica
        document.getElementById('solicitud-numero').textContent = solicitud.numero;
        document.getElementById('nombre-completo').textContent = solicitud.nombre;
        document.getElementById('documento-numero').textContent = solicitud.documento;
        document.getElementById('correo-electronico').textContent = solicitud.correo;
        document.getElementById('telefono-numero').textContent = solicitud.telefono;
        document.getElementById('centro-regional').textContent = solicitud.centro;
        document.getElementById('carrera-principal').textContent = solicitud.carrera1;
        document.getElementById('carrera-secundaria').textContent = solicitud.carrera2;
        
        // Actualizar certificado
        const certificadoElement = document.getElementById('certificado-secundaria');
        certificadoElement.innerHTML = solicitud.certificado ? 
            '<span class="badge bg-success">Cargado</span>' : 
            '<span class="badge bg-secondary">No cargado</span>';
        
        // Actualizar estado
        const statusElement = document.getElementById('solicitud-status');
        statusElement.className = 'status-badge';
        statusElement.classList.add(`status-${solicitud.estado}`);
        statusElement.textContent = solicitud.estado.charAt(0).toUpperCase() + solicitud.estado.slice(1);
        
        // Crear o actualizar sección de observaciones
        let observacionesSection = document.querySelector('.observaciones-section');
        
        if (!observacionesSection) {
            observacionesSection = document.createElement('div');
            observacionesSection.className = 'mt-4 pt-3 border-top observaciones-section';
            document.querySelector('.solicitud-card').appendChild(observacionesSection);
        }
        
        observacionesSection.innerHTML = `
            <h5 class="mb-3"><i class="bi bi-chat-left-text me-2"></i>Observaciones</h5>
            <div class="alert ${solicitud.observaciones ? 'alert-info' : 'alert-secondary'}">
                ${solicitud.observaciones || 'No hay observaciones disponibles'}
            </div>
        `;
    }
    
    function resetSolicitudDetails() {
        // Restablecer valores por defecto
        document.getElementById('solicitud-numero').textContent = '-----';
        document.getElementById('nombre-completo').textContent = '---';
        document.getElementById('documento-numero').textContent = '---';
        document.getElementById('correo-electronico').textContent = '---';
        document.getElementById('telefono-numero').textContent = '---';
        document.getElementById('centro-regional').textContent = '---';
        document.getElementById('carrera-principal').textContent = '---';
        document.getElementById('carrera-secundaria').textContent = '---';
        document.getElementById('certificado-secundaria').innerHTML = '<span class="badge bg-secondary">No cargado</span>';
        
        // Restablecer estado
        const statusElement = document.getElementById('solicitud-status');
        statusElement.className = 'status-badge status-pendiente';
        statusElement.textContent = 'No encontrada';
        
        // Restablecer observaciones
        const observacionesSection = document.querySelector('.observaciones-section');
        if (observacionesSection) {
            observacionesSection.innerHTML = `
                <h5 class="mb-3"><i class="bi bi-chat-left-text me-2"></i>Observaciones</h5>
                <div class="alert alert-secondary">No hay observaciones disponibles</div>
            `;
        }
    }
    
    function showAlert(message, type) {
        resultadoDiv.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    }
    
    // Opcional: Permitir búsqueda al presionar Enter
    numeroSolicitud.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            submitBtn.click();
        }
    });

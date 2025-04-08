
            <!-- Main Content -->

    <!-- Vista de Chat -->
    <div class="tab-pane fade" id="chat">
        <div class="unah-header">
            <i class="bi bi-chat-dots fs-1"></i>
            <h2>Chat Universitario</h2>
        </div>
        <div class="card unah-card">
            <div class="card-header">
                Mensajería Instantánea
            </div>
            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-md-4 border-end">
                        <div class="p-3 border-bottom">
                            <input type="text" class="form-control" placeholder="Buscar contactos...">
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">María García</h5>
                                    <small>Hoy</small>
                                </div>
                                <p class="mb-1">¿Vamos a estudiar mañana?</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Carlos Martínez</h5>
                                    <small class="text-muted">Ayer</small>
                                </div>
                                <p class="mb-1">Te envié los apuntes</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Ana Rodríguez</h5>
                                    <small class="text-muted">Lunes</small>
                                </div>
                                <p class="mb-1">Reunión del grupo</p>
                            </a>
                        </div>
                        <div class="p-3">
                            <button class="btn btn-unah w-100" data-bs-toggle="modal" data-bs-target="#solicitudAmistadModal">
                                <i class="bi bi-person-plus"></i> Nueva Conexión
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex flex-column" style="height: 500px;">
                            <div class="p-3 border-bottom">
                                <h4 class="mb-0">María García</h4>
                                <small class="text-muted">En línea</small>
                            </div>
                            <div class="flex-grow-1 p-3 overflow-auto" style="background-color: #f9f9f9;">
                                <div class="message mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <strong>María García</strong>
                                        <small class="text-muted">10:30 AM</small>
                                    </div>
                                    <div class="p-3 bg-white rounded">
                                        Hola Juan, ¿cómo estás?
                                    </div>
                                </div>
                                <div class="message mb-3 text-end">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="text-muted">10:32 AM</small>
                                        <strong>Tú</strong>
                                    </div>
                                    <div class="p-3 bg-primary text-white rounded">
                                        ¡Hola María! Bien, ¿y tú?
                                    </div>
                                </div>
                                <div class="message mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <strong>María García</strong>
                                        <small class="text-muted">10:33 AM</small>
                                    </div>
                                    <div class="p-3 bg-white rounded">
                                        Bien también. ¿Vamos a estudiar mañana para el examen de matemáticas?
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Escribe un mensaje...">
                                    <button class="btn btn-unah">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- Modal Solicitud Amistad -->
 <div class="modal fade" id="solicitudAmistadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-unah-blue text-white">
                <h5 class="modal-title">Nueva Conexión</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Buscar Estudiante</label>
                        <input type="text" class="form-control" placeholder="Número de cuenta o nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensaje (Opcional)</label>
                        <textarea class="form-control" rows="3" placeholder="Escribe un mensaje de presentación..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-unah">Enviar Solicitud</button>
            </div>
        </div>
    </div>
</div>

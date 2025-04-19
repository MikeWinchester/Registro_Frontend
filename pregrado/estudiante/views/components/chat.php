<?php
include('../../components/navbar.php');
session_start();

$allowedRoles = ['Estudiante', 'Docente'];
$userRoles = $_SESSION['user_roles'] ?? [];

if (empty($userRoles)) {
    header('Location: ../../login/index.php');
    exit;
}

if (!array_intersect($allowedRoles, $userRoles)) {
    die(header('Location: ../../login/forbidden.php'));
}
?>
<!DOCTYPE html>
<html lang="es" user-id='<?php echo $_SESSION['user_id']?>' user-name='<?php echo $_SESSION['user_name']?>' >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Universitario - Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/chat.css">
    <link rel="stylesheet" href="../../../../assets/css/toastMessage.css">
    <style>
    .perfil-img {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-picture {
        width: 70px;        /* Tamaño más pequeño */
        height: 70px;
        object-fit: cover;
        border-radius: 50%; /* Redondear completamente */
    }

    
    .contacts-list {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .contact-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    }

    .contact-name {
        font-weight: bold;
    }

    .contact-preview {
        font-size: 0.9rem;
        color: #555;
    }


    </style>
      
</head>
<body>
  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Portal Universitario</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="../dashboard.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/profile.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/chat.php">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/grades.php">Notas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/requests.php">Trámites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../components/estudiante.php">
                            <i class="fas fa-tasks me-1"></i>Secciones
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="user-avatar"><?php echo substr($_SESSION['user_name'], 0, 2); ?></div>
                        <span class="text-light me-3" id="userName"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <button class="btn btn-outline-light" id="logoutBtn">
                            <i class="fas fa-sign-out-alt me-1"></i>Salir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            
            <div class="col-md-4">
                <div class="chat-sidebar">
                    <div class="chat-tabs">
                        <button class="chat-tab active" data-tab="contacts">Contactos</button>
                        <button class="chat-tab" data-tab="groups">Grupos</button>
                    </div>

                    <div class="tab-content active" id="contacts-tab">
                        <div class="search-box">
                            <input type="text" placeholder="Buscar contactos..." class="form-control">
                        </div>
                        <div class="contacts-list" id="lista-contactos">
                            <div id="loader-area-lista" class="text-center mt-2" style="display: none;">
                                <div class="spinner-border text-primary" role="status">

                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div class="tab-content" id="groups-tab">
                        <button class="btn btn-dark w-100 mb-3" id="createGroupBtn">Crear Nuevo Grupo</button>
                        <div class="groups-list">
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="chat-container">
                    <div class="chat-header">
                        <div class="chat-title-container" id="title-chat">
                        
                        </div>
                        <button class="btn btn-outline-dark btn-sm" id="viewProfileBtn" disabled>Ver Perfil</button>
                        <button class="btn btn-outline-dark btn-sm" id="addUser">Agregar usuario</button>
                        <button class="btn btn-outline-dark btn-sm" id="viewsSolicitud">Ver solicitudes</button>
                        <button class="btn btn-outline-dark btn-sm" id="viewsFriends">Ver amigos</button>
                    </div>

                    <div id="chat-messages" class="chat-messages">
                    <div id="loader-area-chat" class="text-center mt-2" style="display: none;">
                                <div class="spinner-border text-primary" role="status">

                                </div>
                            </div>
                    </div>

                    <div class="chat-input">
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" id="attachFileBtn">
                                <i class="fas fa-paperclip"></i>
                                <input type="file" id="fileInput" class="d-none">
                            </button>
                            <input disabled ="text" id="mensajeInput" class="form-control" placeholder="Escribe tu mensaje">
                            <button disabled id="btnEnviar" class="btn btn-dark">Enviar</button>
                        </div>
                    </div>
                </div>
                <div id="toast" class="toast">

    </div>  
            </div>
        </div>
    </div>
    

   
    <!-- Modal para crear grupo -->
    <div class="modal fade" id="createGroupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Nuevo Grupo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="groupForm">
                        <div class="mb-3">
                            <label for="groupName" class="form-label">Nombre del Grupo</label>
                            <input type="text" class="form-control" id="groupName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Agregar Miembros</label>
                            <div class="group-members-select">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="member1">
                                    <label class="form-check-label" for="member1">
                                        <img src="https://via.placeholder.com/30?text=MG" alt="María González" class="member-avatar">
                                        María González
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="member2">
                                    <label class="form-check-label" for="member2">
                                        <img src="https://via.placeholder.com/30?text=CR" alt="Carlos Rodríguez" class="member-avatar">
                                        Carlos Rodríguez
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="3" id="member3">
                                    <label class="form-check-label" for="member3">
                                        <img src="https://via.placeholder.com/30?text=AM" alt="Ana Martínez" class="member-avatar">
                                        Ana Martínez
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="groupForm" class="btn btn-dark">Crear Grupo</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver perfil -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-h5"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="profile-view">
                        <div class="profile-picture-container text-center mb-4">
                        <img id="perfil" src="" alt="María González" class="profile-picture rounded-circle">
                        </div>
                        <div class="profile-info">
                            <div class="info-field">
                                <label>Número de Cuenta</label>
                                <div class="info-value" id="cuenta"></div>
                            </div>
                            <div class="info-field">
                                <label>Carrera</label>
                                <div class="info-value" id="carrera"></div>
                            </div>
                            <div class="info-field">
                                <label>Acerca de</label>
                                <div class="info-value" id="desc" ></div>
                            </div>
                            <div class="info-field">
                                <label>Galeria</label>
                                <div class="info-value" id="galeria">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImagen" tabindex="-1" aria-labelledby="modalImagenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <img id="imagenAmpliada" src="" class="w-100" alt="Vista previa">
        </div>
    </div>
    </div>

    <!--Modal para mandar solicitud-->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" id="accountNumber" placeholder="Ingrese número de cuenta" required>
                        <button class="btn btn-dark" id="seach-user" id="searchUserBtn">Buscar</button>
                    </div>
                    
                    <div id="userInfoSection" style="display: none;">
                        <h6 class="mt-3 mb-2">Información del usuario:</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>N° Cuenta</th>
                                        <th>Nombre</th>
                                        <th>Carrera</th>
                                    </tr>
                                </thead>
                                <tbody id="userInfoTable">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-success" id="sendRequestBtn">Enviar solicitud</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Modal para solicitudes pendientes -->
    <div class="modal fade" id="pendingRequestsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Solicitudes Pendientes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Usuario</th>
                                    <th>N° Cuenta</th>
                                    <th>Carrera</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="pendingRequestsTable">
                                <!-- Ejemplo de fila (se llenará dinámicamente) -->
                                
                                <!-- Más filas se agregarán aquí dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para ver lista de amigos -->
    <div class="modal fade" id="friendsListModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mis Amigos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Lista de amigos -->
                    <div class="list-group" id="friendsListContainer">
                        
                        
                        <!-- Más amigos aparecerán aquí dinámicamente -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

   
    <footer class="py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">
                <i class="fas fa-university me-1"></i> © 2025 Universidad  Todos los derechos reservados.
            </p>
            <div class="mt-2">
                <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/chat.js"></script>
</body>
</html>
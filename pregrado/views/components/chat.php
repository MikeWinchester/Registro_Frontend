<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Universitario - Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/chat.css">

      
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
                </ul>
                <div class="d-flex align-items-center">
                    <span class="text-light me-3" id="userName">Juan Pérez</span>
                    <button class="btn btn-outline-light" id="logoutBtn">Salir</button>
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
            </div>
        </div>
    </div>

   
    <div class="modal fade" id="createGroupModal" tabindex="-1" aria-hidden="true">
        
    </div>

    <div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
       
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
       
    </div>

    <div class="modal fade" id="pendingRequestsModal" tabindex="-1" aria-hidden="true">
    
    </div>

    <div class="modal fade" id="friendsListModal" tabindex="-1" aria-hidden="true">
        
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
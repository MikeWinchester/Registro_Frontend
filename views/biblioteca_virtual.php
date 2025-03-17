<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #0033a0, #ffcc00);
            color: white;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #002b80;
            padding: 15px;
        }
        .card {
            background: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3 text-white">
            <h3>Menú</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link text-white">Inicio</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Libros</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Categorías</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#addBookModal">Agregar Libro</a></li>
            </ul>
        </div>
        <div class="container mt-4">
            <h1 class="text-center">Biblioteca Virtual</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Título del Libro</h5>
                        <p>Autor: Autor del Libro</p>
                        <p>Tags: #Educación #Tecnología</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#readBookModal">Leer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Agregar Libro -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Autor</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Archivo PDF</label>
                            <input type="file" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Leer Libro -->
    <div class="modal fade" id="readBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Leyendo Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <iframe src="sample.pdf" width="100%" height="500px"></iframe>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

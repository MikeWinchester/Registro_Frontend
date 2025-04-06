<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secciones Programadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href="/assets/css/modal.css">
</head>
<body>
    


  <!-- Secciones Programadas-->

  <div class="container mt-4">
  <h2><i class="fas fa-chalkboard-teacher"></i>Secciones Programadas</h2><br>


<div id="clasesAccordion" class="accordion">
    
    <div class="accordion-item" id='class-container'>
        <p>Cargando...</p>
    </div>
    <div id="loader-secciones" class="text-center mt-2" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            
        </div>
    </div>
</div>


<div id="Modal" class="modal">
  <div class="modal-content">
    <h2>¡Hola!</h2>
    <p>Esta es una ventana modal sencilla.</p>
    <button id='btn-1'>Enviar</button>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
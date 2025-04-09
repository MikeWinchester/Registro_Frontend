<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma 03</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    
   
    
</head>
<body>

<style>
       

 /*.container {
    width: 75%;
    max-width: 900px;
    background-color:rgb(78, 17, 17);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
    margin-top: 15%;
    max-height: 100vh;
    }*/



    :root {
    --azul-oscuro: #2c5282;
    --azul-medio: #4299e1;
    --azul-claro: #ebf8ff;
    --gris-claro: #f8fafc;
    --gris-medio: #e2e8f0;
    --texto-oscuro: #1a202c;
    --texto-medio: #4a5568;
}

.card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    background-color: white;
    border-top: 4px solid var(--azul-medio);
    padding: 30px;
}

.card-header {
    background-color: white;
    color: var(--texto-oscuro);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--gris-medio);
}



.card-title {
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--texto-oscuro);
}

        h2, h3 {
            text-align: center;
            color: #333;
        }

        .info-container {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }

        .info-container p {
            margin: 5px 0;
            font-size: 12px;
        }

        .info-container .photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #ddd;
            margin-right: 20px;
        }

        .table-container {
            margin-top: 20px;
        }

        .table th {
            background-color: #4A90E2;
            color: white;
            text-align: center;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

</style>




<div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="bi bi-calendar title-icon"></i>
                 Asignaturas Matriculadas
                </h4>
            </div>



        <div class="info-container">
        
        <div class="photo" style="background-image: url('https://via.placeholder.com/120'); background-size: cover; background-position: center;"></div>
        <div style="text-align: center; width: 100%;" >
    
            <h3>Información del Estudiante</h3><br>
            <div class="row justify-content-center" id='divPersonal'>
            
                
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código de Asignatura</th>
                    <th>Asignatura</th>
                    <th>Seccion</th>
                    <th>HI</th>
                    <th>HF</th>
                    <th>Dias</th>
                    <th>Edificio</th>
                    <th>Aula</th>
                    <th>UV</th>
                    <th>Período</th>
                  
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody id='tableMain'>
                
            </tbody>
        </table>
    </div>
       </div>

</div>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
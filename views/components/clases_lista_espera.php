<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de espera </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    

<style>

.table {
    margin-top: 20px;
}
.table th {
    background-color:rgb(3, 117, 239); 
    color: white;
    text-align: center;
}
.table td {
    text-align: center;
}
</style>




<div class="container mt-4">
    <div class="col-md-12 mt-4">
        <div class="card p-4 shadow">
            <h4 class="text-center">Listas de Espera</h4>
            <table class="table  table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Clase</th>
                        <th>Seccion</th>
                        <th>Edificio</th>
                        <th>Aula</th>
                        <th>Periodo</th>
                        <th>N. Espera</th>
                    </tr>
                </thead>
                <tbody id='body-table'>
                    
                </tbody>
            </table>
        </div>
        <div id="loader-espera" class="text-center mt-2" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
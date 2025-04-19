import loadEnv from "../../../../assets/js/getEnv.mjs";
const env = await loadEnv();

const endpointultimanota = `${env.API_URL}/estudiante/get/last/clases`;
const endpointindiceperiodo = `${env.API_URL}/estudiante/get/indices`;
const endpointlastmessages = `${env.API_URL}/mensaje/last/user`;
const endpointclasesactuales = `${env.API_URL}/matricula/get/estu`;

document.addEventListener('DOMContentLoaded', function() {
    // Simular descarga de certificado
    const downloadCertBtn = document.getElementById('downloadCertBtn');
    if (downloadCertBtn) {
        downloadCertBtn.addEventListener('click', function() {
            // Crear un PDF simulado
            const pdfContent = `
                <html>
                    <head>
                        <title>Certificado Académico</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            .header { text-align: center; margin-bottom: 30px; }
                            .logo { width: 150px; }
                            h1 { color: #2c3e50; }
                            .student-info { margin: 20px 0; }
                            .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                            .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            .table th { background-color: #f2f2f2; }
                            .footer { margin-top: 50px; text-align: right; font-size: 0.8em; color: #777; }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <img src="https://via.placeholder.com/150x80?text=Universidad" alt="Logo Universidad" class="logo">
                            <h1>Certificado Académico</h1>
                        </div>
                        
                        <div class="student-info">
                            <p><strong>Nombre:</strong> Juan Pérez</p>
                            <p><strong>Número de Cuenta:</strong> 202310001</p>
                            <p><strong>Carrera:</strong> Ingeniería en Sistemas</p>
                            <p><strong>Índice Académico:</strong> 3.8</p>
                        </div>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Clase</th>
                                    <th>Créditos</th>
                                    <th>Nota</th>
                                    <th>Período</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Programación I</td>
                                    <td>4</td>
                                    <td>92</td>
                                    <td>2022-2</td>
                                </tr>
                                <tr>
                                    <td>Matemáticas I</td>
                                    <td>5</td>
                                    <td>85</td>
                                    <td>2022-2</td>
                                </tr>
                                <tr>
                                    <td>Física</td>
                                    <td>4</td>
                                    <td>78</td>
                                    <td>2022-1</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="footer">
                            <p>Emitido el: ${new Date().toLocaleDateString()}</p>
                            <p>Este documento es válido solo con el sello de la universidad</p>
                        </div>
                    </body>
                </html>
            `;
            
            // Crear un blob con el contenido HTML
            const blob = new Blob([pdfContent], { type: 'text/html' });
            const url = URL.createObjectURL(blob);
            
            // Crear un enlace temporal para la descarga
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Certificado_Academico_Juan_Perez.html';
            document.body.appendChild(a);
            a.click();
            
            // Limpiar
            setTimeout(() => {
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }, 100);
            
            alert('Certificado descargado (simulación). En un sistema real, se generaría un PDF real.');
        });
    }
});


async function getIndiceDash(){
    const div = document.querySelector('#div-indice');
    div.innerHTML = '';

    await fetch(`${endpointindiceperiodo}/${localStorage.getItem('estudiante')}`, {
        method : "GET",
        headers : {
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {

        let info = '';

        if (result.message) {
            const data = result.data;
            info = `<span class="gpa-value">${data.indice_periodo}</span>
                    <span class="gpa-label">Indice global: ${data.indice_global}</span>`;
        } else {
            
            info = `<span class="gpa-value">0</span>
                    <span class="gpa-label">---</span>`;
        }

        div.innerHTML += info;

    })


}

async function ultimasNotas(){
    const div_notas = document.querySelector('#grade-summary');

    await fetch(`${endpointultimanota}/${localStorage.getItem('estudiante')}`, {
        method : "GET",
        headers : {
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {

        div_notas.innerHTML = ' ';
        if(result.message){

            result.data.forEach(notas => {
                const nota = `<div class="grade-item">
                                    <div class="grade-course">
                                        <i class="fas fa-laptop-code me-1 text-primary"></i>${notas.nombre}
                                    </div>
                                    <div class="grade-value">${notas.calificacion}%</div>
                                </div>`;

                div_notas.innerHTML += nota;
            });

            div_notas.innerHTML += ` <a href="../views/components/grades.php" class="btn btn-outline-dark w-100 mt-3">
                                            <i class="fas fa-arrow-right me-1"></i>Ver todas las notas
                                        </a>`;

        }

    })
}

async function ultimosMensaje() {
    const div_mensajes = document.querySelector('#messages-preview');

    await fetch(`${endpointlastmessages}/${localStorage.getItem('estudiante')}`, {
        method : "GET",
        headers : {
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(result => {  
        
        div_mensajes.innerHTML = '';
        if(result.message){

            result.data.forEach(mensaje => {
                
                const mensajes = `  <div class="message-preview">
                                        <div class="d-flex justify-content-between">
                                            <div class="message-sender">${mensaje.remitente}</div>
                                            <div class="message-time">${mensaje.fecha_envio}</div>
                                        </div>
                                        <div class="message-content">${mensaje.mensaje}</div>
                                    </div>`; 

                div_mensajes.innerHTML += mensajes;
               

            });

        }else{
            div_mensajes.innerHTML += 'No hay mensajes disponibles';
        }

        div_mensajes.innerHTML += ` <a href="../views/components/chat.php" class="btn btn-outline-dark w-100 mt-3">
                                        <i class="fas fa-arrow-right me-1"></i>Ver todos los mensajes
                                    </a>`

    })
}

async function clasesActuales(){
    const table_clase = document.querySelector('#body-clases');

    await fetch(`${endpointclasesactuales}/${localStorage.getItem('estudiante')}`, {
        method : "GET",
        headers : {

        }
    }).then(response => response.json())
    .then(result => {

        table_clase.innerHTML = '';
        if(result.message){
        
            result.data.forEach(clase => {

                const clases = `<tr>
                                    <td>${clase.nombre}</td>
                                    <td>${clase.docente}</td>
                                    <td>${clase.dias} ${clase.horario}</td>
                                    <td><span class="badge bg-primary">${clase.edificio}-${clase.aula}</span></td>
                                </tr>`;

                table_clase.innerHTML += clases;

            });

        }else{
            table_clase.innerHTML = 'No hay clases matriculadas';
        }

    })
}

async function startDash(){
    await getIndiceDash();
    await ultimasNotas();
    await ultimosMensaje();
    await clasesActuales();
}

startDash();
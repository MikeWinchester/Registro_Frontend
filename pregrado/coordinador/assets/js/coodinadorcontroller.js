import loadEnv from "../../../../assets/js/getEnv.mjs";
import { showToast } from "../../../../assets/js/toastMessage.mjs";

const env = await loadEnv();

// Controlador JS
async function obtenerSecciones() {
    console.log("fetching")
    await fetch(`${env.API_URL}/secciones/dep/all`, {
        method: 'GET', // Es un GET sin necesidad de parámetros
        headers : {
             "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error al obtener las secciones:', data.error);
        } else {
            console.log('Secciones obtenidas:', data.data);
            mostrarSecciones(data.data); // Llamamos a la función para mostrar las secciones
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
}

function obtenerSolicitudes() {
    console.log("fetching")
    fetch(`${env.API_URL}/solicitud/cambio`, {
        method: 'GET', // Es un GET sin necesidad de parámetros
        "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
    })
    .then(response => response.json())
    .then(data => {
        
        
        if (data.error) {
            console.error('Error al obtener', data.error);
        } else {
            console.log('Obtenidas:', data.data);
            mostrarSolicitudes(data.data);
        }
    })
    .catch(error => {

    });
}

function obtenerSolicitudesCentro() {
    console.log("fetching")
    fetch(`${env.API_URL}/solicitudcentro/cambio`, {
        method: 'GET', // Es un GET sin necesidad de parámetros
        "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error al obtener', data.error);
        } else {
            console.log('Obtenidas:', data.data);
            mostrarCambiosCentro(data.data);
        }
    })
    .catch(error => {

    });
}

function obtenerSolicitudesCancel() {
    console.log("fetching")
    fetch(`${env.API_URL}/can/solicitud`,{
        method: 'GET', // Es un GET sin necesidad de parámetros
        "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error al obtener', data.error);
        } else {
            console.log('Obtenidas:', data.data);
            mostrarCambiosCancel(data.data);
        }
    })
    .catch(error => {

    });
}


// Función para mostrar las secciones en una tabla
function mostrarSecciones(secciones) {
    const tabla = document.getElementById('tablaSecciones'); // Asegúrate de tener una tabla en el HTML
    //tabla.innerHTML = ''; // Limpiamos cualquier dato previo de la tabla

    // Creando las filas para la tabla
    secciones.forEach(seccion => {
        const fila = document.createElement('tr');

        fila.innerHTML = `
            <td>${seccion.seccion_id}</td>
            <td>${seccion.codigo}</td>
            <td>${seccion.nombre}</td>
            <td>${seccion.nombre_completo}</td>
            <td>${seccion.edificio}</td>
        `;

        tabla.appendChild(fila);
    });
}

function mostrarCambiosCentro(centro) {
    const tabla = document.getElementById('tablacarrera'); // Asegúrate de tener una tabla en el HTML
    //tabla.innerHTML = ''; // Limpiamos cualquier dato previo de la tabla

    // Creando las filas para la tabla
    centro.forEach(centro => {
        const fila = document.createElement('tr');
        console.log("SIMONA LA MONA")

        fila.innerHTML = `
            <td>${centro.nombre_completo}</td>
            <td>${centro.numero_cuenta}</td>
            <td>${centro.centro_actual}</td>
            <td>${centro.centro_solicitada}</td>
            <td>${centro.fechaInscripcion}</td>
            <td>${centro.estado}</td>
            <td>
                <button class="btn btn-success btn-sm me-1" onclick="responderSolicitudCentro('${centro.numero_cuenta}', 'Aprobada')">Aceptar</button>
                <button class="btn btn-danger btn-sm" onclick="responderSolicitudCentro('${centro.numero_cuenta}', 'Rechazada')">Rechazar</button>
            </td>
            `;

        tabla.appendChild(fila);
    });
}

function mostrarCambiosCancel(cancel) {
    const tabla = document.getElementById('tablacancel');
    tabla.innerHTML = ''; // Limpia la tabla si es necesario

    cancel.forEach(item => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${item.nombre_completo}</td>
            <td>${item.numero_cuenta}</td>
            <td>${item.motivo}</td>
            <td>${item.nombre}</td>
            <td>${item.documento}</td>
            <td>${item.estado}</td>
            <td>
                <button 
                    class="btn btn-success btn-sm me-1 btn-aceptar" 
                    data-seccion-id="${item.seccion_id}" 
                    data-estudiante-id="${item.estudiante_id}" 
                    data-estado="Aprobado">
                    Aceptar
                </button>
                <button 
                    class="btn btn-danger btn-sm btn-rechazar" 
                    data-seccion-id="${item.seccion_id}" 
                    data-estudiante-id="${item.estudiante_id}" 
                    data-estado="Rechazado">
                    Rechazar
                </button>
            </td>
        `;
        tabla.appendChild(fila);
    });

    // Asignar eventos a los botones luego de que estén en el DOM
    tabla.querySelectorAll('.btn-aceptar, .btn-rechazar').forEach(btn => {
        btn.addEventListener('click', () => {
            const seccionId = btn.getAttribute('data-seccion-id');
            const estudianteId = btn.getAttribute('data-estudiante-id');
            const estado = btn.getAttribute('data-estado');

            responderSolicitudCancel(seccionId, estudianteId, estado);
        });
    });
}


function mostrarSolicitudes(soli) {
    const tabla = document.getElementById('tablasoli');
    tabla.innerHTML = ''; // Limpiar contenido anterior

    soli.forEach(soli => {
        const fila = document.createElement('tr');

        fila.innerHTML = `
            <td>${soli.nombre_completo}</td>
            <td>${soli.numero_cuenta}</td>
            <td>${soli.carrera_actual}</td>
            <td>${soli.carrera_solicitada}</td>
            <td>${soli.fechaInscripcion}</td>
            <td>${soli.estado}</td>
            <td>
                <button class="btn btn-success btn-sm me-1" onclick="responderSolicitud('${soli.numero_cuenta}', 'Aprobada')">Aceptar</button>
                <button class="btn btn-danger btn-sm" onclick="responderSolicitud('${soli.numero_cuenta}', 'Rechazada')">Rechazar</button>
            </td>
        `;

        tabla.appendChild(fila);
    });
}

function responderSolicitud(numeroCuenta, decision) {
    const confirmacion = confirm(`¿Estás seguro de que deseas ${decision} la solicitud de ${numeroCuenta}?`);
    if (!confirmacion) return;
    fetch(`${env.API_URL}/solicitud/cambio/responder`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            numero_cuenta: numeroCuenta,
            estado: decision
        })
    })
    console.log("qwerty");
    
}

function responderSolicitudCentro(numeroCuenta, decision) {
    const confirmacion = confirm(`¿Estás seguro de que deseas ${decision} la solicitud de ${numeroCuenta}?`);
    if (!confirmacion) return;
    fetch(`${env.API_URL}/solicitudcentro/cambio/responder`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            numero_cuenta: numeroCuenta,
            estado: decision
        })
    })
    console.log("qwerty");
    
}

async function responderSolicitudCancel(id, estudiante, decision) {
    const confirmacion = confirm(`¿Estás seguro de que deseas ${decision} la solicitud?`);
    if (!confirmacion) return;
    await fetch(`${env.API_URL}/can/responder`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            seccion_id: id,
            estudiante_id: estudiante,
            estado: decision
        })
    }).then(response => response.json())
    .then(result => {
      if(result.message){
        showToast(result.message,'success', 3000);
      } else{
        showToast(result.error,'error', 3000);
      }
    })
    console.log("qwerty");
    
}
//-----boton de pdf
document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'btnExportarPDF') {
        const elemento = document.getElementById('tablaPDF');
        const opt = {
            margin:       0.5,
            filename:     'secciones_academicas.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(elemento).save();
    }
});

//bton de csv

document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'btnExportarCSV') {
        console.log("Simona la mona");
        exportarACSV();
    }
});

function exportarACSV() {
    const tabla = document.getElementById('tablaSecciones');
    const filas = tabla.getElementsByTagName('tr');
    
    let csvContent = "Sección, Código, Asignatura, Docente, Edificio\n";  // Encabezados de la tabla

    // Iteramos sobre las filas de la tabla y agregamos los datos al CSV
    Array.from(filas).forEach(fila => {
        const columnas = fila.getElementsByTagName('td');
        const datosFila = Array.from(columnas).map(columna => columna.textContent.trim()).join(',');
        csvContent += datosFila + "\n";
    });

    // Crear un enlace para descargar el archivo CSV
    const enlace = document.createElement('a');
    enlace.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvContent));
    enlace.setAttribute('download', 'secciones_academicas.csv');
    document.body.appendChild(enlace);

    // Hacer clic en el enlace para descargar el archivo
    enlace.click();
    document.body.removeChild(enlace);
}

//btnhistorial

document.addEventListener('click', function (e) {
    if (e.target && e.target.id === 'btnBuscar') {
        obtenerHistorial();
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('inputBusqueda'); // Reemplazá con el ID real del input

    if (input) {
        input.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Previene que el form se recargue si está dentro de un <form>
                obtenerHistorial();
            }
        });
    }
});

//Historial de su vieja
function obtenerHistorial() {
    const busqueda = document.getElementById('inputBusqueda').value.trim();
    const carrera = document.getElementById('selectCarrera').value;
    
    if (!busqueda) {
        alert('Por favor ingrese un criterio de búsqueda.');
        return;
    }

    // Mostrar loader
    document.getElementById('loadingMsg').style.display = 'block';

    const params = new URLSearchParams();
    params.append('busqueda', busqueda);
    if (carrera !== "Todas las carreras") {
        params.append('carrera', carrera);
    }
    
    fetch(`${env.API_URL}/estudiante/historial?${params.toString()}`, {
        method: 'GET',
        "Authorization" : `Bearer ${localStorage.getItem("authToken")}`
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('loadingMsg').style.display = 'none';

        if (data.error) {
            console.error('Error al obtener historial:', data.error);
            document.getElementById('divhis').innerHTML = `<div class="alert alert-warning">No se encontraron resultados.</div>`;
        } else {
            mostrarHistorial(data.data);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        document.getElementById('loadingMsg').style.display = 'none';
    });
}

function mostrarHistorial(his) {
    // Limpiamos cualquier dato previo de la tabla
    const contenedor = document.getElementById('divhis');
    contenedor.innerHTML = '';
    
    const tabla = document.getElementById('divhis'); // Asegúrate de tener una tabla en el HTML

    // Creando las filas para la tabla
    his.forEach(his => {
        const fila = document.createElement('div');

        fila.innerHTML = `
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-info-circle me-2"></i> Información del Estudiante
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <img src="https://via.placeholder.com/150" class="rounded-circle img-thumbnail mb-3" alt="Foto estudiante">
                            <h5>${his.nombre_completo}</h5>
                            <p class="text-muted">2023-01025</p>
                            <span class="badge bg-success">Activo</span>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><i class="fas fa-user-tag me-2"></i> Datos Personales</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><strong>Carrera:</strong> ${his.nombre_carrera}</li>
                                        <li class="mb-2"><strong>Centro:</strong> ${his.nombre_centro}</li>
                                        <li class="mb-2"><strong>Correo:</strong> ${his.correo}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5><i class="fas fa-chart-line me-2"></i> Estadísticas</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><strong>Promedio:</strong> ${his.Promedio}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

        `;

        tabla.appendChild(fila);
    });
}

export {obtenerSecciones, obtenerSolicitudes, obtenerHistorial, obtenerSolicitudesCentro, obtenerSolicitudesCancel}
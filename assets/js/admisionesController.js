import { showModalSuccess, showModalFailure } from "../js/utilities.mjs";

// Variables globales
let formValido = false;
let documentoValido = false;
let telefonoValido = false;
let emailValido = false;
let archivoValido = false;

// Tipos MIME permitidos
const tiposPermitidos = {
    'application/pdf': 'pdf',
    'application/msword': 'doc',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'docx',
    'application/vnd.oasis.opendocument.text': 'odt',
    'image/jpeg': 'jpg',
    'image/png': 'png',
    'image/bmp': 'bmp',
    'image/tiff': 'tiff'
};

// Extensiones permitidas
const extensionesPermitidas = ['pdf', 'doc', 'docx', 'odt', 'jpg', 'jpeg', 'png', 'bmp', 'tiff'];

// Inicialización al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('submitBtn').disabled = true;
    
    // Deshabilitar carreras inicialmente
    document.getElementById('carreraPrincipal').disabled = true;
    document.getElementById('carreraSecundaria').disabled = true;
    
    configurarValidaciones();
});

function configurarValidaciones() {
    // Configurar evento para tipo de documento
    document.getElementById('tipoDocumento').addEventListener('change', function() {
        const docInput = document.getElementById('numeroDocumento');
        docInput.disabled = this.value === '';
        docInput.value = '';
        docInput.classList.remove('is-invalid');
        documentoValido = false;
        validarFormulario();
        
        if(this.value === 'identidad') {
            document.getElementById('identidadError').style.display = 'inline';
            document.getElementById('pasaporteError').style.display = 'none';
        } else if(this.value === 'pasaporte') {
            document.getElementById('identidadError').style.display = 'none';
            document.getElementById('pasaporteError').style.display = 'inline';
        }
    });

    // Configurar eventos para número de documento
    const docInput = document.getElementById('numeroDocumento');
    docInput.addEventListener('input', function(e) {
        const tipoDoc = document.getElementById('tipoDocumento').value;
        let value = e.target.value.replace(/\D/g, '');
        
        if(tipoDoc === 'identidad') {
            // Limitar a 13 dígitos
            if(value.length > 13) value = value.substring(0, 13);
            
            // Aplicar formato con guiones
            let formatted = '';
            for(let i = 0; i < value.length; i++) {
                if(i === 4 || i === 8) formatted += '-';
                formatted += value[i];
            }
            e.target.value = formatted;
        } 
        else if(tipoDoc === 'pasaporte') {
            // Limitar a 8 caracteres
            if(value.length > 8) value = value.substring(0, 8);
            
            // Formatear pasaporte (2 letras + 6 números)
            if(value.length > 2) {
                value = value.substring(0,2).toUpperCase() + value.substring(2);
            }
            e.target.value = value;
        }
        
        validarDocumento();
    });
    docInput.addEventListener('blur', validarDocumento);

    // Configurar eventos para email
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', validarEmail);
    emailInput.addEventListener('blur', validarEmail);

    // Configurar eventos para teléfono
    const telefonoInput = document.getElementById('telefono');
    telefonoInput.addEventListener('input', function(e) {
        const codigo = document.getElementById('codigoPais').value;
        let value = e.target.value.replace(/\D/g, '');
        
        if(codigo === '+504') {
            // Honduras: limitar a 8 dígitos
            if(value.length > 8) value = value.substring(0, 8);
            
            // Formato: ####-####
            if(value.length > 4) {
                e.target.value = value.substring(0,4) + '-' + value.substring(4);
            } else {
                e.target.value = value;
            }
        } else {
            // Otros países: limitar a 10 dígitos
            if(value.length > 10) value = value.substring(0, 10);
            
            // Formato: ###-###-####
            if(value.length > 6) {
                e.target.value = value.substring(0,3) + '-' + value.substring(3,6) + '-' + value.substring(6);
            } else if(value.length > 3) {
                e.target.value = value.substring(0,3) + '-' + value.substring(3);
            } else {
                e.target.value = value;
            }
        }
        
        validarTelefono();
    });
    telefonoInput.addEventListener('blur', validarTelefono);

    // Configurar evento para cambio de código de país
    document.getElementById('codigoPais').addEventListener('change', function() {
        document.getElementById('telefono').value = '';
        validarTelefono();
        validarFormulario();
    });

    // Configurar evento para centro regional
    document.getElementById('centroRegional').addEventListener('change', function() {
        const carreraPrincipal = document.getElementById('carreraPrincipal');
        const carreraSecundaria = document.getElementById('carreraSecundaria');
        
        if(this.value) {
            // Habilitar solo la carrera principal
            carreraPrincipal.disabled = false;
            carreraSecundaria.disabled = true;
            
            // Limpiar valores
            carreraPrincipal.classList.remove('is-invalid');
            carreraSecundaria.classList.remove('is-invalid');
        } else {
            // Deshabilitar ambas si no hay centro regional seleccionado
            carreraPrincipal.disabled = true;
            carreraSecundaria.disabled = true;
            
        }
        
        validarFormulario();
    });

    // Configurar evento para carrera principal
    document.getElementById('carreraPrincipal').addEventListener('change', function() {
        const carreraSecundaria = document.getElementById('carreraSecundaria');
        
        // Habilitar carrera secundaria solo si hay una carrera principal seleccionada
        carreraSecundaria.disabled = this.value === '';
        
        if(this.value === '') {
            // Si se deselecciona la carrera principal, limpiar la secundaria
            carreraSecundaria.value = '';
        }
        
        this.classList.toggle('is-invalid', this.value === '');
        validarFormulario();
    });

    // Configurar evento para carrera secundaria
    document.getElementById('carreraSecundaria').addEventListener('change', validarFormulario);

    // Configurar evento para archivo
    document.getElementById('certificadoSecundaria').addEventListener('change', validarArchivo);

    // Configurar eventos para campos requeridos
    const camposRequeridos = document.querySelectorAll('[required]');
    camposRequeridos.forEach(campo => {
        campo.addEventListener('blur', function() {
            if(this.value.trim() === '') {
                this.classList.add('is-invalid');
            }
            validarFormulario();
        });
    });
}

function validarDocumento() {
    const docInput = document.getElementById('numeroDocumento');
    const tipoDoc = document.getElementById('tipoDocumento').value;
    
    if (!tipoDoc) {
        docInput.classList.add('is-invalid');
        documentoValido = false;
        validarFormulario();
        return;
    }

    // Obtener solo los dígitos (sin guiones)
    const valorLimpio = docInput.value.replace(/\D/g, '');
    
    if(tipoDoc === 'identidad') {
        // Validar que tenga exactamente 13 dígitos
        documentoValido = valorLimpio.length === 13;
        
        // Validar que la fecha (primeros 4 dígitos) sea válida
        if(documentoValido) {
            const mes = parseInt(valorLimpio.substring(0, 2));
            const dia = parseInt(valorLimpio.substring(2, 4));
            documentoValido = (mes >= 1 && mes <= 12) && (dia >= 1 && dia <= 31);
        }
    } 
    else if(tipoDoc === 'pasaporte') {
        // Validar formato AB123456 (2 letras + 6 números)
        documentoValido = /^[A-Z]{2}\d{6}$/.test(docInput.value);
    }
    
    if(event.type === 'blur' && docInput.value.trim() !== '') {
        docInput.classList.toggle('is-invalid', !documentoValido);
    } else if(event.type === 'input') {
        docInput.classList.toggle('is-invalid', false);
    }
    
    validarFormulario();
}

function validarEmail() {
    const emailInput = document.getElementById('email');
    const email = emailInput.value;
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    if(event.type === 'input') {
        emailValido = email === '' || regex.test(email);
        emailInput.classList.toggle('is-invalid', !emailValido && emailInput === document.activeElement);
    }
    
    if(event.type === 'blur') {
        emailValido = regex.test(email);
        emailInput.classList.toggle('is-invalid', !emailValido);
    }
    
    validarFormulario();
}

function validarTelefono() {
    const telefonoInput = document.getElementById('telefono');
    const codigo = document.getElementById('codigoPais').value;
    const telefono = telefonoInput.value.replace(/\D/g, '');
    
    if(codigo === '+504') {
        telefonoValido = /^[2-9]\d{7}$/.test(telefono); // 8 dígitos, primero 2-9
    } else {
        telefonoValido = /^\d{10}$/.test(telefono); // 10 dígitos para otros países
    }
    
    if(event.type === 'blur' && telefonoInput.value.trim() !== '') {
        telefonoInput.classList.toggle('is-invalid', !telefonoValido);
    } else if(event.type === 'input') {
        telefonoInput.classList.toggle('is-invalid', false);
    }
    
    validarFormulario();
}

function validarArchivo(e) {
    const fileInput = e.target;
    const file = fileInput.files[0];
    archivoValido = false;
    fileInput.classList.remove('is-invalid');

    if (!file) {
        fileInput.classList.add('is-invalid');
        document.getElementById('certificadoError').textContent = "Debe seleccionar un archivo";
        validarFormulario();
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        document.getElementById('certificadoError').textContent = "El archivo es demasiado grande (máximo 5MB)";
        fileInput.classList.add('is-invalid');
        fileInput.value = '';
        validarFormulario();
        return;
    }

    const fileNameParts = file.name.split('.');
    const fileExtension = fileNameParts.length > 1 ? fileNameParts.pop().toLowerCase() : '';
    
    if (!tiposPermitidos[file.type] && !extensionesPermitidas.includes(fileExtension)) {
        document.getElementById('certificadoError').textContent = 
            "Tipo de archivo no permitido. Formatos aceptados: PDF, DOC, DOCX, JPG, JPEG, PNG, BMP, TIFF, ODT";
        fileInput.classList.add('is-invalid');
        fileInput.value = '';
        validarFormulario();
        return;
    }

    if (file.type.match('image.*')) {
        const img = new Image();
        const objectURL = URL.createObjectURL(file);
        
        img.onload = function() {
            if (this.width < 800 || this.height < 600) {
                document.getElementById('certificadoError').textContent = 
                    `La imagen es demasiado pequeña (${this.width}x${this.height}px). Mínimo requerido: 800x600px`;
                fileInput.classList.add('is-invalid');
                fileInput.value = '';
                archivoValido = false;
            } else {
                fileInput.classList.remove('is-invalid');
                archivoValido = true;
            }
            URL.revokeObjectURL(objectURL);
            validarFormulario();
        };
        
        img.onerror = function() {
            document.getElementById('certificadoError').textContent = "No se pudo leer el archivo de imagen";
            fileInput.classList.add('is-invalid');
            fileInput.value = '';
            archivoValido = false;
            URL.revokeObjectURL(objectURL);
            validarFormulario();
        };
        
        img.src = objectURL;
    } else {
        fileInput.classList.remove('is-invalid');
        archivoValido = true;
        validarFormulario();
    }
}

function validarFormulario() {
    const camposRequeridos = document.querySelectorAll('[required]');
    let camposCompletos = true;
    
    camposRequeridos.forEach(campo => {
        if(campo.value.trim() === '' || campo.classList.contains('is-invalid')) {
            camposCompletos = false;
        }
    });
    
    // Verificar si las carreras están habilitadas y tienen valor (si es necesario)
    const carreraPrincipal = document.getElementById('carreraPrincipal');
    if(!carreraPrincipal.disabled && carreraPrincipal.value === '') {
        camposCompletos = false;
    }
    
    formValido = camposCompletos && documentoValido && telefonoValido && emailValido && archivoValido;
    document.getElementById('submitBtn').disabled = !formValido;
};

import loadEnv from "./getEnv.mjs";
const env = await loadEnv();


function fillCentersSelect() {
    const centerSelect = document.getElementById("centroRegional");

    const loadingElement = document.getElementById("loading");
    const timeoutMessage = document.querySelector(".timeout-message");
    // Mostrar loading
    loadingElement.style.display = "flex";
    timeoutMessage.style.display = "none";
    
    // Timeout para peticiones lentas (5 segundos)
    const timeout = setTimeout(() => {
        timeoutMessage.style.display = "block";
    }, 5000);

    fetch(`${env.API_URL}/centros`)
        .then(response=>{
            if(!response.ok){
                throw new Error('Error: ', response.status);
            }
            return response.json();
        })
        .then(data=>{
            data.data.forEach(element => {
                centerSelect.innerHTML+=`
                    <option value=${element.codigo_centro}>${element.nombre_centro}</option>
                `;
            });
        })
        .catch(error=>{
            showModalFailure(error);
        })
        .finally(() => {
            // Ocultar loading y cancelar timeout
            loadingElement.style.display = "none";
            clearTimeout(timeout);
        });
};

document.getElementById("centroRegional").addEventListener("change", function () {

    const loadingElement = document.getElementById("loading");
    const timeoutMessage = document.querySelector(".timeout-message");
    // Mostrar loading
    loadingElement.style.display = "flex";
    timeoutMessage.style.display = "none";
    
    // Timeout para peticiones lentas (5 segundos)
    const timeout = setTimeout(() => {
        timeoutMessage.style.display = "block";
    }, 5000);

    fetch(`${env.API_URL}/centros/${this.value}/carreras`)
        .then(response=>{
            if(!response.ok){
                throw new Error('Error: ' + response.status);
            }
            return response.json();
        })
        .then(data=>{
            const principalCareerSelect = document.getElementById("carreraPrincipal");
            const secondaryCareerSelect = document.getElementById("carreraSecundaria");

            principalCareerSelect.innerHTML = '<option value="" selected disabled>Seleccione una carrera</option>';

            data.data.forEach(element => {
                principalCareerSelect.innerHTML += `<option value=${element.codigo_carrera}>${element.nombre_carrera}</option>`;
            });

            principalCareerSelect.addEventListener('change', function() {
                secondaryCareerSelect.innerHTML = '<option value="" selected disabled>Seleccione una carrera</option>';

                const filteredCareers = data.data.filter(career => career.codigo_carrera !== this.value);

                filteredCareers.forEach(element => {
                    secondaryCareerSelect.innerHTML += `<option value="${element.codigo_carrera}">${element.nombre_carrera}</option>`;
                });
            });
        })
        .catch(error=>{
            showModalFailure(error);
        })
        .finally(() => {
            // Ocultar loading y cancelar timeout
            loadingElement.style.display = "none";
            clearTimeout(timeout);
        });
});

fillCentersSelect();

// Manejar envío del formulario
document.getElementById('registroForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Forzar validación de todos los campos antes de enviar
    validarDocumento();
    validarEmail();
    validarTelefono();
    validarFormulario();
    
    if(formValido) {  

        const formData = new FormData(this);

        const loadingElement = document.getElementById("loading");
        const timeoutMessage = document.querySelector(".timeout-message");
        // Mostrar loading
        loadingElement.style.display = "flex";
        timeoutMessage.style.display = "none";
        
        // Timeout para peticiones lentas (5 segundos)
        const timeout = setTimeout(() => {
            timeoutMessage.style.display = "block";
        }, 5000);

        fetch(`${env.API_URL}/admisiones`,{
            method: "POST",
            body: formData
        })
        .then(response=>{
            if(!response.ok){
                throw new Error(response.error);
            }
            return response.json();
        })
        .then(data=>{
            showModalSuccess(data.title, data.subtitle, data.message, "/home");
        })
        .catch(error=>{
            showModalFailure(error);
        })
        .finally(() => {
            // Ocultar loading y cancelar timeout
            loadingElement.style.display = "none";
            clearTimeout(timeout);
        });


    } else {
        showModalFailure("Ingresa tus datos correctamente e inténtalo de nuevo.");
    }
});
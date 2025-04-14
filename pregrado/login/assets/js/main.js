const API_URL = "http://localhost:3806"; //CAMBIAR A RUTA DEL BACKEND

document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.querySelector('.btn-login');
    const spinner = document.getElementById('loadingSpinner');
    const alertContainer = document.getElementById('alertContainer');
    
    // Reset UI
    alertContainer.innerHTML = '';
    submitBtn.disabled = true;
    spinner.classList.remove('d-none');
    
    const loginData = {
        accountNumber: document.getElementById('numeroCuenta').value.trim(),
        password: document.getElementById('contrasenia').value
    };
    
    // 1. Hacer login
    fetch(`${API_URL}/login`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(loginData)
    })
    .then(async response => {
        if (!response.ok) {
            return response.json().then(err => Promise.reject(err));
        }
        return response.json();
    })
    .then(async({ token, user }) => {
        // Guardar el token
        localStorage.setItem('authToken', token);
        
        // 2. Obtener info del usuario autenticado
        return fetch(`${API_URL}/me`, {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        }).then(async response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        });
    })
    .then(userData => {
        // 3. Guardar en sesión PHP
        return fetch('/pregrado/login/save-roles.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(userData)
        })
        .then(response => {
            if (!response.ok) {
                localStorage.removeItem('authToken');
                return Promise.reject(new Error('Error al guardar la sesión'));
            }
            return userData;
        });
    })
    .then(userData => {
        const roles = userData.roles.map(r => r.toLowerCase());
        const userId = userData.id;
        let redireccion = '';
        let constLocal = ''
    
        console.log(userData);
        // Elegir endpoint y vista según rol
       if (roles.includes('coordinador')) {
            redireccion = "/pregrado/views/coordinador.php";
            constLocal = 'coordinador';
        }else if(roles.includes('docente')){
            redireccion = "/pregrado/views/pregrado_docente.php";
            constLocal = 'docente';
        }else if(roles.includes('estudiante')){
            redireccion = "/pregrado/views/dashboard.php";
            constLocal = 'estudiante';
        }
        else {
            throw new Error('Rol no reconocido');
        }   
            localStorage.setItem(constLocal, userId);

            window.location.href = redireccion;            
    })
    
    .catch(error => {
        localStorage.removeItem('authToken');
         localStorage.removeItem('authToken');
        
        // Mostrar error al usuario
        alertContainer.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show">
                ${error.message || 'Error desconocido durante el inicio de sesión'}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    })
    .finally(() => {
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
    });
});
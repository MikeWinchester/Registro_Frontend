import loadEnv from "../../../../assets/js/getEnv.mjs";
const env = await loadEnv();

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
    fetch(`${env.API_URL}/login`, {
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
        // Guardar el token en localStorage antes de continuar
        localStorage.setItem('authToken', token);
        
        // 2. Obtener información del usuario autenticado
        return fetch(`${env.API_URL}/me`, {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        })
        .then(async response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        });
    })
    .then(async userData => {
        // 3. Guardar roles en sesión PHP
        return fetch('/login/save-roles.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(userData)
        })
        .then(response => {
            if (!response.ok) {
                // Opcional: remover el token si falla
                localStorage.removeItem('authToken');
                return Promise.reject(new Error('Error al guardar la sesión'));
            }
            return response;
        });
    })
    .then(() => {
        // Redirigir al dashboard
        window.location.href = "/biblioteca/students-teachers/index.php";
    })
    .catch(error => {
        // Limpiar el token si hay algún error
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
        // Restaurar UI
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
    });
});
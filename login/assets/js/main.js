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
        return fetch('/login/save-roles.php', {
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
        let endpoint = '';
        let redireccion = '';
        let constLocal = ''
    
        // Elegir endpoint y vista según rol
        if (roles.includes('jefe')) {
            endpoint = `${API_URL}/jefe/get/id`;
            redireccion = "/views/jefe_departamento.php";
            constLocal = 'jefeID';
        } else if (roles.includes('docente')) {
            endpoint = `${API_URL}/docente/get/id`;
            redireccion = "/views/docentes.php";
            constLocal = 'docenteID';
        } else if (roles.includes('estudiante')) {
            endpoint = `${API_URL}/estudiante/get/id`;
            redireccion = "/matricula/views/matricula_estudiante.php";
            constLocal = 'estudiante';
        } else {
            throw new Error('Rol no reconocido');
        }
    
        // Llamada al endpoint según el rol
        return fetch(endpoint, {
            method: 'GET',
            headers: {
                'id' : userId,
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            }
        })
        .then(res => res.json())
        .then(data => {
            console.log("Datos del usuario por rol:", data.data.id);
            
            localStorage.setItem(constLocal, data.data.id);

            window.location.href = redireccion;            
        });
    })
    
    .catch(error => {
        localStorage.removeItem('authToken');
        window.location.href = '/views/landing.php';
    })
    .finally(() => {
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
    });
});


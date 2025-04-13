// Simulación de autenticación
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si el usuario está logueado
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    
    // Si está en la página de login y ya está logueado, redirigir al dashboard
    if (window.location.pathname.endsWith('index.html')){
        if (isLoggedIn) {
            window.location.href = '/dashboard.html';
        }
        
        // Manejar el formulario de login
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const studentId = document.getElementById('studentId').value;
                const password = document.getElementById('password').value;
                
                // Validación simple para demostración
                if (studentId && password) {
                    localStorage.setItem('isLoggedIn', 'true');
                    localStorage.setItem('studentId', studentId);
                    localStorage.setItem('studentName', 'Juan Pérez'); // Nombre quemado para demostración
                    window.location.href = 'dashboard.html';
                } else {
                    alert('Por favor ingrese su número de cuenta y contraseña');
                }
            });
        }
    } else {
        // Si no está logueado y no está en la página de login, redirigir al login
        if (!isLoggedIn) {
            window.location.href = 'index.html';
        }
    }
    
    // Mostrar nombre de usuario en todas las páginas
    const userNameElements = document.querySelectorAll('#userName');
    if (userNameElements.length > 0) {
        const studentName = localStorage.getItem('studentName') || 'Estudiante';
        userNameElements.forEach(el => {
            el.textContent = studentName;
        });
    }
    
    // Manejar el botón de logout
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            localStorage.removeItem('isLoggedIn');
            localStorage.removeItem('studentId');
            localStorage.removeItem('studentName');
            window.location.href = '/index.html';
        });
    }
});
<section class="form-section">
        <div class="container-form">
            <div class="login-form">
                <div class="form-content">
                    <img src="https://nelsonmedinahn.wordpress.com/wp-content/uploads/2017/08/logo-unah.png" 
                         alt="Logo UNAH" 
                         class="logo">
                    <h2 class="mb-4">Inicia Sesión</h2>
                    <p class="mb-4">Ingresa tu número de cuenta y contraseña</p>
                    
                    <form class="form" id="login-form">
                        <div id="alertContainer"></div>
                        <div class="input-group">
                            <i class="bi bi-person"></i>
                            <input type="text" 
                                   id="numeroCuenta"
                                   class="input-field" 
                                   placeholder="Número de Cuenta">
                        </div>
                        
                        <div class="input-group">
                            <i class="bi bi-lock"></i>
                            <input type="password"
                                   id="contrasenia" 
                                   class="input-field" 
                                   placeholder="Contraseña">
                        </div>
                        
                        <button type="submit" class="btn-login">
                            <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none"></span>
                            Acceder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
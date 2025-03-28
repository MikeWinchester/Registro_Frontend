export function showModalSuccess(title, subtitle, message, destinyURL){
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();

    document.getElementById("successModalLabel").textContent = title;
    document.getElementById("successSubtitle").textContent = subtitle;
    document.getElementById("successMessage").innerHTML = message;
    
    // Configurar el temporizador para redirección automática
    let seconds = 15;
    const redirectButton = document.getElementById('redirectButton');
    const redirectInterval = setInterval(() => {
      redirectButton.innerHTML = `<i class="fas fa-thumbs-up me-2"></i>Aceptar (${seconds})`;
      seconds--;
      
      if(seconds < 0) {
        clearInterval(redirectInterval);
        window.location.href = destinyURL; // Cambia esta URL
      }
    }, 1000);
    
    // Configurar el botón para redirección manual
    redirectButton.addEventListener('click', function() {
      clearInterval(redirectInterval);
      window.location.href = destinyURL; // Cambia esta URL
    });
};

export function showModalFailure(message){
    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();

    document.getElementById('errorMessage').textContent = message;

};
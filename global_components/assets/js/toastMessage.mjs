
function showToast(message, type = "info", duration = 2000) {
    const toast = document.getElementById("toast");
    
    toast.className = `toast ${type}`;
    toast.textContent = message;
    
    toast.classList.add("show");
    
    setTimeout(() => {
        toast.classList.remove("show");
    }, duration);
}


export {showToast};
export function openModal() {
    document.getElementById("Modal").style.display = "block";
  }
  
export function closeModal() {
    document.getElementById("Modal").style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById("miModal");
    if (event.target === modal) {
        closeModal();
    }
}


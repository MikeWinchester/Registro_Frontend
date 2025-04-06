export function openModal() {
    document.getElementById("miModal").style.display = "block";
  }
  
export function closeModal() {
    document.getElementById("miModal").style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById("miModal");
    if (event.target === modal) {
        closeModal();
    }
}


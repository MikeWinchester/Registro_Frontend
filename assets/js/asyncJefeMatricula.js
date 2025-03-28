

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".option").forEach(item => {
        item.addEventListener("click", function(event) {
            event.preventDefault();

            let page = this.getAttribute("data-page");

            fetch(page)
                .then(response => response.text())
                .then(data => {
                    let mainContent = document.getElementById("main-content");
                    mainContent.innerHTML = data;

                    
                    document.querySelectorAll("script[data-dynamic]").forEach(script => script.remove());

                    
                    let scriptSrcs = [];
                    if (page.includes("crear_secciones.php")) { 
                        scriptSrcs.push("/assets/js/deploySeccion.js");
                        scriptSrcs.push("/assets/js/sendSeccion.js");
                        scriptSrcs.push("https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js");
                        
                    }
                    if (page.includes("secciones_programadas.php")) { 
                        scriptSrcs.push("/assets/js/seccionController.js");
                    }

                    if (scriptSrcs.length > 0) {
                        scriptSrcs.forEach(scriptSrc => {
                            let script = document.createElement("script")
                            script.src = scriptSrc
                            script.dataset.dynamic = "true";
                            document.body.appendChild(script);

                            script.onload = function() {
                                setTimeout(deploySeccion, 500); 
                            };

                        })
                    }
                })
                .catch(error => console.error("Error al cargar la página:", error));
        });
    });
});
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
                    if (page.includes("estudiante_adicionar_asignatura.php")) { 
                        scriptSrcs.push("/assets/js/adicionController.js");
                    }

                    if (scriptSrcs.length > 0) {
                        let scriptsLoaded = 0;

                        scriptSrcs.forEach(scriptSrc => {
                            let script = document.createElement("script");
                            script.src = scriptSrc;
                            script.dataset.dynamic = "true";
                            script.async = false; 
                            document.body.appendChild(script);

                            script.onload = function() {
                                scriptsLoaded++;
                                if (scriptsLoaded === scriptSrcs.length) {
                                    
                                    desployContent(); 
                                }
                            };
                        });
                    }
                })
                .catch(error => console.error("Error al cargar la página:", error));
        });
    });
});

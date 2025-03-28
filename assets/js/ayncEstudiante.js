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
                    else if(page.includes("estudiante_cancelar_asignatura.php")){
                        scriptSrcs.push("/assets/js/cancelacionController.js");
                    }
                    else if(page.includes("estudiante_lista_espera_asignatura.php")){
                        scriptSrcs.push("/assets/js/desployEspera.js");
                    }else if(page.includes("estudiante_clases_canceladas.php")){
                        scriptSrcs.push("/assets/js/desployCancelacion.js");
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
                                    
                                    if(scriptSrcs.includes('/assets/js/adicionController.js')){
                                        desployContent();
                                    }else if(scriptSrcs.includes('/assets/js/cancelacionController.js')){
                                        createTable();
                                    }
                                    else if(scriptSrcs.includes("/assets/js/desployEspera.js")){
                                        desployTable();
                                    }
                                    else if(scriptSrcs.includes("/assets/js/desployCancelacion.js")){
                                        desployTable();
                                    }
                                }
                            };
                        });
                    }
                })
                .catch(error => console.error("Error al cargar la página:", error));
        });
    });
});

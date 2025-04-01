import { desployContent} from "./adicionController.js";
import { createTable } from "./cancelacionController.js";
import { desployTable } from "./desployEspera.js";
import { desployTable as desployCan}  from "./desployCancelacion.js";
import { forma03 } from "./forma03.js";
import { domObj } from "./adicionDOM.js";


document.querySelectorAll(".option").forEach(item => {
    item.addEventListener("click", function(event) {
        event.preventDefault();

        let page = this.getAttribute("data-page");

        if (!page || page === "#") return;  

        fetch(page)
            .then(response => response.text())
            .then(html => {
                let mainContent = document.getElementById("main-content");
                mainContent.innerHTML = html;

                executeInlineScripts(mainContent);

                document.querySelectorAll("script[data-dynamic]").forEach(script => script.remove());

                let scriptSrcs = [];

                if (page.includes("estudiante_adicionar_asignatura.php")) { 
                    scriptSrcs.push("/assets/js/adicionController.js");
                    scriptSrcs.push("/assets/js/adicionDOM.js");
                }
                else if(page.includes("estudiante_cancelar_asignatura.php")){
                    scriptSrcs.push("/assets/js/cancelacionController.js");
                }
                else if(page.includes("estudiante_lista_espera_asignatura.php")){
                    scriptSrcs.push("/assets/js/desployEspera.js");
                    scriptSrcs.push("/assets/js/esperaDOM.js");
                }
                else if(page.includes("estudiante_clases_canceladas.php")){
                    scriptSrcs.push("/assets/js/desployCancelacion.js");
                }
                else if(page.includes("forma03.php")){
                    scriptSrcs.push("/assets/js/forma03.js");
                }

                if (scriptSrcs.length > 0) {
                    loadScripts(scriptSrcs, function() {
                        if(scriptSrcs.includes('/assets/js/adicionController.js')){
                            domObj();
                            desployContent();
                        }
                        else if(scriptSrcs.includes('/assets/js/cancelacionController.js')){
                            createTable();
                        }
                        else if(scriptSrcs.includes("/assets/js/desployEspera.js")){
                            desployTable();
                        }else if(scriptSrcs.includes("/assets/js/desployCancelacion.js")){
                            desployCan();
                        }else if(scriptSrcs.includes("/assets/js/forma03.js")){
                            forma03();
                        }
                    });
                }
            })
            .catch(error => console.error("Error al cargar la página:", error));
    });
});



function executeInlineScripts(container) {
    let scripts = container.querySelectorAll("script");
    scripts.forEach(oldScript => {
        let newScript = document.createElement("script");
        newScript.textContent = oldScript.textContent;
        document.body.appendChild(newScript).parentNode.removeChild(newScript);
    });
}

function loadScripts(scripts, callback) {
    let loadedScripts = 0;
    scripts.forEach(src => {
        let script = document.createElement("script");
        script.src = src;
        script.dataset.dynamic = "true";
        script.type = "module";
        script.async = false;
        document.body.appendChild(script);

        script.onload = function() {
            loadedScripts++;
            if (loadedScripts === scripts.length) {
                callback();
            }
        };
    });
}

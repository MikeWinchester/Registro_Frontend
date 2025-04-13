import { desployContent} from "./adicionController.js";
import { domObj } from "./adicionDOM.js";
import { createTable, desployTable, desployTableEsp, forma03 } from "./estudiantes.js";


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
                    scriptSrcs.push("/matricula/assets/js/adicionController.js");
                    scriptSrcs.push("/matricula/assets/js/adicionDOM.js");
                }
                else {
                    scriptSrcs.push("/matricula/assets/js/estudiantes.js");
                }
                
                if (scriptSrcs.length > 0) {
                    loadScripts(scriptSrcs, function() {
                        if(scriptSrcs.includes('/matricula/assets/js/adicionController.js')){
                            domObj();
                            desployContent();
                        }
                        else if(page.includes('estudiante_cancelar_asignatura.php')){
                            createTable();
                        }
                        else if(page.includes('estudiante_clases_canceladas.php')){
                            desployTable();
                        }else if(page.includes('estudiante_lista_espera_asignatura.php')){
                            desployTableEsp();
                        }else if(page.includes('forma03.php')){
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

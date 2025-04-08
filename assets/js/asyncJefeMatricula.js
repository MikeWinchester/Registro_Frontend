import { desployClass} from "./seccionController.js";
import { objDOM } from "./jefeSeccionDOM.js";
import { getEspera } from "./listaEsperaJefe.js";
import { desploySelect, DOM } from "./revisionNotasJefe.js";
import { jefehistDOM } from "./jefeHistorialEstudiantes.js";
import { desploySelectEva, evaDOM } from "./revisionEvaluacionesJefe.js";


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

                if (page.includes("crear_secciones.php")) { 
                    scriptSrcs.push("/assets/js/deploySeccion.js");
                    scriptSrcs.push("/assets/js/jefeSeccionDOM.js");
                    scriptSrcs.push("/assets/js/sendSeccion.js");
                }else if (page.includes("secciones_programadas.php")){
                    scriptSrcs.push("/assets/js/seccionController.js");
                }else if (page.includes("clases_lista_espera.php")){
                    scriptSrcs.push("/assets/js/listaEsperaJefe.js");
                }else if(page.includes("evaluaciones_docentes.php")){
                    scriptSrcs.push("/assets/js/revisionNotasJefe.js");
                }else if(page.includes('estudiantes_historial.php')){
                    scriptSrcs.push("/assets/js/jefeHistorialEstudiantes.js");
                }else if(page.includes("estudiantes_historial.php")){
                    scriptSrcs.push("/assets/js/jefeHistorialEstudiantes.js");
                }else if(page.includes("evaluaciones_docentes_calificacion.php")){
                    scriptSrcs.push("/assets/js/revisionEvaluacionesJefe.js");
                }
                

                if (scriptSrcs.length > 0) {
                    loadScripts(scriptSrcs, function() {
                        
                        if(scriptSrcs.includes('/assets/js/seccionController.js')){
                            desployClass();
                        }else if(scriptSrcs.includes("/assets/js/jefeSeccionDOM.js")){
                            objDOM();
                        }else if(scriptSrcs.includes("/assets/js/listaEsperaJefe.js")){
                            getEspera();
                        }else if(scriptSrcs.includes("/assets/js/revisionNotasJefe.js")){
                            desploySelect();
                            DOM();
                        }else if(scriptSrcs.includes("/assets/js/jefeHistorialEstudiantes.js")){
                            jefehistDOM();
                        }
                        else if(scriptSrcs.includes("/assets/js/revisionEvaluacionesJefe.js")){
                            desploySelectEva();
                            evaDOM();
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
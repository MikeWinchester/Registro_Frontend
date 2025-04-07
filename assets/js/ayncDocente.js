import { cargarClases, cargarPerfil, listarClases } from "./Docente.js";
import { docenteDOM } from "./docenteDOM.js";

const docenteID = localStorage.getItem("docenteID");

document.querySelectorAll(".option").forEach(item => {
    item.addEventListener("click", function(event) {
        event.preventDefault();

        let page = this.getAttribute("data-page");

        fetch(page)
            .then(response => response.text())
            .then(html => {
                let mainContent = document.getElementById("main-content");
                mainContent.innerHTML = html;

                executeInlineScripts(mainContent);

                document.querySelectorAll("script[data-dynamic]").forEach(script => script.remove());

                let scriptSrcs = [];

                scriptSrcs.push("/assets/js/Docente.js");

                if(page.includes("evaluaciones.php")){
                    scriptSrcs.push("/assets/js/manejadorEstudiantes.js")
                    scriptSrcs.push("/assets/js/docenteDOM.js")        
                }

                if (scriptSrcs.length > 0) {
                    loadScripts(scriptSrcs, function() {
                        
                        if(page.includes("clases.php")){
                            cargarClases(docenteID);
                        }
                        else if(page.includes("perfilDocente.php")){
                            cargarPerfil(docenteID);
                        }
                        else if(page.includes('evaluaciones.php')){
                            listarClases(docenteID);
                            docenteDOM();
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
import { cargarClases, cargarPerfil, listarClases, validateDate } from "./Docente.js";
import { docenteDOM } from "./docenteDOM.js";
import { showToast } from "./toastMessage.mjs";

document.querySelectorAll(".option").forEach(item => {
    item.addEventListener("click", async function(event) {
        event.preventDefault();

        let page = this.getAttribute("data-page");

        const validate = await validateDate();
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
                    if(!validate.validate){
                        showToast(validate.error, 'error')
                        return;
                    }
                    scriptSrcs.push("/assets/js/manejadorEstudiantes.js")
                    scriptSrcs.push("/assets/js/docenteDOM.js")        
                }

                if (scriptSrcs.length > 0) {
                    loadScripts(scriptSrcs, function() {
                        
                        if(page.includes("clases.php")){
                            cargarClases();
                        }
                        else if(page.includes("perfilDocente.php")){
                            cargarPerfil();
                        }
                        else if(page.includes('evaluaciones.php')){
                            listarClases();
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
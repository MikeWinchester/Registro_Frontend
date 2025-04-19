document.querySelector(".btn-download").addEventListener("click", descargar)

function descargar(){
        
    const estudiantes = createCSV();

    let csvContent = "data:text/csv;charset=utf-8," + estudiantes.map(e => e.join(",")).join("\n");

    let encodedUri = encodeURI(csvContent);
    let link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "Lista_Estudiantes.csv");
    document.body.appendChild(link);

    link.click();
    document.body.removeChild(link);

}

function createCSV(){
    
    let estudiantes = document.querySelectorAll('.estudiantes');

    let csv = [["nombre", "cuenta"]];

    estudiantes.forEach(data => {
        
        const datos = data.querySelectorAll('td')

        const nombre = []
        const cuenta = []
        datos.forEach(info => {
            if(info.classList.contains('nombre')){
                nombre.push(info.innerHTML)
            }if(info.classList.contains('cuenta')){
                cuenta.push(info.innerHTML)
            }
            
        });

        csv.push([nombre, cuenta])
        
    });

    return csv;

}


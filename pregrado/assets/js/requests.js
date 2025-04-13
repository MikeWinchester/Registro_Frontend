document.addEventListener('DOMContentLoaded', function() {
    // Manejar envío de formulario de cambio de carrera
    const careerChangeForm = document.getElementById('careerChangeForm');
    if (careerChangeForm) {
        careerChangeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newCareer = document.getElementById('newCareer').value;
            const changeReason = document.getElementById('changeReason').value;
            
            if (!newCareer || !changeReason) {
                alert('Por favor completa todos los campos');
                return;
            }
            
            // Aquí iría la lógica para enviar la solicitud al servidor
            const careerName = document.getElementById('newCareer').options[document.getElementById('newCareer').selectedIndex].text;
            alert(`Solicitud de cambio a ${careerName} enviada (simulación). En un sistema real, se enviaría al servidor.`);
            
            // Limpiar formulario
            careerChangeForm.reset();
        });
    }
    
    // Manejar envío de formulario de cancelación de clase
    const classCancelForm = document.getElementById('classCancelForm');
    if (classCancelForm) {
        classCancelForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const cancelClass = document.getElementById('cancelClass').value;
            const cancelReason = document.getElementById('cancelReason').value;
            
            if (!cancelClass || !cancelReason) {
                alert('Por favor completa todos los campos');
                return;
            }
            
            // Aquí iría la lógica para enviar la solicitud al servidor
            const className = document.getElementById('cancelClass').options[document.getElementById('cancelClass').selectedIndex].text;
            alert(`Solicitud de cancelación para ${className} enviada (simulación). En un sistema real, se enviaría al servidor.`);
            
            // Limpiar formulario
            classCancelForm.reset();
        });
    }
    
    // Manejar envío de formulario de cambio de centro
    const centerChangeForm = document.getElementById('centerChangeForm');
    if (centerChangeForm) {
        centerChangeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newCenter = document.getElementById('newCenter').value;
            const centerChangeReason = document.getElementById('centerChangeReason').value;
            
            if (!newCenter || !centerChangeReason) {
                alert('Por favor completa todos los campos');
                return;
            }
            
            // Aquí iría la lógica para enviar la solicitud al servidor
            const centerName = document.getElementById('newCenter').options[document.getElementById('newCenter').selectedIndex].text;
            alert(`Solicitud de cambio a ${centerName} enviada (simulación). En un sistema real, se enviaría al servidor.`);
            
            // Limpiar formulario
            centerChangeForm.reset();
        });
    }
    
    // Manejar envío de formulario de pago de examen
    const recoveryExamForm = document.getElementById('recoveryExamForm');
    if (recoveryExamForm) {
        recoveryExamForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const examClass = document.getElementById('examClass').value;
            const paymentMethod = document.getElementById('paymentMethod').value;
            
            if (!examClass || !paymentMethod) {
                alert('Por favor completa todos los campos');
                return;
            }
            
            // Aquí iría la lógica para enviar la solicitud al servidor
            const className = document.getElementById('examClass').options[document.getElementById('examClass').selectedIndex].text;
            const methodName = document.getElementById('paymentMethod').options[document.getElementById('paymentMethod').selectedIndex].text;
            alert(`Solicitud de pago para ${className} (${methodName}) enviada (simulación). En un sistema real, se enviaría al servidor.`);
            
            // Limpiar formulario
            recoveryExamForm.reset();
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Simular descarga de certificado
    const downloadCertBtn = document.getElementById('downloadCertBtn');
    if (downloadCertBtn) {
        downloadCertBtn.addEventListener('click', function() {
            // Crear un PDF simulado
            const pdfContent = `
                <html>
                    <head>
                        <title>Certificado Académico</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            .header { text-align: center; margin-bottom: 30px; }
                            .logo { width: 150px; }
                            h1 { color: #2c3e50; }
                            .student-info { margin: 20px 0; }
                            .table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                            .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            .table th { background-color: #f2f2f2; }
                            .footer { margin-top: 50px; text-align: right; font-size: 0.8em; color: #777; }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <img src="https://via.placeholder.com/150x80?text=Universidad" alt="Logo Universidad" class="logo">
                            <h1>Certificado Académico</h1>
                        </div>
                        
                        <div class="student-info">
                            <p><strong>Nombre:</strong> Juan Pérez</p>
                            <p><strong>Número de Cuenta:</strong> 202310001</p>
                            <p><strong>Carrera:</strong> Ingeniería en Sistemas</p>
                            <p><strong>Índice Académico:</strong> 3.8</p>
                        </div>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Clase</th>
                                    <th>Créditos</th>
                                    <th>Nota</th>
                                    <th>Período</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Programación I</td>
                                    <td>4</td>
                                    <td>92</td>
                                    <td>2022-2</td>
                                </tr>
                                <tr>
                                    <td>Matemáticas I</td>
                                    <td>5</td>
                                    <td>85</td>
                                    <td>2022-2</td>
                                </tr>
                                <tr>
                                    <td>Física</td>
                                    <td>4</td>
                                    <td>78</td>
                                    <td>2022-1</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="footer">
                            <p>Emitido el: ${new Date().toLocaleDateString()}</p>
                            <p>Este documento es válido solo con el sello de la universidad</p>
                        </div>
                    </body>
                </html>
            `;
            
            // Crear un blob con el contenido HTML
            const blob = new Blob([pdfContent], { type: 'text/html' });
            const url = URL.createObjectURL(blob);
            
            // Crear un enlace temporal para la descarga
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Certificado_Academico_Juan_Perez.html';
            document.body.appendChild(a);
            a.click();
            
            // Limpiar
            setTimeout(() => {
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }, 100);
            
            alert('Certificado descargado (simulación). En un sistema real, se generaría un PDF real.');
        });
    }
});
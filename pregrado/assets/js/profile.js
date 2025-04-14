import { showToast } from "../../../assets/js/toastMessage.mjs";
import loadEnv from "../../../assets/js/getEnv.mjs";
const env = await loadEnv();

const endpointobtenerestu = `${env.API_URL}/estudiante/get`
const endpointactuestu = `${env.API_URL}/estudiante/actu/desc`
const endpointgetval = `${env.API_URL}/estudiante/get/id`
const endpointupdatedata = `${env.API_URL}/estudiante/upload/perfil`
const endpointuploadgaleria = `${env.API_URL}/estudiante/upload/galeria`
const endpointgetgaleria = `${env.API_URL}/estudiante/get/galeria`
const endpointdeletegaleria = `${env.API_URL}/estudiante/delete/galeria`
const endpoincarpeta = `${env.API_URL}/`

async function getProfile() {
    const est = await getVal();
    const section = document.querySelector('#profile-div');

    await fetch(endpointobtenerestu, {
        method: "GET",
        headers: {
            'estudianteid': est,
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    }).then(response => response.json())
    .then(async result => {
        result = result.data;
        await insertPicture(result);
        await insertGaleria();
        const getSafeName = (name, index) => {
            return name && name.split(" ")[index] ? name.split(" ")[index] : '';
        };

        const info = `<section class="mb-5">
                    <h2 class="section-title">Información Personal</h2>
                    <div class="profile-info">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-field">
                                    <label>Nombres</label>
                                    <div class="info-value">${getSafeName(result.nombre_completo, 0)} ${getSafeName(result.nombre_completo, 1)}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-field">
                                    <label>Apellidos</label>
                                    <div class="info-value">${getSafeName(result.nombre_completo, 3)} ${getSafeName(result.nombre_completo, 4)}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-field">
                                    <label>Número de Cuenta</label>
                                    <div class="info-value">${result.numero_cuenta || ''}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-field">
                                    <label>Correo Electrónico</label>
                                    <div class="info-value">${result.correo || ''}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-field mb-3">
                            <label>Carrera</label>
                            <div class="info-value">${result.nombre_carrera || ''}</div>
                        </div>
                        
                        <div class="info-field">
                            <label>Teléfono</label>
                            <div class="info-value">${result.telefono || ''}</div>
                        </div>
                    </div>
                    </section>
                    <section class="mb-5" >
                    <h2 class="section-title">Acerca de Mí</h2>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Descripción</label>
                            <textarea class="form-control" id="bio" rows="5">${result.descripcion || ''}</textarea>
                        </div>
                        <button type="submit" class="btn btn-dark" id="desc">Actualizar Descripción</button>
                </section>`;

        section.innerHTML = ' ';
        section.innerHTML = info;

        document.querySelector('#desc').addEventListener('click', async () => {
            await updateDesc(est);
        });

        const pic = document.querySelector('#profilePicInput');

        pic.addEventListener('change', async() => {
            await uploadProfile(est);
        })

    }).catch(error => {
        console.error("Error fetching profile:", error);
        section.innerHTML = '<p>Error al cargar los datos del perfil.</p>';
    });
}

function insertPicture(result){
    const div = document.querySelector('#div-profile');
    const imgPerfil = result.foto_perfil ? result.foto_perfil : 'https://via.placeholder.com/300x300?text=JP';

    div.innerHTML = '';
    const profile = document.createElement('img');
    profile.src = `${endpoincarpeta}${imgPerfil}`;
    profile.alt = 'Foto de perfil';
    profile.class='prodile-picture';
    div.appendChild(profile);

    let divs = `<div class="mt-3">
                        <input type="file" id="profilePicInput" class="d-none" accept="image/*">
                        <label for="profilePicInput" class="btn btn-dark w-100">Cambiar foto</label>
                </div>`;

    div.innerHTML += divs;
}

async function updateDesc(est) {
    const desc = document.querySelector('#bio').value;

    const data = { 'usuario_id': est, 'descripcion': desc };

    await fetch(endpointactuestu, {
        method: "PUT",
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        },
        body: JSON.stringify(data)
    }).then(response => response.json())
    .then(result => {
        console.log("Resultado de la actualización:", result);
        if (result.message) {
            alert("Descripción actualizada correctamente.");
            //Poner Sho toast
        } else {
            alert("Error al actualizar la descripción.");
        }
    }).catch(error => {
        console.error("Error al actualizar la descripción:", error);
        alert("Hubo un error al actualizar la descripción.");
    });
}

async function uploadProfile(est) {
    const file = document.querySelector('#profilePicInput').files[0];

    if (!file) {
        alert("Por favor selecciona una imagen.");
        return;
    }

    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });

    const base64Image = await toBase64(file);

    const payload = {
        'foto_perfil': base64Image, 
        'estudiante_id': localStorage.getItem('estudiante')
    };

    try {
        const response = await fetch(endpointupdatedata, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        await getProfile()

    } catch (error) {
        console.error('Error al cargar la imagen:', error);
        alert('Ha ocurrido un error al intentar actualizar la foto de perfil.');
    }
}

async function uploadGaleria(){
    const file = document.querySelector('#galleryPicInput').files[0];

    if (!file) {
        alert("Por favor selecciona una imagen.");
        return;
    }

    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });

    const base64Image = await toBase64(file);

    const payload = {
        'fotografia': base64Image, 
        'estudiante_id': localStorage.getItem('estudiante')
    };

    try {
        const response = await fetch(endpointuploadgaleria, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                'Authorization': `Bearer ${localStorage.getItem('authToken')}`
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        await getProfile()

    } catch (error) {
        console.error('Error al cargar la imagen:', error);
        alert('Ha ocurrido un error al intentar actualizar la foto de perfil.');
    }
}

async function insertGaleria() {
    const divFoto = document.querySelector('#galeria');
    divFoto.innerHTML = '';

    await fetch(endpointgetgaleria, { 
        method: "GET",
        headers: {
            'id': localStorage.getItem('estudiante'),
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    })
    .then(response => response.json())
    .then(result => {
        let index = 0;
        console.log(result);
        
        if (result.message) {
            result.data.forEach(fotos => {
                index++;

                const galeria = document.createElement('div');
                galeria.classList.add('col-md-6', 'mb-3');

                galeria.innerHTML = `
                    <img src="${endpoincarpeta}${fotos.fotografia}" class="gallery-photo img-thumbnail">
                    <button id='${fotos.fotografia}' class="btn btn-sm btn-danger w-100 mt-2 delete-photo">Eliminar</button>
                `;

                divFoto.appendChild(galeria);
            });

            if (index < 3) {
                const btnFoto = document.createElement('div');
                btnFoto.classList.add('col-md-6', 'mb-3');
                btnFoto.innerHTML = `
                    <div class="upload-photo-placeholder">
                        <input type="file" id="galleryPicInput" class="d-none" accept="image/*">
                        <label for="galleryPicInput" class="btn btn-outline-dark">
                            <i class="bi bi-plus-lg"></i> Agregar foto
                        </label>
                    </div>
                `;
                divFoto.appendChild(btnFoto);

                const galeria = document.querySelector('#galleryPicInput');

                galeria.addEventListener('change', async() => {
                    await uploadGaleria();
                })
            }
        }else{
            const btnFoto = document.createElement('div');
            btnFoto.classList.add('col-md-6', 'mb-3');
            btnFoto.innerHTML = `
                <div class="upload-photo-placeholder">
                    <input type="file" id="galleryPicInput" class="d-none" accept="image/*">
                    <label for="galleryPicInput" class="btn btn-outline-dark">
                        <i class="bi bi-plus-lg"></i> Agregar foto
                    </label>
                </div>
            `;
            divFoto.appendChild(btnFoto);

            const galeria = document.querySelector('#galleryPicInput');

            galeria.addEventListener('change', async() => {
                await uploadGaleria();
            })
        }

        const btnsEliminar = document.querySelectorAll('.delete-photo');
        btnsEliminar.forEach(btn => {
            btn.addEventListener('click', async () => {
                await eliminarFoto(btn.id);
            });
        });

    })
    .catch(error => {
        console.error('Error al cargar galería:', error);
    });
}

async function eliminarFoto(ruta){
    const data = {
        'ruta' : ruta
    }

    await fetch(endpointdeletegaleria, {
        method : "DELETE",
        headers : {
            "Content-Type": "application/json",
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        },
        body : JSON.stringify(data)
    }).then(response => response.json())
    .then(async result => {
        if(result.message){
            await getProfile();
        }else{
            console.log(result.error);
        }
    })
}

async function getVal(){
    
    const est = localStorage.getItem('estudiante');
    
    
    const res = await fetch(endpointgetval, {
        method: "GET",
        headers: {
            "id": est,
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`
        }
    });
    
    const result = await res.json();

    return result.data.id;

    
}

getProfile();
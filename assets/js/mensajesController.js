import loadEnv from "./getEnv.mjs";
import { showToast } from "./toastMessage.mjs";
const env = await loadEnv();

const endpointamistad = `${env.API_URL}/solicitud_amistad/get/message"`;
const endpointultmiomensaje  = `${env.API_URL}/mensaje/get/last`;

async function getFriendsWithMessage(){
    if(localStorage.getItem('estudiante')){
        const user = localStorage.getItem('estudiante');
    }else if(localStorage.getItem('docenteID')){
        const user = localStorage.getItem('docenteID');
    }else{
        const user = localStorage.getItem('jefeID')
    }    
}
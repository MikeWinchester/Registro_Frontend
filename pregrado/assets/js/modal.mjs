
function abrirModalAgregarContato() {
    var myModal = new bootstrap.Modal(document.getElementById('createGroupModal'));
    myModal.show();
}


function abrirModalVerPerfil() {
    var myModal = new bootstrap.Modal(document.getElementById('profileModal'));
    myModal.show();
}

function abrirModalMandarSoli(){
    var myModal = new bootstrap.Modal(document.getElementById('addUserModal'));
    myModal.show();
}

function abrirModalVerSoli(){
    var myModal = new bootstrap.Modal(document.getElementById('pendingRequestsModal'));
    myModal.show();
}

function abrirModalverAmigos(){
    var myModal = new bootstrap.Modal(document.getElementById('friendsListModal'));
    myModal.show();
}

function cerrarModalverAmigos(){
    var myModal = new bootstrap.Modal(document.getElementById('friendsListModal'));
    myModal.hide();
}



export {abrirModalAgregarContato, abrirModalVerPerfil, abrirModalMandarSoli, abrirModalVerSoli, abrirModalverAmigos, cerrarModalverAmigos};

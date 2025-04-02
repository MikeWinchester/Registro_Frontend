<?php 
class renderController{
    public function renderHome(){
        http_response_code(200);
        include __DIR__."/views/landing.php";
    }

    public function renderStudentsLogin(){
        http_response_code(200);
        include __DIR__."/views/loginEstudiantes.php";
    }

    public function renderStudentsHome(){
        http_response_code(200);
        include __DIR__."/views/estudiantes.php";
    }

    public function renderAdmissionsForm(){
        http_response_code(200);
        include __DIR__."/views/formulario_admisiones.php";
    }

    public function renderAdmissionsChecking(){
        http_response_code(200);
        include __DIR__."/views/solicitud.php";
    }

    public function renderReviewersLogin(){
        http_response_code(200);
        include __DIR__."/views/loginRevisores.php";
    }

    public function renderReviewersHome(){
        http_response_code(200);
        include __DIR__."/views/revisores.php";
    }


    public function renderTeachersHome(){
        http_response_code(200);
        include __DIR__."/views/docentes.php";
    }


    public function renderJefesHome(){
        http_response_code(200);
        include __DIR__."/views/jefe_departamento.php";
    }


    public function renderCoordinadoresHome(){
        http_response_code(200);
        include __DIR__."/views/coordinador.php";
    }


    public function renderMatriculaHome(){
        http_response_code(200);
        include __DIR__."/views/matricula_estudiante.php";
    }

}
?>
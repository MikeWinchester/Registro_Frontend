<?php 
class renderController{
    public function renderHome(){
        http_response_code(200);
        include __DIR__."/views/landing.php";
    }

    public function renderStudents(){
        http_response_code(200);
        include __DIR__."/views/login.php";
    }

    public function renderStudentsHome(){
        http_response_code(200);
        include __DIR__."/views/estudiantes.php";
    }
}
?>
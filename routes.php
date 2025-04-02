<?php 
require_once __DIR__ . "/renderController.php";
require_once __DIR__ . "/Router.php";

$router = new Router;

$router->addRoute("GET", "/", "renderController", "renderHome");
$router->addRoute("GET", "/students/login", "renderController", "renderStudentsLogin");
$router->addRoute("GET", "/students/home", "renderController", "renderStudentsHome");
$router->addRoute("GET", "/admissions/form", "renderController", "renderAdmissionsForm");
$router->addRoute("GET", "/admissions/check", "renderController", "renderAdmissionsChecking");
$router->addRoute("GET", "/reviewers/login", "renderController", "renderReviewersLogin");
$router->addRoute("GET", "/reviewers/home", "renderController", "renderReviewersHome");
$router->addRoute("GET", "/teachers/home", "renderController", "renderTeachersHome");
$router->addRoute("GET", "/jefes/home", "renderController", "renderJefesHome");
$router->addRoute("GET", "/coordinadores/home", "renderController", "renderCoordinadoresHome");


$router->dispatch($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"]);
?>
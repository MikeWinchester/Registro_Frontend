<?php 
require_once __DIR__ . "/renderController.php";
require_once __DIR__ . "/Router.php";

$router = new Router;

$router->addRoute("GET", "/home", "renderController", "renderHome");
$router->addRoute("GET", "/students/login", "renderController", "renderStudents");
$router->addRoute("GET", "/students/home", "renderController", "renderStudentsHome");

$router->dispatch($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"]);
?>
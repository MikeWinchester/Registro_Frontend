<?php
$page = $_GET['page'] ?? 'landing'; // Página predeterminada: landing

$viewPath = __DIR__ . "/views/{$page}.php";

if (file_exists($viewPath)) {
    require $viewPath;
} else {
    require __DIR__ . "/views/404.php"; // Página de error si no existe
}
?>

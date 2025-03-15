<?php

// Obtener las variables de entorno desde el archivo .env o las variables de Heroku
function loadEnv($file = __DIR__ . "/.env") {
    $env = [];

    // Priorizar variables de entorno en Heroku
    $herokuEnvKeys = ["API_URL"];
    $herokuEnv = [];

    foreach ($herokuEnvKeys as $key) {
        $value = getenv($key);
        if ($value !== false) {
            $herokuEnv[$key] = $value;
        }
    }

    // Si hay variables en Heroku, usarlas
    if (!empty($herokuEnv)) {
        return $herokuEnv;
    }

    // Si no hay en Heroku, cargar desde el archivo .env
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), "#") === 0) {
                continue;
            }
            list($key, $value) = explode("=", $line, 2);
            $env[trim($key)] = trim($value);
        }
    }

    return $env;
}

// Cargar las variables de entorno y devolverlas como JSON
header('Content-Type: application/json');
echo json_encode(loadEnv());

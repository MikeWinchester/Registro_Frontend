<?php
header('Content-Type: application/json');
session_start();

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (empty($data['roles'])) {
        throw new Exception('Datos incompletos');
    }

    $_SESSION['user_id'] = $data['id'];
    $_SESSION['user_name'] = $data['name'];
    $_SESSION['user_roles'] = $data['roles'];
    $_SESSION['user_number'] = $data['accountNumber'] ?? '';

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Error al guardar la sesión'
    ]);
}
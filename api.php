<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

include "generic/Autoload.php";

use controller\ApiController;

try {
    $apiController = new ApiController();
    $apiController->handleRequest();
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erro interno do servidor',
        'message' => 'Ocorreu um erro inesperado. Tente novamente mais tarde.'
    ]);
    error_log("API Error: " . $e->getMessage());
}
?>

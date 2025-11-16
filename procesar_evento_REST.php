<?php
header("Content-Type: application/json");

// Leer JSON recibido
$data = json_decode(file_get_contents("php://input"), true);

// Estructura de respuesta
$response = [
    "status" => "OK",
    "mensaje" => "Datos recibidos correctamente (REST)",
    "datos" => $data
];

// Enviar JSON
echo json_encode($response, JSON_PRETTY_PRINT);

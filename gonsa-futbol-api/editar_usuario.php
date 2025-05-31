<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require 'conexion.php';

$data = json_decode(file_get_contents("php://input"));

$id = $data->id ?? null;
$nombre = $data->nombre ?? '';
$email = $data->email ?? '';
$rol = $data->rol ?? '';
$telefono = $data->telefono ?? '';
$direccion = $data->direccion ?? '';

if (!$id || !$nombre || !$email) {
    echo json_encode(["status" => "error", "mensaje" => "Datos incompletos"]);
    exit;
}

$stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, rol = ?, telefono = ?, direccion = ? WHERE id = ?");
$stmt->bind_param("sssssi", $nombre, $email, $rol, $telefono, $direccion, $id);
$stmt->execute();

echo json_encode(["status" => "ok"]);
$conn->close();
?>

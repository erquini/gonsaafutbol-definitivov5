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

$input = json_decode(file_get_contents("php://input"));

$nombre = $input->nombre ?? '';
$email = $input->email ?? '';
$password = $input->password ?? '';
$direccion = $input->direccion ?? '';
$telefono = $input->telefono ?? '';

if (!$nombre || !$email || !$password || !$direccion || !$telefono) {
    echo json_encode(["status" => "error", "mensaje" => "❌ Campos incompletos"]);
    exit;
}

// Validar si ya existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["status" => "error", "mensaje" => "⚠️ El correo ya está registrado"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, direccion, telefono) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nombre, $email, $password, $direccion, $telefono);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "✅ Usuario registrado"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "❌ Error al registrar"]);
}

$conn->close();
?>

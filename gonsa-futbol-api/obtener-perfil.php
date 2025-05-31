<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

session_start();
require 'conexion.php';

$usuario = $_SESSION['usuario'] ?? null;

if (!$usuario) {
    echo json_encode(["status" => "error", "mensaje" => "No logueado"]);
    exit;
}

$stmt = $conn->prepare("SELECT nombre, email, direccion, telefono, avatar FROM usuarios WHERE nombre = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
    // Si hay avatar, devuelve la URL completa
    if (!empty($fila['avatar'])) {
        $fila['avatar'] = "http://localhost/gonsa-futbol-api/" . $fila['avatar'];
    }
    echo json_encode(["status" => "ok", "datos" => $fila]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Usuario no encontrado"]);
}

$conn->close();

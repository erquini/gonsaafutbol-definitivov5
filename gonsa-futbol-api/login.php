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
session_start();

$input = json_decode(file_get_contents("php://input"));
$email = $input->email ?? '';
$password = $input->password ?? '';

if (!$email || !$password) {
    echo json_encode(["status" => "error", "mensaje" => "❌ Campos incompletos"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, nombre, email, password, rol, telefono, direccion, avatar FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
    if ($password === $fila['password']) {
        $_SESSION['usuario'] = $fila['nombre'];

        echo json_encode([
            "status" => "ok",
            "usuario" => [
                "id" => $fila['id'],
                "nombre" => $fila['nombre'],
                "email" => $fila['email'],
                "rol" => $fila['rol'],
                "telefono" => $fila['telefono'],
                "direccion" => $fila['direccion'],
                "avatar" => $fila['avatar']
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "mensaje" => "❌ Contraseña incorrecta"]);
    }
} else {
    echo json_encode(["status" => "error", "mensaje" => "❌ Usuario no encontrado"]);
}

$conn->close();
?>

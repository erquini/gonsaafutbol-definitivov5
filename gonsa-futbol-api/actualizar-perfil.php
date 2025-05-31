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

session_start();
require 'conexion.php';

$input = json_decode(file_get_contents("php://input"));

$usuarioNombreSesion = $_SESSION['usuario'] ?? null;

if (!$usuarioNombreSesion) {
    echo json_encode(["status" => "error", "mensaje" => "No autenticado"]);
    exit;
}

$nombre = $input->nombre ?? '';
$email = $input->email ?? '';
$direccion = $input->direccion ?? '';
$telefono = $input->telefono ?? '';

if (!$nombre || !$email || !$direccion || !$telefono) {
    echo json_encode(["status" => "error", "mensaje" => "Faltan datos"]);
    exit;
}

// Obtener email original del usuario (por nombre desde sesión)
$stmt = $conn->prepare("SELECT email FROM usuarios WHERE nombre = ?");
$stmt->bind_param("s", $usuarioNombreSesion);
$stmt->execute();
$result = $stmt->get_result();

if ($fila = $result->fetch_assoc()) {
    $emailOriginal = $fila['email'];

    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, direccion = ?, telefono = ? WHERE email = ?");
    $stmt->bind_param("sssss", $nombre, $email, $direccion, $telefono, $emailOriginal);

    if ($stmt->execute()) {
        $_SESSION['usuario'] = $nombre;
        echo json_encode(["status" => "ok", "mensaje" => "Perfil actualizado"]);
    } else {
        echo json_encode(["status" => "error", "mensaje" => "Error al actualizar"]);
    }

} else {
    echo json_encode(["status" => "error", "mensaje" => "Usuario no encontrado"]);
}

$conn->close();
?>

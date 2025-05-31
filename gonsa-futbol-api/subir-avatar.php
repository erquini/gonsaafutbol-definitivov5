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

$usuario = $_SESSION['usuario'] ?? null;

if (!$usuario || !isset($_FILES['avatar'])) {
    echo json_encode(["status" => "error", "mensaje" => "No autenticado o archivo no recibido"]);
    exit;
}

$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$filename = uniqid('avatar_') . '_' . basename($_FILES['avatar']['name']);
$targetPath = $uploadDir . $filename;

if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
    // Guardar solo la ruta relativa en la base de datos
    $stmt = $conn->prepare("UPDATE usuarios SET avatar = ? WHERE nombre = ?");
    $stmt->bind_param("ss", $targetPath, $usuario);
    $stmt->execute();

    // Generar URL completa para devolver a Angular
    $urlCompleta = "http://localhost/gonsa-futbol-api/" . $targetPath;

    echo json_encode(["status" => "ok", "ruta" => $urlCompleta]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "No se pudo subir la imagen"]);
}
?>

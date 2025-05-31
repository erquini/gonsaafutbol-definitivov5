<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


require 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data['id']) || !isset($data['nombre']) || !isset($data['precio']) ||
    !isset($data['stock']) || !isset($data['categoria'])
) {
    echo json_encode(["status" => "error", "mensaje" => "Faltan campos obligatorios"]);
    exit;
}

$id = $data['id'];
$nombre = $data['nombre'];
$precio = $data['precio'];
$stock = $data['stock'];
$categoria = $data['categoria'];

$stmt = $conn->prepare("UPDATE productos SET nombre = ?, precio = ?, stock = ?, categoria = ? WHERE id = ?");
$stmt->bind_param("sdisi", $nombre, $precio, $stock, $categoria, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok", "mensaje" => "Producto actualizado"]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Error al actualizar"]);
}

$stmt->close();
$conn->close();
?>

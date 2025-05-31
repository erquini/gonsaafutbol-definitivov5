<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Content-Type: application/json");
require_once 'conexion.php'; // Conexión a tu base de datos

$productos = json_decode(file_get_contents('php://input'), true);

if (!$productos) {
    http_response_code(400);
    echo json_encode(["error" => "No se recibieron datos"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO productos (id, nombre, descripcion, precio, stock, imagen, categoria) VALUES (?, ?, ?, ?, ?, ?, ?)");

foreach ($productos as $producto) {
    $stmt->bind_param(
        "issdiss",
        $producto['id'],
        $producto['nombre'],
        $producto['descripcion'],
        $producto['precio'],
        $producto['stock'],
        $producto['imagen'],
        $producto['equipo']
    );
    $stmt->execute();
}

echo json_encode(["mensaje" => "Productos insertados correctamente"]);

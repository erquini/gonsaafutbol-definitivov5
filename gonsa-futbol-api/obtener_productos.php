<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Content-Type: application/json");
require_once 'conexion.php';

$sql = "SELECT id, nombre, descripcion, precio, stock, imagen, categoria FROM productos";
$result = $conn->query($sql);

$productos = [];
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos);

<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Content-Type: application/json");
require_once 'conexion.php';
$sql = "SELECT id, nombre, email, rol, telefono, direccion, avatar FROM usuarios";
$result = $conn->query($sql);

$usuarios = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
  }
}

echo json_encode($usuarios);
$conn->close();

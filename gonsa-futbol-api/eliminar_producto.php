<?php
header('Content-Type: application/json');
include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    echo json_encode(["status" => "success", "mensaje" => "Producto eliminado"]);
  } else {
    echo json_encode(["status" => "error", "mensaje" => "Error al eliminar producto"]);
  }

  $stmt->close();
} else {
  echo json_encode(["status" => "error", "mensaje" => "ID no proporcionado"]);
}

$conn->close();

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include("conexion.php"); // esto define $conn

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT * FROM productos WHERE id = $id LIMIT 1";
    $resultado = $conn->query($query); // ✅ uso correcto

    if ($resultado && $resultado->num_rows > 0) {
        echo json_encode($resultado->fetch_assoc());
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Producto no encontrado"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "ID no proporcionado"]);
}

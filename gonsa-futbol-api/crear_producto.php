<?php
// Encabezados CORS
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require 'conexion.php';

// Recibir datos del formulario
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? '';
$stock = $_POST['stock'] ?? '';
$categoria = $_POST['categoria'] ?? '';

// Validación básica
if (!$nombre || !$descripcion || !$precio || !$stock || !$categoria || !isset($_FILES['imagen'])) {
    echo json_encode(["status" => "error", "mensaje" => "❌ Datos incompletos"]);
    exit;
}

// Subida de imagen
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$filename = uniqid('producto_') . '_' . basename($_FILES['imagen']['name']);
$targetPath = $uploadDir . $filename;

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
    $rutaImagen = $targetPath;

    // Preparar consulta SQL
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, categoria, imagen) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdss", $nombre, $descripcion, $precio, $stock, $categoria, $rutaImagen);

    if ($stmt->execute()) {
        echo json_encode(["status" => "ok", "mensaje" => "✅ Producto insertado correctamente"]);
    } else {
        error_log("❌ Error SQL: " . $stmt->error);
        echo json_encode(["status" => "error", "mensaje" => "❌ Error al insertar producto"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "mensaje" => "❌ Error al subir la imagen"]);
}

$conn->close();
?>

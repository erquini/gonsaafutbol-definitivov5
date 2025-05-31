<?php
// CORS y cabeceras
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Iniciar sesión y conexión
session_start();
require 'conexion.php';

$accion = $_GET['accion'] ?? '';

// ✅ Acción: LISTAR opiniones
if ($accion === 'listar') {
    $sql = "SELECT o.comentario, o.puntuacion, o.fecha, o.ciudad, u.nombre, u.avatar 
            FROM opiniones o 
            JOIN usuarios u ON o.usuario_id = u.id 
            ORDER BY o.fecha DESC";

    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode([
            "status" => "error",
            "mensaje" => "Error en la consulta SQL: " . $conn->error
        ]);
        exit;
    }

    $opiniones = [];
    while ($row = $result->fetch_assoc()) {
        // Si hay avatar, construimos URL completa
        if (!empty($row['avatar'])) {
            $row['avatar'] = "http://localhost/gonsa-futbol-api/" . $row['avatar'];
        } else {
            $row['avatar'] = "assets/images/default-avatar.png";
        }
        $opiniones[] = $row;
    }

    echo json_encode(["opiniones" => $opiniones]);
    exit;
}

// ✅ Acción: CREAR nueva opinión
if ($accion === 'crear') {
    $input = json_decode(file_get_contents("php://input"));
    $usuarioNombre = $_SESSION['usuario'] ?? null;

    if (!$usuarioNombre) {
        echo json_encode(["status" => "error", "mensaje" => "No autenticado"]);
        exit;
    }

    $ciudad = $input->ciudad ?? '';
    $puntuacion = intval($input->puntuacion ?? 0);
    $comentario = $input->comentario ?? '';

    if (!$ciudad || !$comentario || $puntuacion < 1 || $puntuacion > 5) {
        echo json_encode(["status" => "error", "mensaje" => "Datos inválidos"]);
        exit;
    }

    // Obtener ID del usuario
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $usuarioNombre);
    $stmt->execute();
    $stmt->bind_result($usuario_id);
    $stmt->fetch();
    $stmt->close();

    if (!$usuario_id) {
        echo json_encode(["status" => "error", "mensaje" => "Usuario no encontrado"]);
        exit;
    }

    // Insertar la opinión
    $stmt = $conn->prepare("INSERT INTO opiniones (usuario_id, ciudad, puntuacion, comentario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $usuario_id, $ciudad, $puntuacion, $comentario);

    if ($stmt->execute()) {
        echo json_encode(["status" => "ok", "mensaje" => "Opinión guardada correctamente"]);
    } else {
        echo json_encode(["status" => "error", "mensaje" => "Error al guardar: " . $stmt->error]);
    }

    $stmt->close();
    exit;
}
echo json_encode(["status" => "error", "mensaje" => "Acción no válida"]);

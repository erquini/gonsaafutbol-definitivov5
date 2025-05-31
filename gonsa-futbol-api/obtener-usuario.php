<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

session_start();

if (isset($_SESSION['usuario'])) {
    echo json_encode(["usuario" => $_SESSION['usuario']]);
} else {
    echo json_encode(["usuario" => null]);
}
?>

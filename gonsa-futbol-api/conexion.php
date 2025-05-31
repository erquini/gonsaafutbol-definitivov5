<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gonsa_futbol";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "mensaje" => "Conexión fallida"]));
}
?>